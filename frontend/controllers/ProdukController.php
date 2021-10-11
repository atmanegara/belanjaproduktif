<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use backend\models\DataBarang;
use yii\db\Query;
use frontend\models\QueryModel;
use yii\data\Pagination;
use yii\base\DynamicModel;
use backend\models\Addcart;
use backend\models\PembayaranJualbeli;
use backend\models\RefBank;
use backend\models\CheckoutItem;
use backend\models\MetodePembayaran;
use backend\models\RefKurir;
use backend\models\RefJam;

class ProdukController extends Controller {

    public function actionIndex() {
        $query = QueryModel::getDataBarangAll();
        $modelKabupaten = \backend\models\Kabupaten::dropdownlist();


        $modelDynamic = new DynamicModel(['nama_item','id_kab', 'id_kecamatan', 'id_kelurahan']);
        $modelDynamic->addRule(['id_kab', 'id_kecamatan', 'id_kelurahan','nama_item'], 'string');
        if ($modelDynamic->load(Yii::$app->request->post())) {
            $id_kab = $modelDynamic->id_kab;
            $id_kecamatan = $modelDynamic->id_kecamatan;
            $id_kelurahan = $modelDynamic->id_kelurahan;
            $nama_item = $modelDynamic->nama_item;

            $query = QueryModel::getDataBarangAllByFilter($id_kab, $id_kecamatan, $id_kelurahan,$nama_item);
        }
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);
        $dataBarang = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        return $this->render('produk', [
                    'dataBarang' => $dataBarang,
                    'pages' => $pages,
                    'modelDynamic' => $modelDynamic,
                    'modelKabupaten' => $modelKabupaten,
        ]);
    }

    public function actionProdukDetail($id) {
        $modelBarang = (new Query())
                        ->select('a.id,d.filename,a.item_barang,b.stok_sisa,c.harga_satuan,c.harga_jual,a.ket')
                        ->from('data_barang a')
                        ->innerJoin('stok_barang b', 'a.id=b.id_data_barang')
                        ->innerJoin('transaksi_barang c', 'c.id_data_barang=b.id_data_barang')
                        ->innerJoin('ref_barang d', 'a.id_ref_barang=d.id')
                        ->where(['a.id' => $id])->one();
        return $this->render('produk-detail', [
                    'modelBarang' => $modelBarang
        ]);
    }

    public function actionAddCart($id_data_barang) {
        if (Yii::$app->user->isGuest) {
            return $this->renderAjax('login-dulu');
        }

        $modelDynamic = new DynamicModel(['qty']);
        $modelDynamic->addRule('qty', 'integer');
        $no_acak = Yii::$app->user->identity->no_acak;
        //buat invoice duluan sanak supaya kada bentrok
        //cek hulu pembayarannya dengan invoice/no acak nang ada


        if ($modelDynamic->load(Yii::$app->request->post())) {
            $modelEx = Addcart::find()->where(['no_acak' => $no_acak, 'id_data_barang' => $id_data_barang]);
            if ($modelEx->exists()) {
                $model = $modelEx->one();
            } else {
                $model = new Addcart();
            }
            $tgl_masuk = date('Y-m-d');
            $model->no_acak = $no_acak;
            $model->id_data_barang = $id_data_barang;
            $model->id_data_agen = 0;
            $model->qty = $modelDynamic->qty;
            $model->tgl_masuk = $tgl_masuk;
            $model->save(false);

            //masuk keranjang
            $histori_cart = \backend\models\HistoriAddcart::find()->where(['no_acak' => $no_acak, 'id_tahap' => '1', 'status' => 'N']);
            if ($histori_cart->exists()) {
                $modelHistory = $histori_cart->one();
            } else {
                $modelHistory = new \backend\models\HistoriAddcart();
            }
            $modelHistory->no_acak = $no_acak;
            $modelHistory->tgl_addcart = $tgl_masuk;
            $modelHistory->id_tahap = 1;
            $modelHistory->status = 'N';
            $modelHistory->no_invoice = $no_acak;
            $modelHistory->save(false);
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderAjax('add-cart', [
                    'modelDynamic' => $modelDynamic
        ]);
    }

    public function actionCheckout($no_acak) {  //checkout-payment
        $dataItem = (new Query())
                        ->select('a.id_data_barang,a.tgl_masuk,b.item_barang,a.id,a.qty,max(c.harga_jual) harga_jual,(a.qty*max(c.harga_jual)) as total,d.filename')
                        ->from('addcart a')
                        ->innerJoin('data_barang b', 'a.id_data_barang=b.id')
                        ->innerJoin('transaksi_barang c', 'a.id_data_barang=c.id_data_barang')
                        ->innerJoin('ref_barang d', 'b.id_ref_barang=d.id')
                        ->where(['a.no_acak' => $no_acak])
                        ->groupBy('a.id_data_barang,a.no_acak')->all();
        //Addcart::find()->where(['no_acak'=>$no_acak])->all();

        if (Yii::$app->request->post('pilih')) {
            $id = Yii::$app->request->post('pilih');

            $modelCheckout = new CheckoutItem();

            $no_invoice = \backend\models\QueryModel::noinvoice();
            foreach ($id as $val) {
                //data barang
                $dataItemOne = (new Query())
                                ->select('a.id_data_barang,a.no_acak,a.tgl_masuk,b.item_barang,a.id,a.qty,max(c.harga_jual) harga_jual,(a.qty*max(c.harga_jual)) as total,b.filename')
                                ->from('addcart a')
                                ->innerJoin('data_barang b', 'a.id_data_barang=b.id')
                                ->innerJoin('transaksi_barang c', 'a.id_data_barang=c.id_data_barang')
                                ->groupBy('a.id_data_barang,a.no_acak')->where(['a.id' => $val])->one();

                $no_acak = $dataItemOne['no_acak'];
                $id_data_barang = $dataItemOne['id_data_barang'];
                $nama_item = $dataItemOne['item_barang'];
                $harga_jual = $dataItemOne['harga_jual'];
                $qty = $dataItemOne['qty'];
                $total = $dataItemOne['total'];
                $tgl_masuk = $dataItemOne['tgl_masuk'];
                $tgl_invoice = date('Y-m-d');
                $modelCheckout->isNewRecord = true;
                $modelCheckout->id = null;
                $modelCheckout->no_acak = $no_acak;
                $modelCheckout->id_data_barang = $id_data_barang;
                $modelCheckout->nama_item = $nama_item;
                $modelCheckout->harga_jual = $harga_jual;
                $modelCheckout->qty = $qty;
                $modelCheckout->total = $total;
                $modelCheckout->no_invoice = $no_invoice;
                $modelCheckout->tgl_invoice = $tgl_invoice;
                $modelCheckout->tgl_masuk = $tgl_masuk;
                $modelCheckout->save(false);
            }
            foreach ($id as $val) {
                Addcart::findOne($val)->delete();
            }
            $histori_cart = \backend\models\HistoriAddcart::find()->where(['no_acak' => $no_acak, 'id_tahap' => '1', 'status' => 'N']);
            if ($histori_cart->exists()) {
                $modelHistory = $histori_cart->one();
            } else {
                $modelHistory = new \backend\models\HistoriAddcart();
            }
            $modelHistory->no_acak = $no_acak;
            $modelHistory->tgl_addcart = $tgl_masuk;
            $modelHistory->id_tahap = 1;
            $modelHistory->no_invoice = $no_invoice;
            $modelHistory->status = 'Y';

            $modelHistory->save(false);

            $histori_cart = \backend\models\HistoriAddcart::find()->where(['no_acak' => $no_acak, 'id_tahap' => '2', 'status' => 'N']);
            if ($histori_cart->exists()) {
                $modelHistory = $histori_cart->one();
            } else {
                $modelHistory = new \backend\models\HistoriAddcart();
            }
            $modelHistory->no_acak = $no_acak;
            $modelHistory->tgl_addcart = $tgl_masuk;
            $modelHistory->id_tahap = 2;
            $modelHistory->status = 'N';
            $modelHistory->no_invoice = $no_invoice;
            $modelHistory->save(false);

            return $this->redirect(['checkout-payment',
                        'no_invoice' => $no_invoice,
            ]);
        }

        return $this->render('checkout-item', [
                    'dataItem' => $dataItem,
                    'no_acak' => $no_acak
        ]);
    }

    public function actionCheckoutPayment($no_invoice) {

        $dataItem = CheckoutItem::find()->where(['no_invoice' => $no_invoice])->all();
        $model = new \backend\models\PembayaranJualbeli();
        //metode pembayaran
        $listMetodePembayaran = MetodePembayaran::getDropdownlist();
        //kurir
        $modelRefKurir = RefKurir::getDropdownlist();

        //jam
        $refJam = RefJam::findAll(['aktif' => 'Y']);
        $no_acak = Yii::$app->user->identity->no_acak;
        $tgl_masuk = date('Y-m-d');
        if ($model->load(Yii::$app->request->post())) {
            $id_metode_pembayaran = $model->id_metode_pembayaran;
            $id_ref_kurir = $model->id_ref_kurir;
            $tgl_dikirim = $model->tgl_dikirim;
            $jam_dikirim = $model->jam_dikirim;
            $modelDaftarInvoice = new \backend\models\DaftarInvoice();
            $modelDaftarInvoice->no_acak = $no_acak;
            $modelDaftarInvoice->no_invoice = $no_invoice;
            $modelDaftarInvoice->bayar = 'N';
            if ($modelDaftarInvoice->save()) {
                $model->id_status_pembayaran = 3;
                $model->save(false);
                $histori_cart = \backend\models\HistoriAddcart::find()->where(['no_acak' => $no_acak, 'id_tahap' => '2', 'status' => 'N']);
                if ($histori_cart->exists()) {
                    $modelHistory = $histori_cart->one();
                } else {
                    $modelHistory = new \backend\models\HistoriAddcart();
                }
                $modelHistory->no_acak = $no_acak;
                $modelHistory->tgl_addcart = $tgl_masuk;
                $modelHistory->id_tahap = 2;
                $modelHistory->no_invoice = $no_invoice;
                $modelHistory->status = 'Y';
                $modelHistory->save(false);

                $histori_cart = \backend\models\HistoriAddcart::find()->where(['no_acak' => $no_acak, 'id_tahap' => '3', 'status' => 'N']);
                if ($histori_cart->exists()) {
                    $modelHistory = $histori_cart->one();
                } else {
                    $modelHistory = new \backend\models\HistoriAddcart();
                }
                $modelHistory->no_acak = $no_acak;
                $modelHistory->tgl_addcart = $tgl_masuk;
                $modelHistory->id_tahap = 3;
                $modelHistory->no_invoice = $no_invoice;
                $modelHistory->status = 'N';
                $modelHistory->save(false);
                //insert ke detail_pembyaran

                $modelDetailPembayaran = new \backend\models\DetailPembayaran();
                $modelDetailPembayaran->no_acak = $no_acak;
                $modelDetailPembayaran->no_invoice = $no_invoice;
                $modelDetailPembayaran->id_metode_pembayaran = $id_metode_pembayaran;
                $modelDetailPembayaran->id_ref_kurir = $id_ref_kurir;
                $modelDetailPembayaran->tgl_dikirim = $tgl_dikirim;
                $modelDetailPembayaran->jam_dikirim = $jam_dikirim;
                $modelDetailPembayaran->save(false);
                
                ///barang item masuk dalam booking system langsung penguranan stok sementara
                foreach ($dataItem as $valueItem) {
                    $stokBarang = \backend\models\StokBarang::find()->where([
                        'id_data_barang'=>$valueItem['id_data_barang']]);
                    if($stokBarang->exists()){
                        //data Barang
                        $databarang = DataBarang::findOne($valueItem['id_data_barang']);
                        $stokBarang = $stokBarang->one();
                        $stokBarang->isNewRecord=false;
                        $stokBarang->stok_akhir = $valueItem['qty'];
                        $stokBarang->stok_sisa = \backend\models\StokBarang::getSisaQty($databarang['id_data_agen'], $valueItem['id_data_barang'])-$valueItem['qty'];
                        $stokBarang->stok_awal = \backend\models\StokBarang::getQty($databarang['id_data_agen'], $valueItem['id_data_barang'])-$valueItem['qty'];
                        $stokBarang->save(false);
                    }
                }
                return $this->redirect(['konfirmasi-payment',
                            'no_invoice' => $model->no_invoice
                ]);
            }
        }
        return $this->render('checkout-payment', [
                    //   'no_invoice'=>$no_invoice,
                    // 'model'=>$model,
                    //'modelBank'=>$modelBank,
                    'model' => $model,
                    'dataItem' => $dataItem,
                    'modelRefKurir' => $modelRefKurir,
                    'listMetodePembayaran' => $listMetodePembayaran,
                    'refJam' => $refJam
        ]);
    }

    public function actionKonfirmasiPayment($no_invoice) {

        $model = PembayaranJualbeli::findOne(['no_invoice' => $no_invoice]);
        $modelBank = RefBank::getDropdownbank();
        $no_acak = Yii::$app->user->identity->no_acak;
        $tgl_masuk = date('Y-m-d');

        $dataItem = CheckoutItem::find()->where(['no_invoice' => $no_invoice])->all();
        //detail pembyaran
        $modelDetailPembayaran = \backend\models\DetailPembayaran::find()->where(['no_acak' => $no_acak, 'no_invoice' => $no_invoice])->one();

        if ($model->load(Yii::$app->request->post())) {
            $model->id_status_pembayaran = 1;

            $modelDaftar = \backend\models\DaftarInvoice::find()->where(['no_invoice' => $no_invoice])->one();
            $modelDaftar->bayar = 'Y';
            if ($modelDaftar->save()) {
                $histori_cart = \backend\models\HistoriAddcart::find()->where(['no_acak' => $no_acak, 'id_tahap' => '3', 'status' => 'N']);
                if ($histori_cart->exists()) {
                    $modelHistory = $histori_cart->one();
                } else {
                    $modelHistory = new \backend\models\HistoriAddcart();
                }
                $modelHistory->no_acak = $no_acak;
                $modelHistory->tgl_addcart = $tgl_masuk;
                $modelHistory->id_tahap = 3;
                $modelHistory->status = 'Y';
                $modelHistory->save(false);

                $model->save(false);
                return $this->redirect(['view', 'no_invoice' => $no_invoice]);
            }
        }
        if ($modelDetailPembayaran['id_metode_pembayaran']=='3') { //TOKO
            return $this->render('konfirmasi-payment-toko', [
                        'model' => $model,
                        'modelDetailPembayaran' => $modelDetailPembayaran,
                        'dataItem' => $dataItem,
                        'dataItem' => $dataItem,
            ]);
        }elseif($modelDetailPembayaran['id_metode_pembayaran']=='1'){ //Komisi
            return $this->render('konfirmasi-payment-aplikasi', [
                        'model' => $model,
                        'modelDetailPembayaran' => $modelDetailPembayaran,
                        'dataItem' => $dataItem,
                        'dataItem' => $dataItem,
            ]);
        }elseif($modelDetailPembayaran['id_metode_pembayaran']=='2'){ //COD
        return $this->render('konfirmasi-payment', [
                    'model' => $model,
                    'modelBank' => $modelBank
        ]);
        }
    }

    public function actionView($no_invoice) {
        $dataItem = CheckoutItem::find()->where(['no_invoice' => $no_invoice])->all();
        return $this->render('view', [
                    'dataItem' => $dataItem
        ]);
    }

    ///produk

    public function actionSemua() {
        $no_acak = Yii::$app->user->identity->no_acak;
        $dataItemSelesai = (new Query())
                        ->select('a.id_data_barang,a.no_acak,b.item_barang,a.id,b.filename')
                        ->from('checkout_item a')
                        ->innerJoin('data_barang b', 'a.id_data_barang=b.id')
                        ->innerJoin('pembayaran_jualbeli c', 'c.no_invoice=a.no_invoice and c.id_status_pembayaran=2')
                        ->groupBy('a.no_invoice,a.no_acak')->where(['a.no_acak' => $no_acak])->all();

        return $this->render('semua-produk', [
                    'dataItemSelesai' => $dataItemSelesai
        ]);
    }
    public function actionSemuaCheckout() {
        $no_acak = Yii::$app->user->identity->no_acak;
        $dataItemSelesai = (new Query())
                        ->select('a.no_invoice,a.id_data_barang,a.no_acak,b.item_barang,a.id,b.filename')
                        ->from('checkout_item a')
                        ->innerJoin('data_barang b', 'a.id_data_barang=b.id')
                        ->groupBy('a.no_invoice,a.no_acak')->where(['a.no_acak' => $no_acak])->orderBy('no_invoice')->all();

        return $this->render('semua-produk-checkout', [
                    'dataItemSelesai' => $dataItemSelesai
        ]);
    }
    public function actionKonfirmasiBayar() {
        $this->layout = 'menu-data-pribadi';
        $no_acak = Yii::$app->user->identity->no_acak;
        $dataItemSelesaipembayaran = (new Query())
                        ->select('a.id_data_barang,a.no_invoice,a.no_acak,b.item_barang,a.id,b.filename,c.id_status_pembayaran')
                        ->from('checkout_item a')
                        ->innerJoin('data_barang b', 'a.id_data_barang=b.id')
                        ->innerJoin('pembayaran_jualbeli c', 'c.no_invoice=a.no_invoice and c.id_status_pembayaran=3')
                        ->groupBy('a.no_invoice,a.no_acak')->where(['a.no_acak' => $no_acak]); //->all();
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $dataItemSelesaipembayaran
        ]);
        return $this->render('konfirmasi-bayar', [
                    'dataProvider' => $dataProvider
        ]);
    }

    public function actionVerifikasi() {
        $no_acak = Yii::$app->user->identity->no_acak;
        $dataItemverifikasi = (new Query())
                        ->select('a.id_data_barang,a.no_acak,b.item_barang,a.id,b.filename')
                        ->from('checkout_item a')
                        ->innerJoin('data_barang b', 'a.id_data_barang=b.id')
                        ->innerJoin('pembayaran_jualbeli c', 'c.no_invoice=a.no_invoice and c.id_status_pembayaran=1')
                        ->groupBy('a.no_invoice,a.no_acak')->where(['a.no_acak' => $no_acak])->all();

        return $this->render('verifikasi', [
                    'dataItemverifikasi' => $dataItemverifikasi
        ]);
    }

}
