<?php

namespace backend\controllers;

use Yii;
use backend\models\TransaksiBarang;
use backend\models\TransaksiBarangSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\DataBarang;
use backend\models\StokBarang;
use backend\models\AturMarginItem;

/**
 * TransaksiBarangController implements the CRUD actions for TransaksiBarang model.
 */
class TransaksiBarangController extends Controller {

    public $persen_margin;

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TransaksiBarang models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TransaksiBarangSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionListTransaksiBarang($id_data_barang, $id_data_agen) {
        $searchModel = new TransaksiBarangSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['id_data_barang' => $id_data_barang, 'id_data_agen' => $id_data_agen]);
        $dataBarang = (new \yii\db\Query())
                        ->select('a.*,b.filename as filename_barang')
                        ->from('data_barang a')
                        ->innerJoin('ref_barang b', 'a.id_ref_barang=b.id')->where(['a.id' => $id_data_barang])->one(); //DataBarang::find()->where(['id'=>$id_data_barang])->one();
        return $this->render('list-transaksi-barang', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'id_data_barang' => $id_data_barang,
                    'id_data_agen' => $id_data_agen,
                    'dataBarang' => $dataBarang
        ]);
    }

    /**
     * Displays a single TransaksiBarang model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TransaksiBarang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_data_barang, $id_data_agen) {

        $databarang = DataBarang::findOne($id_data_barang);

        $margin = AturMarginItem::findOne(['id_ref_barang' => $databarang['id_ref_barang']]);

        $this->persen_margin = ($margin['nilai'] / 100);
        $model = new TransaksiBarang();
        $model->nama_item = $databarang['item_barang'];
        $model->id_data_agen = $id_data_agen;
        $model->id_data_barang = $id_data_barang;
        $model->barkode = $databarang['barkode'];
        if ($model->load(Yii::$app->request->post())) {
            $model->margin_item = $model->harga_satuan * $this->persen_margin;
            $model->harga_jual = $model->harga_satuan + ($model->harga_satuan * $this->persen_margin);

            $model->tgl_transaksi = date('Y-m-d', strtotime($model->tgl_transaksi));
            $model->keterangan = 'IN';
            if ($model->save()) {
                $modelStok = StokBarang::find()->where(['id_data_barang' => $id_data_barang, 'id_data_agen' => $id_data_agen])->one();
                $modelStok->stok_awal = StokBarang::getQty($id_data_agen, $id_data_barang) + $model->qty;
                $modelStok->stok_sisa = $modelStok->stok_awal + $modelStok->stok_akhir;
                $modelStok->save(false);

                $modelRiwayatStokbarang = new \backend\models\RiwayatStokBarang();
                $modelRiwayatStokbarang->isNewRecord = true;
                $modelRiwayatStokbarang->id = null;
                $modelRiwayatStokbarang->barkode = $modelStok->barkode;
                $modelRiwayatStokbarang->id_data_agen = $id_data_agen;
                $modelRiwayatStokbarang->id_data_barang = $id_data_barang;
                $modelRiwayatStokbarang->stok_awal = $modelStok->stok_awal;
                $modelRiwayatStokbarang->stok_akhir = 0;
                $modelRiwayatStokbarang->stok_sisa = $modelStok->stok_sisa;
                $modelRiwayatStokbarang->no_invoice = 'IN';
                $modelRiwayatStokbarang->save(false);

                return $this->redirect(['list-transaksi-barang', 'id_data_barang' => $id_data_barang, 'id_data_agen' => $id_data_agen]);
            }
        }

        return $this->renderAjax('_form', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing TransaksiBarang model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_data_barang, $id_data_agen) {
        $model = new TransaksiBarang();

        $databarang = DataBarang::find()->where(['id' => $id_data_barang, 'id_data_agen' => $id_data_agen])->one();
        $model->nama_item = $databarang['item_barang'];
        $model->id_data_agen = $id_data_agen;
        $model->id_data_barang = $id_data_barang;
        $model->barkode = $databarang['barkode'];
        $harga_satuan = $databarang['harga_satuan'];
        $id_ref_barang = $databarang['id_ref_barang'];

        //margin
        $aturMargin = AturMarginItem::find()->where(['id_ref_barang' => $id_ref_barang])->one();
        $persen_margin = $aturMargin['nilai'] / 100;

        $margin_item = $harga_satuan * $persen_margin;
        $margin_total = $model->qty * $margin_item;
        $harga_jual = $margin_item + $harga_satuan;

        if ($model->load(Yii::$app->request->post())) {
            $aturMargin = AturMarginItem::find()->where(['id_ref_barang' => $id_ref_barang])->one();
            $persen_margin = $aturMargin['nilai'] / 100;

            $margin_item = $harga_satuan * $persen_margin;
            $margin_total = $model->qty * $margin_item;
            $harga_jual = $margin_item + $harga_satuan;

            $model->margin_item = $margin_item;
            $model->harga_jual = $harga_jual;
            $model->margin_total = $margin_total;
            $model->tgl_transaksi = date('Y-m-d');
            $model->total_jual = ($harga_jual * $model->qty) + (($harga_jual * $model->qty) * (10 / 100));
            ;
            $model->keterangan = 'OUT';
            if ($model->save()) {
                $modelStok = StokBarang::find()->where(['id_data_barang' => $id_data_barang, 'id_data_agen' => $id_data_agen])->one();
                $stok_sisa_sebelumnya = $modelStok->stok_sisa;
                $modelStok->stok_akhir = $model->qty;
                $modelStok->stok_awal = StokBarang::getQty($id_data_agen, $id_data_barang) - $model->qty;
                $modelStok->stok_sisa = $modelStok->stok_awal - $modelStok->stok_akhir;
                $modelStok->save(false);

                $modelRiwayatStokbarang = new \backend\models\RiwayatStokBarang();
                $modelRiwayatStokbarang->isNewRecord = true;
                $modelRiwayatStokbarang->id = null;
                $modelRiwayatStokbarang->barkode = $modelStok->barkode;
                $modelRiwayatStokbarang->id_data_agen = $id_data_agen;
                $modelRiwayatStokbarang->id_data_barang = $id_data_barang;
                $modelRiwayatStokbarang->stok_awal = $stok_sisa_sebelumnya;
                $modelRiwayatStokbarang->stok_akhir = $model->qty;
                $modelRiwayatStokbarang->stok_sisa = $modelStok->stok_sisa;
                $modelRiwayatStokbarang->no_invoice = 'OUT';
                $modelRiwayatStokbarang->save(false);
                return $this->redirect(['list-transaksi-barang', 'id_data_barang' => $id_data_barang, 'id_data_agen' => $id_data_agen]);
            }
        }

//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }

        return $this->render('update', [
                    'model' => $model,
                    'harga_jual' => $harga_jual
        ]);
    }

    public function actionUpdateKasir($kode_barkode, $qty, $id_data_barang, $total_jual, $no_invoice, $totalbayar, $totaltunai, $totalkembali) {
        $no_acak = Yii::$app->user->identity->no_acak;
        $dataAgen = \backend\models\DataAgen::findOne(['no_acak' => $no_acak]);
        //data toko
        $dataToko = \backend\models\DataToko::find()->where(['id_data_agen' => $dataAgen['id']])->one();
        $id_data_agen = $dataAgen['id'];
        $model = new TransaksiBarang();
        $model->isNewRecord = true;
        $databarang = DataBarang::find()->where(['id' => $id_data_barang, 'id_data_agen' => $id_data_agen])->one();
        $model->nama_item = $databarang['item_barang'];
        $model->id_data_agen = $id_data_agen;
        $model->id_data_barang = $id_data_barang;
        $model->barkode = $databarang['barkode'];
        $model->kode_barkode = $kode_barkode;
        $harga_satuan = $databarang['harga_satuan'];
        $id_ref_barang = $databarang['id_ref_barang'];

        $model->duit_tunai = $totaltunai;
        $model->duit_kembali = $totalkembali;

        //margin
        $aturMargin = AturMarginItem::find()->where(['id_ref_barang' => $id_ref_barang])->one();
        $persen_margin = $aturMargin['nilai'] / 100;

        $margin_item = $harga_satuan * $persen_margin;
        $margin_total = $model->qty * $margin_item;
        $harga_jual = $margin_item + $harga_satuan;
        $aturMargin = AturMarginItem::find()->where(['id_ref_barang' => $id_ref_barang])->one();
        $persen_margin = $aturMargin['nilai'] / 100;

        $margin_item = $harga_satuan * $persen_margin;
        $margin_total = $model->qty * $margin_item;
        $harga_jual = $margin_item + $harga_satuan;

        $model->qty = $qty;
        $model->no_invoice = $no_invoice;
        $model->margin_item = $margin_item;
        $model->harga_jual = $harga_jual;
        $model->margin_total = $margin_total;
        $model->tgl_transaksi = date('Y-m-d');
        $model->total_jual = $total_jual; //($harga_jual*$model->qty)+(($harga_jual*$model->qty)*(10/100));;
        $model->keterangan = 'OUT';
        if($model->save()){
        //checkout
        $modelCheckout = new \backend\models\CheckoutItem();
        $modelCheckout->isNewRecord = true;
        $modelCheckout->id = null;
        $modelCheckout->no_acak = $no_acak;
        $modelCheckout->ongkir = 0;
        $modelCheckout->id_data_barang = $id_data_barang;
        $modelCheckout->nama_item = $databarang['item_barang'];
        $modelCheckout->harga_jual = $harga_jual;
        $modelCheckout->qty = $qty;
        $modelCheckout->total = $total_jual;
        $modelCheckout->no_invoice = $no_invoice;
        $modelCheckout->tgl_invoice = date('Y-m-d');
        $modelCheckout->tgl_masuk = date('Y-m-d');
        $modelCheckout->id_data_toko = $dataToko['id'];
        $modelCheckout->duit_tunai = $totaltunai;
        $modelCheckout->duit_kembali = $totalkembali;
        $modelCheckout->save(false);
        //detail pembayaran
        $modelDetailPembayaran = new \backend\models\DetailPembayaran();
        $modelDetailPembayaran->no_acak = $no_acak;
        $modelDetailPembayaran->no_invoice = $no_invoice;
        $modelDetailPembayaran->id_metode_pembayaran = 3;
        $modelDetailPembayaran->id_ref_kurir = 0;
        $modelDetailPembayaran->tgl_dikirim = date('Y-m-d');
        $modelDetailPembayaran->jam_dikirim = 0;
        $modelDetailPembayaran->ongkir = 0;
        $modelDetailPembayaran->save(false);
           $modelStok = StokBarang::find()->where(['id_data_barang' => $id_data_barang, 'id_data_agen' => $id_data_agen])->one();
            $stok_sisa_sebelumnya = $modelStok->stok_sisa;
            $modelStok->stok_akhir = $qty;
            $modelStok->stok_awal = StokBarang::getQty($id_data_agen, $id_data_barang) - $qty;
            $modelStok->stok_sisa = $modelStok->stok_awal - $modelStok->stok_akhir;
            $modelStok->save(false);

            $modelRiwayatStokbarang = new \backend\models\RiwayatStokBarang();
            $modelRiwayatStokbarang->isNewRecord = true;
            $modelRiwayatStokbarang->id = null;
            $modelRiwayatStokbarang->barkode = $modelStok->barkode;
            $modelRiwayatStokbarang->id_data_agen = $id_data_agen;
            $modelRiwayatStokbarang->id_data_barang = $id_data_barang;
            $modelRiwayatStokbarang->stok_awal = $stok_sisa_sebelumnya;
            $modelRiwayatStokbarang->stok_akhir = $qty;
            $modelRiwayatStokbarang->stok_sisa = $modelStok->stok_sisa;
            $modelRiwayatStokbarang->no_invoice = 'OUT';
            $modelRiwayatStokbarang->save(false);
        }
   //     return \yii\helpers\Json::encode(['message' => $model->getErrors()]); //$this->redirect(['list-transaksi-barang', 'id_data_barang' => $id_data_barang, 'id_data_agen' => $id_data_agen]);
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
    }

    public function actionUpdateKasirJualBeli($no_invoice, $totalbayar, $totaltunai, $totalkembali) {
        $no_acak = Yii::$app->user->identity->no_acak;


        //transaksi jual beli
        $modelTransaksiJualBeli = new \backend\models\TransaksiJualbeli();
        $modelTransaksiJualBeli->no_invoice = $no_invoice;
        $modelTransaksiJualBeli->tgl_invoice = date('Y-m-d');
        $modelTransaksiJualBeli->no_acak = $no_acak;
        $modelTransaksiJualBeli->total_bayar = $totalbayar;
        $modelTransaksiJualBeli->total_tunai = $totaltunai;
        $modelTransaksiJualBeli->total_kembali = $totalkembali;
        $modelTransaksiJualBeli->save(false);
        return $this->redirect(['/belanja/print-thermal-faktur', 'no_invoice' => $no_invoice]);
    }

//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }

    /**
     * Deletes an existing TransaksiBarang model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TransaksiBarang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransaksiBarang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TransaksiBarang::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
