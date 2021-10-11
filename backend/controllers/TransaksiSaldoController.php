<?php

namespace backend\controllers;

use Yii;
use backend\models\TransaksiSaldo;
use backend\models\TransaksiSaldoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\PembayaranJualbeli;
use backend\models\DataSaldo;
use backend\models\TransaksiBarang;
use backend\models\AturMarginItem;

/**
 * TransaksiSaldoController implements the CRUD actions for TransaksiSaldo model.
 */
class TransaksiSaldoController extends Controller {

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
     * Lists all TransaksiSaldo models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TransaksiSaldoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if (Yii::$app->request->get('no_acak')) {
            $no_acak = Yii::$app->request->get('no_acak');
            $dataProvider->query->where(['no_acak' => $no_acak]);
        }

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TransaksiSaldo model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->renderAjax('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TransaksiSaldo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TransaksiSaldo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->renderAjax('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing TransaksiSaldo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->renderAjax('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TransaksiSaldo model.
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
     * Finds the TransaksiSaldo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransaksiSaldo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TransaksiSaldo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSimpan() {


        if (Yii::$app->request->post()) {
            $id_metode_pembayaran = Yii::$app->request->post('id_metode_pembayaran');
            $no_invoice = Yii::$app->request->post('no_invoice');
            $no_acak = Yii::$app->request->post('no_acak');
            $nominal_bayar = Yii::$app->request->post('nominal');
            //        $model = $this->findModel(['no_invoice'=>$no_invoice]);
            $model = PembayaranJualbeli::findOne(['no_invoice' => $no_invoice]);

            $saldo = \backend\models\DataSaldo::findOne(['no_acak' => $no_acak]);
            if ($id_metode_pembayaran == '1') {
                if ($saldo['nominal_awal'] < $nominal_bayar) {
                    Yii::$app->session->setFlash('danger', 'Saldo tidak cukup, silakan topup terlebih dulu');
                    return $this->redirect(Yii::$app->request->referrer);
                }
            }

            $model->id_status_pembayaran = 2;
            if ($model->save(false)) {
                $kd_booking = \backend\models\QueryModel::noacak();
                $checkOutModel = \backend\models\CheckoutItem::find()->where(['no_invoice' => $no_invoice])->all();
                foreach ($checkOutModel as $value) {
                    $stokbarangModel = \backend\models\StokBarang::find()->where(['id_data_barang' => $value['id_data_barang']])->one();
                    $detailPembayaran = \backend\models\DetailPembayaran::find()->where(['no_invoice' => $no_invoice])->one();
                    $id_data_barang = $value['id_data_barang'];
                    $model = new \backend\models\BookingBarang();
                    $model->kd_booking = $kd_booking;
                    $model->isNewRecord = true;
                    $model->id = null;
                    $model->id_stok_barang = $stokbarangModel['id'];
                    $model->qty_keluar = $value['qty'];
                    $model->no_invoice = $no_invoice;
                    $model->no_acak = $no_acak;
                    $model->status_booking = '1'; //Ya booking
                    $model->tgl_batas_book = date('Y-m-d');
                    $model->jam_batas_book = $detailPembayaran['jam_dikirim'];
                    $model->save(false);
                    $total_jual = $value['qty']*$value['harga_jual'];
                 $databarang = \backend\models\DataBarang::find()->where(['id' => $id_data_barang])->one();
                   $harga_satuan = $databarang['harga_satuan'];
        $id_ref_barang = $databarang['id_ref_barang'];

                }
            }

            $modelTransaksiSaldo = new TransaksiSaldo();
            $modelTransaksiSaldo->no_acak = $no_acak;
            $modelTransaksiSaldo->no_invoice = $no_invoice;
            $modelTransaksiSaldo->nominal_keluar = $nominal_bayar;
            $modelTransaksiSaldo->nominal_sisa = DataSaldo::nominaldulu($no_acak) - $nominal_bayar;
            $modelTransaksiSaldo->id_ket_saldo = 3;  //melakukan pembayaran untuk belanja jualbeli  

            $modelTransaksiSaldo->tgl_transaksi = date('Y-m-d');
            $modelTransaksiSaldo->id_metode_transfer = 2;
            $modelTransaksiSaldo->id_ref_bank = 0;
            $modelTransaksiSaldo->save(false);

            $dataSaldocek = DataSaldo::find()->where(['no_acak' => $no_acak]);
            if ($dataSaldocek->exists()) {
                $modelDataSaldo = $dataSaldocek->one();
            } else {
                $modelDataSaldo = new DataSaldo();
            }
            //   return var_dump($model['no_acak']);
            $modelDataSaldo->no_acak = $no_acak;
            $modelDataSaldo->tgl_masuk = date('Y-m-d');

            $modelDataSaldo->nominal_awal = DataSaldo::nominaldulu($no_acak) - $nominal_bayar;


            $modelDataSaldo->save(false);

            //  }

            Yii::$app->session->setFlash('success', 'Sukses');



            return $this->redirect(['/produk/konfirmasi-payment', 'no_invoice' => $no_invoice]);
        }
    }

}
