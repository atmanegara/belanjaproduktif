<?php

namespace backend\controllers;

use Yii;
use backend\models\KonfirmasiPencairan;
use backend\models\KonfirmasiPencairanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\StatusPembayaran;

/**
 * KonfirmasiPencairanController implements the CRUD actions for KonfirmasiPencairan model.
 */
class KonfirmasiPencairanController extends Controller {

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
     * Lists all KonfirmasiPencairan models.
     * @return mixed
     */
    public function actionIndex($id_status_pembayaran = null) {
        $modelStatusPembayaran = StatusPembayaran::Dropdownlist();
        $searchModel = new KonfirmasiPencairanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if ($id_status_pembayaran) {
            $dataProvider->query->where(['id_status_pembayaran' => $id_status_pembayaran]);
        }
        //total All;
        $countAll = KonfirmasiPencairan::find()->count();
        //total Menunggu
        $countAll3 = KonfirmasiPencairan::find()->where(['id_status_pembayaran' => 3])->count();
        //total bayar belum verifikasi
        $countAll1 = KonfirmasiPencairan::find()->where(['id_status_pembayaran' => 1])->count();
        //total bayar belum verifikasi
        $countAll2 = KonfirmasiPencairan::find()->where(['id_status_pembayaran' => 2])->count();
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider, 'modelStatusPembayaran' => $modelStatusPembayaran,
                    'countAll' => $countAll, 'countAll1' => $countAll1, 'countAll2' => $countAll2, 'countAll3' => $countAll3
        ]);
    }

    /**
     * Displays a single KonfirmasiPencairan model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionVerifikasi($id) {
        $model = $this->findModel($id);
        $statusPembayaran = \backend\models\StatusPembayaran::Dropdownlist();
        if ($model->load(Yii::$app->request->post())) {
            $nominal = $model->nominal;

            $model->id_user = Yii::$app->user->identity->id;
            if ($model->save()) {

                
                //if ($modelDataKomisi->save()) {
                    if ($model->status_pencarian == '1') { //ke agen
                        if ($model->pencarian_sbg == '1') { //saldo
                            $modelDataAgen = \backend\models\DataAgen::findOne($model->id_data_agen);
                            $modelSaldo = \backend\models\DataSaldo::find()->where(['no_acak' => $modelDataAgen['no_acak']]);
                            if ($modelSaldo->exists()) {
                                $modelSaldo = $modelSaldo->one();
                            } else {
                                $modelSaldo = new \backend\models\DataSaldo();
                                $modelSaldo->no_acak = $modelDataAgen['no_acak'];
                            }

                            $nominal_awal = $modelSaldo['nominal_awal'];
                            $modelSaldo->nominal_awal = $nominal_awal + $nominal;
                            $modelSaldo->tgl_masuk = date('Y-m-d');
                            $modelSaldo->save(false);

                            //transaksi saldo
                            $modelTransaksiSaldo = new \backend\models\TransaksiSaldo();
                            $modelTransaksiSaldo->no_acak = $modelDataAgen['no_acak'];
                            $modelTransaksiSaldo->no_invoice = \backend\models\QueryModel::noinvoice();
                            $modelTransaksiSaldo->nominal_masuk = $nominal;
                            $modelTransaksiSaldo->nominal_sisa = $nominal_awal + $nominal;
                            $modelTransaksiSaldo->id_ket_saldo = 2;  //melakukan pembayaran untuk pencairan

                            $modelTransaksiSaldo->tgl_transaksi = date('Y-m-d');
                            $modelTransaksiSaldo->id_metode_transfer = 2;
                            $modelTransaksiSaldo->id_ref_bank = 0;
                            $modelTransaksiSaldo->save(false);
                        } elseif ($model->pencarian_sbg == '2') { //komisi
                            $modelDataAgen = \backend\models\DataAgen::findOne($model->id_data_agen);
                            $modelKomisi = \backend\models\DataKomisi::find()->where(['id_data_agen' => $model->id_data_agen]);
                            if ($modelKomisi->exists()) {
                                $modelKomisi = $modelKomisi->one();
                            } else {
                                $modelKomisi = new \backend\models\DataKomisi();
                                $modelKomisi->id_data_agen = $model->id_data_agen;
                                $modelKomisi->no_acak = $modelDataAgen['no_acak'];
                            }
                            $nominal_awal = $modelKomisi['nominal'];
                            $modelKomisi->ket = '5';
                            $modelKomisi->nominal = $nominal_awal + $nominal;
                            $modelKomisi->tgl_transaksi = date('Y-m-d');
                            $modelKomisi->save(false);
                            //transaksi komisi
                            $modelTransaksiKomisi = new \backend\models\TransaksiKomisi();
                            $modelTransaksiKomisi->no_acak_penerima = $modelDataAgen['no_acak'];
                            $modelTransaksiKomisi->no_acak_pemberi = $modelDataAgen['no_acak'];
                            $modelTransaksiKomisi->no_acak = \backend\models\QueryModel::noacak();
                            $modelTransaksiKomisi->tgl_masuk = date('Y-m-d');
                            $modelTransaksiKomisi->id_data_agen = $model->id_data_agen;
                            $modelTransaksiKomisi->id_data_barang = 0;  //melakukan pembayaran untuk pencairan
                            $modelTransaksiKomisi->id_ref_barang = 0;  //melakukan pembayaran untuk pencairan
                            $modelTransaksiKomisi->id_ref_agen = $modelDataAgen['id_ref_agen'];  //melakukan pembayaran untuk pencairan
                            $modelTransaksiKomisi->jumlah = 0;  //melakukan pembayaran untuk pencairan

                            $modelTransaksiKomisi->nilai_bagi = 0;  //melakukan pembayaran untuk pencairan
                            $modelTransaksiKomisi->nominal = $nominal;
                            $modelTransaksiKomisi->ket = 5;
                            $modelTransaksiKomisi->tahun = date('Y');
                            $modelTransaksiKomisi->save(false);
                        }
                    }elseif ($model->status_pencarian == '2') { //ke bank pencairan komisi
                            $modelDataAgen = \backend\models\DataAgen::findOne(['no_acak'=>$model->no_acak]);
                       $modelDataKomisi = \backend\models\DataKomisi::find()->where(['no_acak' => $model->no_acak])->one();
                $nominal_sisa = $modelDataKomisi['nominal'] - $nominal;
                $modelDataKomisi->nominal = $nominal_sisa; 
                $modelDataKomisi->save(false);
                        //riwayat pencairan
                         $modelTransaksiKomisi = new \backend\models\TransaksiKomisi();
                            $modelTransaksiKomisi->no_acak_penerima = $modelDataAgen['no_acak'];
                            $modelTransaksiKomisi->no_acak_pemberi = $modelDataAgen['no_acak'];
                            $modelTransaksiKomisi->no_acak = \backend\models\QueryModel::noacak();
                            $modelTransaksiKomisi->tgl_masuk = date('Y-m-d');
                            $modelTransaksiKomisi->id_data_agen = $model->id_data_agen;
                            $modelTransaksiKomisi->id_data_barang = 0;  //melakukan pembayaran untuk pencairan
                            $modelTransaksiKomisi->id_ref_barang = 0;  //melakukan pembayaran untuk pencairan
                            $modelTransaksiKomisi->id_ref_agen = $modelDataAgen['id_ref_agen'];  //melakukan pembayaran untuk pencairan
                            $modelTransaksiKomisi->jumlah = 0;  //melakukan pembayaran untuk pencairan
                            
                            $modelTransaksiKomisi->nilai_bagi = 0;  //melakukan pembayaran untuk pencairan
                            $modelTransaksiKomisi->nominal = $nominal;
                            $modelTransaksiKomisi->ket = 5;
                            $modelTransaksiKomisi->tahun = date('Y');
                            $modelTransaksiKomisi->save(false);
                    }
                    $sql = "insert into riwayat_pencairan select :no_acak,:tgl_pencairan, a.* from konfirmasi_pencairan a where a.id=:id";
                    $params = [
                        ':no_acak' => \backend\models\QueryModel::noacak(),
                        ':tgl_pencairan' => date('Y-m-d'),
                        ':id' => $id
                    ];
                    Yii::$app->db->createCommand($sql, $params)->execute();
             //   }
            }
            return $this->redirect(Yii::$app->request->referrer);
        }

//        return $this->render('update', [
//            'model' => $model,
//        ]);

        return $this->renderAjax('view-verifikasi', [
                    'model' => $model,
                    //     'modelVer'=>$modelVer,
                    'statusPembayaran' => $statusPembayaran
        ]);
    }

    /**
     * Creates a new KonfirmasiPencairan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new KonfirmasiPencairan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing KonfirmasiPencairan model.
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

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing KonfirmasiPencairan model.
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
     * Finds the KonfirmasiPencairan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KonfirmasiPencairan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = KonfirmasiPencairan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
