<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\base\DynamicModel;
use backend\models\Addcart;
use yii\db\Query;
use backend\models\CheckoutItem;
use backend\models\RefBank;
use backend\models\PembayaranJualbeli;
use backend\models\MetodePembayaran;
use backend\models\RefKurir;
use backend\models\DetailPembayaran;
use yii\data\Pagination;
use Pusher\Pusher;
use backend\models\AturMarginItem;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use backend\models\DataToko;

class ProdukController extends Controller {

    public $no_acak_promo, $no_acak_stokis, $tingkatan;

    public function init() {
        parent::init();
        if (!Yii::$app->user->isGuest) {
            $no_acak = Yii::$app->user->identity->no_acak;
            $this->no_acak_stokis = $no_acak;
            $role_id = Yii::$app->user->identity->role_id;
            if (in_array($role_id, ['3', '4', '5', '6'])) {//pasok,niaga
                $dataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak])->one();
                $no_acak_referensi = $dataAgen['no_acak_ref'];

                //  if($dataAgen['id_ref_agen']=='3'){

                $tingkat = 0;
                for ($tingkat = 0; $tingkat < 10; $tingkat++) {
                    $dataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak_referensi, 'id_ref_agen' => ['1', '7']]);
                    if ($dataAgen->exists()) {
                        $no_acak_referensi = $dataAgen->one()->no_acak;
                        $this->no_acak_promo = $no_acak_referensi;
                        $tingkat = 11;
                    } else {
                        $dataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak_referensi])->one();
                        $no_acak_referensi = $dataAgen['no_acak_ref'];
                    }
                }
                if ($tingkat == 0) {
                    $this->tingkatan = 0;
                } else {
                    $this->tingkatan = $tingkat;
                }
                // 
                // if($dataAgen['id_ref_agen']=='3'){ //1 tingkat niaga
                //     $no_acak_referensi = $dataAgen['no_acak_ref'];
                // }
                //  }
            }
            if (in_array($role_id, ['2', '6'])) {
                $this->no_acak_promo = $no_acak;
            }
        }
    }

    public function actionSearchProduk($get_id_data_agen = null) {
        $this->layout = "main-belanja";
        $datagen = \backend\models\DataAgen::find()->where(['no_acak' => $this->no_acak_promo])->one();

        $id_data_agen = $datagen['id'];
        if ($get_id_data_agen) {
            $id_data_agen = $get_id_data_agen;
        }

        //cek status toko
        $dataTokoCek = DataToko::find()->where(['id_data_agen' => $id_data_agen]);
        if (!$dataTokoCek->exists()) {
            return $this->render('toko-noaktif');
        } else {
            $dataToko = $dataTokoCek->one();
            //cek jadwal toko
            $hari = date('N');
            // $jamnow = date('h:i:s');
            $modelCekJadwalToko = \backend\models\DetailToko::find()
                    ->where(['id_data_toko' => $dataToko['id']])
                    ->andWhere(['hari' => $hari, 'aktif' => "Y"])
                    ->andWhere('CURRENT_TIME()  BETWEEN jam_awal and jam_akhir');
            if (!$modelCekJadwalToko->exists()) {
                $modelJadwalToko = \backend\models\DetailToko::find()
                                ->where(['id_data_toko' => $dataToko['id']])->all();

                return $this->render('toko-jadwal', [
                            'modelJadwalToko' => $modelJadwalToko
                ]);
            }
        }

        //cek jadwal toko
        $no_acak = Yii::$app->user->identity->no_acak;
        $role_id = Yii::$app->user->identity->role_id;
        if (!$this->no_acak_promo) {
            Yii::$app->session->setFlash('danger', 'Agen Toko disekitar tidak ditemukan? silahkan hubungi admin BP untuk informasi lebih lengkap');
            return $this->redirect(['/']);
        }
        if (!\backend\models\DataAgen::cekIdAgenExists($no_acak)) {
            //     Yii::$app->session->setFlash('danger','Pastikan anda sudah mengisi data pribadi');
            return $this->redirect(['/site/data-agen-exists']);
        }
        $modelKabupaten = \backend\models\Kabupaten::dropdownlist();

        $dataAnggota = \backend\models\DataAnggota::find()->where(['no_acak' => $no_acak])->one();
        $no_acak_referensi = $dataAnggota['no_acak_agen'];
//
//        $datagen = \backend\models\DataAgen::find()->where(['no_acak' => $this->no_acak_promo])->one();
//
//        $id_data_agen = $datagen['id'];


        $query = \backend\models\DataBarang::getDataBarangAllByIdAgen($id_data_agen);
//        $countQuery = clone $query;
//        $pages = new Pagination(['totalCount'=>$countQuery->count(),'pageSize'=>10]);
//        $dataBarang =$query->offset($pages->offset)
//                ->limit($pages->limit)
//        ->all();
        //form dynamic
        $modelDynamic = new DynamicModel(['nama_item', 'id_data_agen']);
        $modelDynamic->addRule(['id_data_agen', 'nama_item'], 'string');
        if ($modelDynamic->load(Yii::$app->request->get())) {
            $id_data_agen = $modelDynamic->id_data_agen;

            $nama_item = $modelDynamic->nama_item;

            $query = \frontend\models\QueryModel::getDataBarangAllByFilterIdAgen($id_data_agen, $nama_item);
        }
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 12]);
        $dataBarang = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

        return $this->render('search-produk', [
                    'databarang' => $dataBarang,
                    'pages' => $pages,
                    'modelDynamic' => $modelDynamic,
                    'id_data_agen' => $id_data_agen,
                    'modelKabupaten' => $modelKabupaten,
        ]);
    }

    public function actionAddCart($id_data_barang) {
        $modelDynamic = new DynamicModel(['qty']);
        $modelDynamic->addRule('qty', 'integer');
        $no_acak = Yii::$app->user->identity->no_acak;

        //buat invoice duluan sanak supaya kada bentrok
        //cek hulu pembayarannya dengan invoice/no acak nang ada


        if ($modelDynamic->load(Yii::$app->request->post())) {
            $dataStok = \backend\models\StokBarang::find()->where(['id_data_barang' => $id_data_barang])->one();
            if ($dataStok['stok_sisa'] < $modelDynamic->qty) {
                Yii::$app->session->setFlash('warning', 'Stok melebihi batas');
                return $this->redirect(Yii::$app->request->referrer);
            }
            $modelEx = Addcart::find()->where(['no_acak' => $no_acak, 'id_data_barang' => $id_data_barang]);
            $qtylama = 0;
            if ($modelEx->exists()) {
                $model = $modelEx->one();
                $qtylama = $model['qty'];
            } else {
                $model = new Addcart();
            }
            $tgl_masuk = date('Y-m-d');
            $model->pilih = 'N';
            $model->no_acak = $no_acak;
            $model->id_data_barang = $id_data_barang;
            $model->id_data_agen = 0;
            $model->qty = $qtylama + $modelDynamic->qty;
            $model->harga_jual = $dataStok->harga_jual;
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

    public function actionPilihMetodePembayaran() {
        $this->layout = "main-belanja";
        $model = MetodePembayaran::find()->all();
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('pilih-metode-pembayaran', [
                        'model' => $model
            ]);
        }
        return $this->render('pilih-metode-pembayaran', [
                    'model' => $model
        ]);
    }

    public function actionPilihMetodePembayaranAjax() {

        $model = MetodePembayaran::find()->all();
        return $this->renderAjax('pilih-metode-pembayaran-ajax', [
                    'model' => $model]);
    }

    public function actionListKeranjang() {
        $this->layout = "main-belanja";
        $no_acak = Yii::$app->user->identity->no_acak;

        $query = Addcart::find()->where([
            'no_acak' => $no_acak, 'pilih' => 'N'
        ]);

        if (Yii::$app->request->post('selection')) {
            $selection = Yii::$app->request->post('selection');
            foreach ($selection as $val) {
                $modelCart = Addcart::findOne($val);
                $modelCart->pilih = 'Y';
                $modelCart->save(false);
            }
            return $this->redirect(['list-keranjang-terpilih']);
        }
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query
        ]);
        return $this->render('list-keranjang', [
                    'dataProvider' => $dataProvider
        ]);
    }

    public function actionListKeranjangTerpilih() {
        $this->layout = "main-belanja";
        $no_acak = Yii::$app->user->identity->no_acak;

        $query = Addcart::find()->where([
            'no_acak' => $no_acak, 'pilih' => 'Y'
        ]);


        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query
        ]);
        return $this->render('list-keranjang-terpilih', [
                    'dataProvider' => $dataProvider
        ]);
    }

    public function actionBatalKeranjang($id) {

        $modelCart = Addcart::findOne($id);
        $modelCart->pilih = 'N';
        $modelCart->save(false);
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionHapusKeranjang($id) {

        $modelCart = Addcart::findOne($id);
        $modelCart->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionCheckout($id_metode_pembayaran = null) {
//data agen
        $modelDataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $this->no_acak_promo])->one();
        $dataToko = DataToko::find()->where([
                    'id_data_agen' => $modelDataAgen['id']
                ])->one();
        $this->layout = "main-belanja";
        $no_acak = Yii::$app->user->identity->no_acak;
        $dataItem = (new Query())
                ->select(['a.id_data_barang,a.tgl_masuk,b.item_barang,a.id,a.qty,max(d.harga_jual) harga_jual,(a.qty*max(d.harga_jual)) as total,
                    b.filename,d.stok_sisa,bb.nama_satuan,
	case 
	when d.stok_sisa=0 then "Stok Sudah Habis"
	when  a.qty > d.stok_sisa then "Stok Kurang"
	ELSE "-"
	END status_qty,
		case 
	when d.stok_sisa=0 then "X"
	when  a.qty > d.stok_sisa then "N"
	ELSE "Y"
	END kode_status_qty'])
                ->from('addcart a')
                ->innerJoin('data_barang b', 'a.id_data_barang=b.id')
                ->innerJoin('ref_satuan_barang bb','b.id_ref_satuan_barang=bb.id')
                ->innerJoin('transaksi_barang c', 'a.id_data_barang=c.id_data_barang')
                ->innerJoin('stok_barang d', 'a.id_data_barang=d.id_data_barang')
                ->where(['a.no_acak' => $no_acak, 'a.pilih' => 'Y'])
                ->groupBy('a.id_data_barang,a.no_acak');
        if (!$dataItem->exists()) {
            Yii::$app->session->setFlash('warning', 'Keranjang Kosong');
            return $this->render('keranjang-kosong');
        } else {
            $dataItem = $dataItem->all();
        }
        $modelMetodePembayaran = MetodePembayaran::getDropdownlist();
        $harini = date('N'); //Yii::$app->setting->hari(date('N'));
        $modelRefKurir = RefKurir::getDropdownlistByHari($harini); //RefKurir::getDropdownlist();
        $model = new CheckoutItem();
        $model->id_metode_pembayaran = $id_metode_pembayaran;
//        $dataProvider = new \yii\data\ActiveDataProvider([
//            'query'=>$dataItem
//        ]);
        //Addcart::find()->where(['no_acak'=>$no_acak])->all();
        $refJam = \backend\models\RefJam::findAll(['aktif' => 'Y']);
        //     if (Yii::$app->request->post('pilih')) {
        $id = Yii::$app->request->post('pilih');

            $hari = date('N');
            $modelJadwalToko = \backend\models\DetailToko::find()
                            ->where(['id_data_toko' => $dataToko['id']])
                            ->andWhere(['hari' => $hari, 'aktif' => "Y"])->one();
        $saldo = \backend\models\DataSaldo::findOne(['no_acak' => $no_acak]);
        if ($model->load(Yii::$app->request->post())) {

            if (in_array($model->id_metode_pembayaran, ['1'])) {
                if ($model->total > $saldo['nominal_awal']) {
                    Yii::$app->session->setFlash('danger', 'Saldo tidak cukup');
                    return $this->redirect(Yii::$app->request->referrer);
                }
            }

            if (in_array($model->id_metode_pembayaran, ['3'])) {

                $modelCekJadwalToko = \backend\models\DetailToko::find()
                        ->where(['id_data_toko' => $dataToko['id']])
                        ->andWhere(['hari' => $hari, 'aktif' => "Y"])
                        ->andWhere('CAST(:jamdkirim as time)   BETWEEN jam_awal and jam_akhir', [
                    ':jamdkirim' => $model->jam_dikirim
                ]);
                if (!$modelCekJadwalToko->exists()) {
                    Yii::$app->session->setFlash('danger', 'Toko Tutup');
                    return $this->redirect(Yii::$app->request->referrer);
                }
            }
            $no_invoice = \backend\models\QueryModel::noinvoice();
            $no_acak_booking = \backend\models\QueryModel::noacak();

            $modelDetailPembayaran = new \backend\models\DetailPembayaran();
            $modelDetailPembayaran->no_acak = $no_acak;
            $modelDetailPembayaran->no_invoice = $no_invoice;
            $modelDetailPembayaran->id_metode_pembayaran = $model->id_metode_pembayaran;
            $modelDetailPembayaran->id_ref_kurir = $model->id_ref_kurir;
            $modelDetailPembayaran->tgl_dikirim = $model->tgl_dikirim;
            $modelDetailPembayaran->jam_dikirim = $model->jam_dikirim;
            $modelDetailPembayaran->ongkir = $model->ongkir;
            $modelDetailPembayaran->save(false);

            $modelJualBeli = new \backend\models\PembayaranJualbeli();
            $modelJualBeli->no_acak = $no_acak;
            $modelJualBeli->no_invoice = $no_invoice;
            $modelJualBeli->no_virtual_akun = $no_acak;
            $modelJualBeli->no_berita = $no_invoice;
            $id_status_pembayaran = 3;
            //      if($model->id_metode_pembayaran=='2'){

            $msg = 'Belanja Barang Masuk,Cek No Invoice : #' . $no_invoice;
            $data['message'] = $msg;
            $app_id = '946345';
            $app_key = 'd9d09bafc66e41e27f56';
            $app_secret = 'fcd37921714e72c982b4';
            $options = array(
                'cluster' => 'mt1',
                'useTLS' => true
            );
            $pusher = new Pusher($app_key, $app_secret, $app_id, $options);
            $pusher->trigger($this->no_acak_promo, 'my_event', $data);
            //         }
            $modelJualBeli->id_status_pembayaran = $id_status_pembayaran;
            $modelJualBeli->save(false);
            foreach ($id as $val) {
                //data barang
                $dataItemOne = (new Query())
                                ->select('a.id_data_barang,b.id_ref_barang,a.no_acak,a.tgl_masuk,b.item_barang,a.id,a.qty,b.harga_satuan,max(dd.harga_jual) harga_jual,(a.qty*max(dd.harga_jual)) as total,b.filename,d.nama_toko,d.id as id_data_toko')
                                ->from('addcart a')
                                ->innerJoin('data_barang b', 'a.id_data_barang=b.id')
                                ->innerJoin('transaksi_barang c', 'a.id_data_barang=c.id_data_barang')
                                ->innerJoin('stok_barang dd', 'a.id_data_barang=dd.id_data_barang')
                                ->innerJoin('data_toko d', 'b.id_data_agen=d.id_data_agen')
                                ->groupBy('a.id_data_barang,a.no_acak')->where(['a.id' => $val])->one();
                //   return var_dump($val);
                $no_acak = $dataItemOne['no_acak'];
                $id_data_barang = $dataItemOne['id_data_barang'];
                $nama_item = $dataItemOne['item_barang'];
                $qty = $dataItemOne['qty'];
              //  $total = $dataItemOne['total'];
                      $tgl_masuk = $dataItemOne['tgl_masuk'];
                $tgl_invoice = date('Y-m-d');
                $id_ref_barang = $dataItemOne['id_ref_barang'];
                $harga_satuan = $dataItemOne['harga_satuan'];
                $aturMargin = AturMarginItem::find()->where(['id_ref_barang' => $id_ref_barang])->one();
                $persen_margin = $aturMargin['nilai'] / 100;

                $margin_item = $harga_satuan * $persen_margin;
                $margin_total = $qty * $margin_item;
                //$harga_jual =$dataItemOne['harga_jual']; //
                $harga_jual=$margin_item + $harga_satuan;
   $total = $qty*$harga_jual;
           
                $modelCheckout = new CheckoutItem();
                $modelCheckout->isNewRecord = true;
                $modelCheckout->id = null;
                $modelCheckout->no_acak = $no_acak;
                $modelCheckout->ongkir = $model->ongkir;
                $modelCheckout->id_data_barang = $id_data_barang;
                $modelCheckout->nama_item = $nama_item;
                $modelCheckout->harga_satuan=$harga_satuan;
                $modelCheckout->harga_jual = $harga_jual;
                $modelCheckout->qty = $qty;
                $modelCheckout->total = $total;
                $modelCheckout->no_invoice = $no_invoice;
                $modelCheckout->tgl_invoice = $tgl_invoice;
                $modelCheckout->tgl_masuk = $tgl_masuk;
                $modelCheckout->id_data_toko = $dataItemOne['id_data_toko'];
                $modelCheckout->save(false);

                if (in_array($model->id_metode_pembayaran, ['3'])) {

                    $stokbarangModel = \backend\models\StokBarang::find()->where(['id_data_barang' => $id_data_barang])->one();
                    $detailPembayaran = \backend\models\DetailPembayaran::find()->where(['no_invoice' => $no_invoice])->one();
                    //   $id_data_barang = $value['id_data_barang'];
                    $modelBooking = new \backend\models\BookingBarang();
                    $modelBooking->kd_booking = $no_acak_booking;
                    $modelBooking->isNewRecord = true;
                    $modelBooking->id = null;
                    $modelBooking->id_stok_barang = $stokbarangModel['id'];
                    $modelBooking->harga_satuan = $harga_satuan;
                    $modelBooking->qty_keluar = $qty;
                    $modelBooking->no_invoice = $no_invoice;
                    $modelBooking->no_acak = $no_acak;
                    $modelBooking->status_booking = '1'; //Ya booking
                    $modelBooking->tgl_batas_book = date('Y-m-d');
                    $modelBooking->jam_batas_book = $detailPembayaran['jam_dikirim'];
                    $modelBooking->save(false);
                }
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

            return $this->redirect(['list-checkout-payment']);
        }
        //   }

        return $this->render('checkout-item', [
                    'dataItem' => $dataItem,
                    'no_acak' => $no_acak,
                    'model' => $model,
                    'modelMetodePembayaran' => $modelMetodePembayaran,
                    'modelRefKurir' => $modelRefKurir,
                    'refJam' => $refJam,
                    'saldo' => $saldo,
                    'modelJadwalToko' => $modelJadwalToko
        ]);
    }

    public function actionListCheckoutPayment($status_pembayaran = null) {

        $this->layout = "main-belanja";
        $no_acak = Yii::$app->user->identity->no_acak;
        $dataCheckOutItem = (new Query())
                ->select(['b.no_invoice,sum(b.total) sum_total,b.ongkir,b.nama_item,b.tgl_invoice as tgl_masuk,a.id_status_pembayaran,d.id_metode_pembayaran,c.status_pembayaran,f.status_pesanan_kurir, '
                    . 'if(d.id_metode_pembayaran=2,"",e.status_booking) status_booking'])
                ->from('pembayaran_jualbeli a')
                ->rightJoin('checkout_item b', 'a.no_invoice=b.no_invoice')
                ->innerJoin('data_barang bb','b.id_data_barang=bb.id')
                ->leftJoin('status_pembayaran c', 'a.id_status_pembayaran=c.id')
                ->leftJoin('detail_pembayaran d', 'b.no_invoice=d.no_invoice')
                ->leftJoin('(SELECT * FROM booking_barang xx GROUP BY xx.no_invoice) e', 'e.no_invoice=b.no_invoice')
                ->leftJoin('detail_pembayaran_kurir f', 'd.no_invoice=f.no_invoice')
                ->where(['b.no_acak' => $no_acak]);
        if ($status_pembayaran) {
            $dataCheckOutItem->andWhere(['a.id_status_pembayaran' => $status_pembayaran]);
        }
        $dataCheckOutItem->groupBy('b.no_invoice')->orderBy('b.id DESC');
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $dataCheckOutItem
        ]);

        return $this->render('list-checkout-payment', [
                    'dataProvider' => $dataProvider
        ]);
    }

    public function actionCheckoutPayment($no_invoice) {


        $no_acak = Yii::$app->user->identity->no_acak;
        $dataItem = CheckoutItem::find()->where(['no_invoice' => $no_invoice])->all();
        $modelCek = PembayaranJualbeli::find()->where(['no_invoice' => $no_invoice]);
        if ($modelCek->exists()) {
            $model = $modelCek->one();
        } else {
            $model = new \backend\models\PembayaranJualbeli();
        }
        $modelDetailPembayaran = new \backend\models\DetailPembayaran();
        $detailPembayaran = \backend\models\DetailPembayaran::find()->where(['no_invoice' => $no_invoice])->one();
        $tgl_masuk = date('Y-m-d');
        if ($model->load(Yii::$app->request->post())) {
            $modelDaftarInvoice = new \backend\models\DaftarInvoice();
            $modelDaftarInvoice->no_acak = $no_acak;
            $modelDaftarInvoice->no_invoice = $no_invoice;
            $modelDaftarInvoice->bayar = 'N';
            if ($modelDaftarInvoice->save()) {
                $id_status_pembayaran = 3;
                if ($detailPembayaran->id_metode_pembayaran == '2') {
                    $id_status_pembayaran = 2;
                }
                $model->id_status_pembayaran = $id_status_pembayaran;
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

                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        return $this->render('checkout-payment', [
                    //   'no_invoice'=>$no_invoice,
                    // 'model'=>$model,
                    //'modelBank'=>$modelBank,
                    'model' => $model,
                    'dataItem' => $dataItem,
                    'detailPembayaran' => $detailPembayaran
        ]);
    }

    public function actionCheckoutPaymentCod($no_invoice) {


        $no_acak = Yii::$app->user->identity->no_acak;
        $dataItem = CheckoutItem::find()->innerJoin('data_barang','checkout_item.id_data_barang=data_barang.id')->where(['no_invoice' => $no_invoice])->all();
        $modelCek = PembayaranJualbeli::find()->where(['no_invoice' => $no_invoice]);

        $model = $modelCek->one();


        $modelDetailPembayaran = new \backend\models\DetailPembayaran();
        $detailPembayaran = \backend\models\DetailPembayaran::find()->where(['no_invoice' => $no_invoice])->one();
        $modelDetailPembayaranKurir = \backend\models\DetailPembayaranKurir::find()->where(['no_invoice' => $no_invoice])->one();
        $tgl_masuk = date('Y-m-d');
        if ($model->load(Yii::$app->request->post())) {
            $modelDetailPembayaranKurir = \backend\models\DetailPembayaranKurir::find()->where(['no_invoice' => $no_invoice]);
            if ($modelDetailPembayaranKurir->exists()) {
                $model->id_status_pembayaran = 2;
                $model->save(false);

                $modelDetailPembayaranKurir = $modelDetailPembayaranKurir->one();
                $modelDetailPembayaranKurir->status_pesanan_kurir = 1;
                $modelDetailPembayaranKurir->save(false);

                //history belanja
                $modelHistoryBelanja = new \backend\models\HistoryBelanja();
                $modelHistoryBelanja->no_invoice = $no_invoice;
                $modelHistoryBelanja->status_belanja = 1;
                $modelHistoryBelanja->save(false);

                Yii::$app->session->setFlash('success', 'Barang Sudahh Diterima');
            } else {
                Yii::$app->session->setFlash('info', 'Menunggu dikonfirmasi');
            }

            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('checkout-payment-cod', [
                    //   'no_invoice'=>$no_invoice,
                    // 'model'=>$model,
                    //'modelBank'=>$modelBank,
                    'model' => $model,
                    'dataItem' => $dataItem,
                    'detailPembayaran' => $detailPembayaran,
                    'modelDetailPembayaranKurir' => $modelDetailPembayaranKurir
        ]);
    }

    public function actionCheckoutPaymentCodKurir($no_invoice) {


        $dataItem = CheckoutItem::find()
                ->innerJoin('data_barang','checkout_item.id_data_barang=data_barang.id')->where(['checkout_item.no_invoice' => $no_invoice])->all();
        $dataItemNoAcak = CheckoutItem::find()->where(['no_invoice' => $no_invoice])->one();
        $no_acak = $dataItemNoAcak['no_acak'];
        $dataAgenx = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak])->one();
        $modelCek = PembayaranJualbeli::find()->where(['no_invoice' => $no_invoice]);
        if ($modelCek->exists()) {
            $model = $modelCek->one();
        } else {
            $model = new \backend\models\PembayaranJualbeli();
        }
        //      $modelDetailPembayaran = new \backend\models\DetailPembayaran();
        $dataAgenPenerima = \backend\models\DataAgen::find()->where(['no_acak' => $dataItemNoAcak['no_acak']])->one();
        $detailPembayaran = \backend\models\DetailPembayaran::find()->where(['no_invoice' => $no_invoice])->one();
        $tgl_masuk = date('Y-m-d');
        $transaksiBarang = \backend\models\TransaksiBarang::find()->where(['no_invoice' => $no_invoice]);
        if ($model->load(Yii::$app->request->post())) {
//            if ($model->nominal_ojek != $model->total_bayar) {
//                Yii::$app->session->setFlash('danger', 'Gagal Konfirmasi, Nominal Pembayaran tidak sama dengan Total Belanja' . $model->nominal_ojek . '}' . $model->total_bayar);
//                return $this->redirect(Yii::$app->request->referrer);
//            }
            foreach ($dataItem as $valItem) {
                $dataBarang = \backend\models\DataBarang::findOne($valItem['id_data_barang']);
                
                //cek barang ditoko siapa
                $dataToko = DataToko::find()->where(['id_data_agen'=>$dataBarang['id_data_agen']])->one();
                $id_ref_barang = $dataBarang['id_ref_barang'];
                $modelTransaksi = new \backend\models\TransaksiBarang();
                $modelTransaksi->isNewRecord = true;
                $modelTransaksi->id = null;
                $modelTransaksi->no_invoice = $no_invoice;
                $modelTransaksi->nama_item = $dataBarang['item_barang'];
                $modelTransaksi->tgl_transaksi = $valItem['tgl_masuk'];//('Y-m-d');
                $modelTransaksi->id_data_agen = $dataAgenx['id'];
                $modelTransaksi->id_data_barang = $valItem['id_data_barang'];
                $modelTransaksi->id_data_toko=$dataToko['id'];
                $modelTransaksi->qty = $valItem['qty'];
                $modelTransaksi->barkode = $dataBarang['barkode'];
                $harga_satuan = $dataBarang['harga_satuan'];
                $modelTransaksi->harga_satuan = $harga_satuan;
                $modelTransaksi->duit_tunai = $model->nominal_ojek;
                $modelTransaksi->duit_kembali = $model->duit_kembali;

                $margin = \backend\models\AturMarginItem::findOne(['id_ref_barang' => $dataBarang['id_ref_barang']]);
//
                $persen_margin = ($margin['nilai'] / 100);
                $margin_item = $harga_satuan * $persen_margin;
               $margin_total = $valItem['qty'] * $margin_item;
                $harga_jual =$harga_satuan+$margin_item;//$valItem['harga_jual'];
//                $total_jual = $valItem['qty'] * $harga_jual;

                $modelTransaksi->margin_item = $margin_item;
                $modelTransaksi->harga_jual = $harga_jual;
                $modelTransaksi->margin_total = $margin_total;
                $modelTransaksi->tgl_transaksi = $valItem['tgl_invoice'];//date('Y-m-d');
                $modelTransaksi->keterangan = 'OUT';
                $modelTransaksi->total_jual = ($harga_jual * $valItem['qty']);// + (($harga_jual * $valItem['qty']) * (10 / 100));
                $modelTransaksi->no_acak_pembeli = $dataItemNoAcak['no_acak'];

                $modelTransaksi->save(false);
                $stokBarang = \backend\models\StokBarang::find()->where([
                    'id_data_barang' => $valItem['id_data_barang']]);
                if ($stokBarang->exists()) {
                    //data Barang
                    $databarang = \backend\models\DataBarang::findOne($valItem['id_data_barang']);
                    $id_ref_barang = $databarang['id_ref_barang'];
                    $stokBarang = $stokBarang->one();
                    $stok_sisa_sebelumnya = $stokBarang->stok_sisa;
                    $stokBarang->isNewRecord = false;
                    $stokBarang->stok_akhir = \backend\models\StokBarang::getJlhQty($databarang['id_data_agen'], $valItem['id_data_barang']) + $valItem['qty'];
                    $stokBarang->stok_sisa = \backend\models\StokBarang::getSisaQty($databarang['id_data_agen'], $valItem['id_data_barang']) - $valItem['qty'];
                    //      $stokBarang->stok_awal = \backend\models\StokBarang::getQty($databarang['id_data_agen'], $valItem['id_data_barang']) - $valItem['qty'];
                    $stokBarang->save(false);
                    $modelRiwayatStokbarang = new \backend\models\RiwayatStokBarang();
                    $modelRiwayatStokbarang->isNewRecord = true;
                    $modelRiwayatStokbarang->id = null;
                    $modelRiwayatStokbarang->barkode = $stokBarang->barkode;
                    $modelRiwayatStokbarang->id_data_agen = $dataAgenx['id'];
                    $modelRiwayatStokbarang->id_data_barang = $valItem['id_data_barang'];
                    $modelRiwayatStokbarang->stok_awal = $stok_sisa_sebelumnya;
                    $modelRiwayatStokbarang->stok_akhir = $valItem['qty'];
                    $modelRiwayatStokbarang->stok_sisa = $stokBarang->stok_sisa;
                    $modelRiwayatStokbarang->no_invoice = $no_invoice;
                    $modelRiwayatStokbarang->save(false);
                }
                $detailDataAgen = \backend\models\DataAnggota::find()->where(['no_acak_agen' => $no_acak])->all(); //\frontend\models\DataDetailAgen::find()->where(['no_acak_referensi'=>$dataAgen['no_acak']])->all();//dicek pakai agen promo
            }
            $modelDaftarInvoice = new \backend\models\DaftarInvoice();
            $modelDaftarInvoice->no_acak = $no_acak;
            $modelDaftarInvoice->no_invoice = $no_invoice;
            $modelDaftarInvoice->bayar = 'N';
            if ($modelDaftarInvoice->save()) {
                $id_status_pembayaran = 3;
                if ($detailPembayaran->id_metode_pembayaran == '2') {
                    $id_status_pembayaran = 2;
                }
                $model->id_status_pembayaran = $id_status_pembayaran;
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
                Yii::$app->session->setFlash('success', 'sukses');
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        return $this->render('checkout-payment-cod-kurir', [
                    'no_invoice' => $no_invoice,
                    'transaksiBarang' => $transaksiBarang,
                    'dataAgenPenerima' => $dataAgenPenerima,
                    'model' => $model,
                    'dataItem' => $dataItem,
                    'detailPembayaran' => $detailPembayaran
        ]);
    }

    public function actionKonfirmasiPayment($no_invoice) {

        $model = PembayaranJualbeli::findOne(['no_invoice' => $no_invoice]);
        $modelDetailPembayaran = DetailPembayaran::findOne(['no_invoice' => $no_invoice]);
        $modelBank = RefBank::getDropdownbank();
        $no_acak = Yii::$app->user->identity->no_acak;
        $tgl_masuk = date('Y-m-d');

        $saldo = \backend\models\DataSaldo::findOne(['no_acak' => $no_acak]);
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
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        switch ($modelDetailPembayaran['id_metode_pembayaran']) {
            case '1':
                $dataItem = CheckoutItem::find()->where(['no_invoice' => $no_invoice])->all();
                return $this->render('konfirmasi-payment-aplikasi', [
                            'dataItem' => $dataItem,
                            'modelBank' => $modelBank,
                            'saldo' => $saldo,
                            'modelDetailPembayaran' => $modelDetailPembayaran
                ]);
                break;
            case '2': //COD
                $dataItem = CheckoutItem::find()->where(['no_invoice' => $no_invoice])->all();
                return $this->render('konfirmasi-payment-cod', [
                            'dataItem' => $dataItem,
                            'modelBank' => $modelBank,
                            'saldo' => $saldo,
                            'modelDetailPembayaran' => $modelDetailPembayaran
                ]);
                break;
            case '3': //TOKO
                $dataItem = CheckoutItem::find()->where(['no_invoice' => $no_invoice])->all();
                return $this->render('konfirmasi-payment-toko', [
                            'dataItem' => $dataItem,
                            'modelBank' => $modelBank,
                            'saldo' => $saldo,
                            'modelDetailPembayaran' => $modelDetailPembayaran
                ]);
                break;
        }
    }

    public function actionCariAgenPromoLain() {
        $modelKabupaten = \backend\models\Kabupaten::dropdownlist();


        $modelDynamic = new DynamicModel(['id_data_agenx', 'id_kab', 'id_kecamatan', 'id_kelurahan']);
        $modelDynamic->addRule(['id_kab', 'id_kecamatan', 'id_kelurahan', 'id_data_agenx'], 'string');
        if ($modelDynamic->load(Yii::$app->request->post())) {
            $id_kab = $modelDynamic->id_kab;
            $id_kecamatan = $modelDynamic->id_kecamatan;
            $id_kelurahan = $modelDynamic->id_kelurahan;
            $id_data_agen = $modelDynamic->id_data_agenx;

            return $this->redirect(['/produk/search-produk', 'get_id_data_agen' => $id_data_agen]);
        }

        return $this->renderAjax('cari-agen-promo-lain', [
                    'modelDynamic' => $modelDynamic,
                    'modelKabupaten' => $modelKabupaten,
        ]);
    }

    public function actionCheckoutPaymentToko($no_invoice) {


        $no_acak = Yii::$app->user->identity->no_acak;
        $dataItem = CheckoutItem::find()->where(['no_invoice' => $no_invoice])->all();
        $modelCek = PembayaranJualbeli::find()->where(['no_invoice' => $no_invoice]);

        $model = $modelCek->one();


        $modelDetailPembayaran = new \backend\models\DetailPembayaran();
        $detailPembayaran = \backend\models\DetailPembayaran::find()->where(['no_invoice' => $no_invoice])->one();
        $modelDetailPembayaranKurir = \backend\models\DetailPembayaranKurir::find()->where(['no_invoice' => $no_invoice])->one();
        $tgl_masuk = date('Y-m-d');
        if ($model->load(Yii::$app->request->post())) {
            $modelDetailPembayaranKurir = \backend\models\DetailPembayaranKurir::find()->where(['no_invoice' => $no_invoice]);
            if ($modelDetailPembayaranKurir->exists()) {
                $model->id_status_pembayaran = 2;
                $model->save(false);

                $modelDetailPembayaranKurir = $modelDetailPembayaranKurir->one();
                $modelDetailPembayaranKurir->status_pesanan_kurir = 1;
                $modelDetailPembayaranKurir->save(false);

                //history belanja
                $modelHistoryBelanja = new \backend\models\HistoryBelanja();
                $modelHistoryBelanja->no_invoice = $no_invoice;
                $modelHistoryBelanja->status_belanja = 1;
                $modelHistoryBelanja->save(false);

                Yii::$app->session->setFlash('success', 'Barang Sudahh Diterima');
            } else {
                Yii::$app->session->setFlash('info', 'Menunggu dikonfirmasi');
            }

            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('checkout-payment-toko', [
                    //   'no_invoice'=>$no_invoice,
                    // 'model'=>$model,
                    //'modelBank'=>$modelBank,
                    'model' => $model,
                    'dataItem' => $dataItem,
                    'detailPembayaran' => $detailPembayaran,
                    'modelDetailPembayaranKurir' => $modelDetailPembayaranKurir
        ]);
    }
public function actionBatalPesanan($no_invoice){
    CheckoutItem::deleteAll(['no_invoice'=>$no_invoice]);
    return $this->redirect(['/belanja/pembayaran-cod']);
}
public function actionBayarBatal($no_invoice){
            $status_booking = \backend\models\BookingBarang::find()->where(['no_invoice' => $no_invoice])->one()->status_booking;
       if($status_booking==2){
           Yii::$app->session->setFlash('danger','Barang sudah di konfirmasi oleh toko tidak bisa dibatalkan');
       }else{
    CheckoutItem::deleteAll(['no_invoice'=>$no_invoice]);
       }
    return $this->redirect(['list-checkout-payment']);
}
}
