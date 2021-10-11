<?php

namespace backend\controllers;

use Yii;
use backend\models\DataBarang;
use backend\models\DataBarangSearch;
use backend\models\DataListBarangSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\DataAgen;
use yii\data\ActiveDataProvider;
use backend\models\TransaksiBarang;
use yii\widgets\ActiveForm;
use yii\web\Response;
use backend\models\RefSatuanBarang;
use backend\models\StokBarang;
use yii\web\UploadedFile;
use backend\models\RegistrasiAgen;
use backend\models\AturMarginItem;

/**
 * DataBarangController implements the CRUD actions for DataBarang model.
 */
class DataBarangController extends Controller {

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

//    public function init()
//    {
//        //atur margin pulik
//      
//        $this->persen_margin = ($margin['nilai']/100);
//    }

    public function actionIndex() {
        $searchModel = new DataBarangSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDaftarBarang() {
        $query = DataAgen::find()->where(['id_ref_agen' => ['1', '2', '7']]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        return $this->render('daftar-barang', [
                    'dataProvider' => $dataProvider
        ]);
    }

    public function actionListItemAgen($id_ref_barang) {
        $query = DataBarang::find()->
                where(['id_ref_barang' => $id_ref_barang]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        return $this->renderAjax('list-item-agen', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionListBarang($stok=null) {
        $id_role = Yii::$app->user->identity->role_id;
        if (in_array($id_role, ['2', '6'])) {
            $no_acak = Yii::$app->user->identity->no_acak;
            $regAgen = RegistrasiAgen::find()->where(['no_acak' => $no_acak, 'id_ref_proses_pendaftaran' => "2"])->exists(); //agen masih dalam proses pending menunggu verifikasi berkas
            if (!$regAgen) {
                Yii::$app->session->setFlash('danger', 'Data Pribadi Agen Belum di Kirim ke Admin BP');
                return $this->redirect(Yii::$app->request->referrer); //   return $this->renderAjax('informasi-agen');
            }
            $dataAgen = DataAgen::find()->where(['no_acak' => $no_acak])->one();
            $id_data_agen = $dataAgen['id'];
        } else {
            $id_data_agen = Yii::$app->request->get('id_data_agen');
            $dataAgen = DataAgen::find()->where(['id' => $id_data_agen])->one();
        }
        $searchModel = new DataListBarangSearch();
        $searchModel->stok=$stok;
        $searchModel->id_data_agen  = $id_data_agen;
        //     $query = DataBarang::find()->where(['id_data_agen'=>$id_data_agen]);
        $list_barang = 'list-barang';
        if (in_array($dataAgen['id_ref_agen'], ['2', '6'])) {
            $query = \backend\models\DataItemBarangAgen::find()->where(['no_acak' => $dataAgen['no_acak']]);
            $list_barang = 'list-barang-agen';
        }
        // add conditions that should always apply here

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        //total stok 0;
        $stokBarang = (new \yii\db\Query())
                        ->select(['count(id_data_barang) as totalitem'])->from('stok_barang')
                        ->where(['id_data_agen' => $id_data_agen])
                        ->andWhere(['<=', 'stok_sisa', '0'])->one();
        return $this->render($list_barang, [
                    //   'searchModel' => $searchModel,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'id_data_agen' => $id_data_agen,
                    'stokBarang' => $stokBarang
        ]);
    }

    /**
     * Displays a single DataBarang model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->renderAjax('view', [
                    'model' => $this->findModel($id),
        ]);
    }
 public function actionUpdateQty($id) {
     $modelBarang = $this->findModel($id);
          $model = StokBarang::find()->where(['id_data_barang' => $id, 'id_data_agen' => $modelBarang['id_data_agen']])->one();
           
     if($model->load(Yii::$app->request->post())){
       //  $stokBarang->stok_awal += $model->qty;
                   //     $stokBarang->stok_sisa = $stokBarang->stok_awal - $stokBarang->stok_keluar;
         $model->save(false);
                 return $this->redirect(Yii::$app->request->referrer);
     }
        return $this->renderAjax('update-qty', [
                    'model' =>$model
        ]);
    }
    /**
     * Creates a new DataBarang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_data_agen) {

        $model = new DataBarang();


        $modelRefSatuanBarang = RefSatuanBarang::getdropdownlist();
        $model->id_data_agen = $id_data_agen;
        if ($model->load(Yii::$app->request->post())) {
            $id_ref_barang = $model->id_ref_barang;
            $margin = AturMarginItem::find()->where(['id_ref_barang' => $id_ref_barang])->one();
            $persen_margin = $margin['nilai'] / 100;
            $model->filedok = UploadedFile::getInstance($model, 'filedok');
            $model->upload();
            $modelDataBarang = DataBarang::find()->where(['id_data_agen' => $id_data_agen, 'barkode' => $model->barkode]);
            if ($modelDataBarang->exists()) {
                Yii::$app->session->setFlash('warning', 'Item Sudah Ada, cek kembali di pencarian');
                return $this->redirect(Yii::$app->request->referrer);
            }
            if ($model->save(false)) {
                $id_data_barang = $model->getPrimaryKey();
                $modelTransaksi = new TransaksiBarang();
                $modelTransaksi->tgl_transaksi = date('Y-m-d');
                $modelTransaksi->id_data_agen = $id_data_agen;
                $modelTransaksi->id_data_barang = $id_data_barang;
                $modelTransaksi->qty = $model->qty;
                $modelTransaksi->harga_satuan = $model->harga_satuan;
                $modelTransaksi->margin_item = $modelTransaksi->harga_satuan * $persen_margin;
                $modelTransaksi->harga_jual = $modelTransaksi->harga_satuan + ($modelTransaksi->harga_satuan * $persen_margin);
                $modelTransaksi->barkode = $model->barkode;
                $modelTransaksi->keterangan = "IN";
                $modelTransaksi->save(false);
                $modelStokBarang = StokBarang::find()->where(['id_data_barang' => $id_data_barang, 'id_data_agen' => $id_data_agen]);
                if ($modelStokBarang->exists()) {
                    $stokBarang = $modelStokBarang->one();
                    if ($stokBarang->barkode == $model->barkode) {
                        $stokBarang->stok_awal += $model->qty;
                        $stokBarang->stok_sisa = $stokBarang->stok_awal - $stokBarang->stok_keluar;
                    } else {
                        Yii::$app->session->setFlash('danger', 'Kode barcode tidak sama, jadikan item baru aja');
                        return $this->redirect(Yii::$app->request->referrer);
//                       $stokBarang = new StokBarang();
//                       $stokBarang->id_data_barang=$id_data_barang;
//                       $stokBarang->id_data_agen = $id_data_agen;
//                       $stokBarang->barkode = $model->barkode;
//                       $stokBarang->stok_awal+=$model->qty;
//                              $stokBarang->stok_sisa=$stokBarang->stok_awal-$stokBarang->stok_keluar;
                    }
                    $stokBarang->save(false);
                } else {
                    $stokBarang = new StokBarang();
                    $stokBarang->id_data_barang = $id_data_barang;
                    $stokBarang->id_data_agen = $id_data_agen;
                    $stokBarang->barkode = $model->barkode;
                    $stokBarang->stok_awal += $model->qty;
                    $stokBarang->stok_sisa = $stokBarang->stok_awal - $stokBarang->stok_keluar;
                    $stokBarang->save(false);
                }
                return $this->redirect(['#data-barang/list-barang', 'id_data_agen' => $id_data_agen]);
            } else {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            //    return $this->redirect(['#dataview', 'id' => $model->id]);
        }

        return $this->renderAjax('_form', [
                    'model' => $model,
                    'modelRefSatuanBarang' => $modelRefSatuanBarang
        ]);
    }

    /**
     * Updates an existing DataBarang model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        $modelRefSatuanBarang = RefSatuanBarang::getdropdownlist();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->renderAjax('_form', [
                    'model' => $model,
                    'modelRefSatuanBarang' => $modelRefSatuanBarang
        ]);
    }
    public function actionUpdateStatusBarang($id) {
        $model = $this->findModel($id);

        $modelRefSatuanBarang = RefSatuanBarang::getdropdownlist();
        if ($model->load(Yii::$app->request->post())) {
            $model->aktif='N';
            if ($model->save()) {
                $modelBarangTidakpakai = new \backend\models\BarangTidakpakai();
                $modelBarangTidakpakai->id_data_agen = $model->id_data_agen;
                $modelBarangTidakpakai->id_data_barang = $model->id;
                $modelBarangTidakpakai->alasan=$model->alasan;
                $modelBarangTidakpakai->save(false);
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->renderAjax('update-status-barang', [
                    'model' => $model,
                    'modelRefSatuanBarang' => $modelRefSatuanBarang
        ]);
    }
    /**
     * Deletes an existing DataBarang model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteId() {
        $selection = Yii::$app->request->post('selection');
        //   return var_dump($selection);
        foreach ($selection as $id) {
            $this->findModel($id)->delete();
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDeleteAll() {
        $selection = Yii::$app->request->post('selection');
        //   return var_dump($selection);
        foreach ($selection as $id) {
            DataBarang::deleteAll(['id_ref_barang' => $id]); //->deleteAll();
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the DataBarang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DataBarang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = DataBarang::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
