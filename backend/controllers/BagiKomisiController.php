<?php

namespace backend\controllers;

use Yii;
use backend\models\RiwayatBagiKomisi;
use backend\models\RiwayatBagiKomisiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RiwayatBagiKomisiController implements the CRUD actions for RiwayatBagiKomisi model.
 */
class BagiKomisiController extends Controller {

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
     * Lists all RiwayatBagiKomisi models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new RiwayatBagiKomisiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RiwayatBagiKomisi model.
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
     * Creates a new RiwayatBagiKomisi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $no_acak_pemberi = Yii::$app->user->identity->no_acak;
        $model = new RiwayatBagiKomisi();
        //data agen
        $model->id_user = Yii::$app->user->getId();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                //cek agen di tuju
                $dataAgen = \backend\models\DataAgen::findOne($model->id_data_agen);
                $no_acak = $dataAgen['no_acak'];
                //data Komisi
                $cekDataKomisi = \backend\models\DataKomisi::find()->where([
                    'id_data_agen' => $model->id_data_agen
                ]);
                $nominalLama = 0;
                if ($cekDataKomisi->exists()) {
                    $dataKomisi = $cekDataKomisi->one();
                    $nominalLama = $dataKomisi['nominal'];
                } else {
                    $dataKomisi = new \backend\models\DataKomisi();
                    $dataKomisi->id_data_agen = $model->id_data_agen;
                    $dataKomisi->no_acak = $no_acak;
                }
                $dataKomisi->tgl_transaksi = date('Y-m-d');
                $dataKomisi->ket = $model->id_ref_sumber_komisi;
                $dataKomisi->nominal = $nominalLama + $model->nominal;
                $dataKomisi->save(false);

                //transaksi komisi
                $modelTransaksiKomisi = new \backend\models\TransaksiKomisi();
                $modelTransaksiKomisi->no_acak_penerima = $no_acak;
                $modelTransaksiKomisi->no_acak_pemberi = $no_acak_pemberi;
                $modelTransaksiKomisi->no_acak = $model->getPrimaryKey(); //\backend\models\QueryModel::noacak();
                $modelTransaksiKomisi->tgl_masuk = date('Y-m-d');
                $modelTransaksiKomisi->id_data_agen = $model->id_data_agen;
                $modelTransaksiKomisi->id_data_barang = 0;  //melakukan pembayaran untuk pencairan
                $modelTransaksiKomisi->id_ref_barang = 0;  //melakukan pembayaran untuk pencairan
                $modelTransaksiKomisi->id_ref_agen = $dataAgen['id_ref_agen'];  //melakukan pembayaran untuk pencairan
                $modelTransaksiKomisi->jumlah = 0;  //melakukan pembayaran untuk pencairan

                $modelTransaksiKomisi->nilai_bagi = 0;  //melakukan pembayaran untuk pencairan
                $modelTransaksiKomisi->nominal = $model->nominal;
                $modelTransaksiKomisi->ket = $model->id_ref_sumber_komisi;
                $modelTransaksiKomisi->tahun = date('Y');
                $modelTransaksiKomisi->save(false);
                Yii::$app->session->setFlash('success', 'Sukses di simpan');
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                return var_dump($model->getErrors());
            }
        }

        return $this->renderAjax('_form', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing RiwayatBagiKomisi model.
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
     * Deletes an existing RiwayatBagiKomisi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);

        $nominalLama = $model['nominal'];
        //cek agen di tuju
        $dataAgen = \backend\models\DataAgen::findOne($model['id_data_agen']);
        $no_acak = $dataAgen['no_acak'];
        //data Komisi
        $cekDataKomisi = \backend\models\DataKomisi::find()->where([
            'id_data_agen' => $model['id_data_agen']
        ]);
        if ($cekDataKomisi->exists()) {
            $dataKomisi = $cekDataKomisi->one();
            $nominalawal = $dataKomisi['nominal'];
            $dataKomisi->tgl_transaksi = date('Y-m-d');
            $dataKomisi->ket = $model['id_ref_sumber_komisi'];
            $dataKomisi->nominal = $nominalawal - $nominalLama;
            $dataKomisi->save(false);
        }

        $model->delete();
        \backend\models\TransaksiKomisi::find()->where(['no_acak' => $id])->one()->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the RiwayatBagiKomisi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RiwayatBagiKomisi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = RiwayatBagiKomisi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
