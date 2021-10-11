<?php

namespace backend\controllers;

use Yii;
use backend\models\DataItemBarangAgen;
use backend\models\DataItemBarangAgenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use backend\models\DaftarKepemilikanSearch;
/**
 * DataItemBarangAgenController implements the CRUD actions for DataItemBarangAgen model.
 */
class DataItemBarangAgenController extends Controller {

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
     * Lists all DataItemBarangAgen models.
     * @return mixed
     */
    public function actionIndex() {
        $no_acak = Yii::$app->user->identity->no_acak;

        $searchModel = new DataItemBarangAgenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['no_acak' => $no_acak]);
//        $dataDetailAgen = \frontend\models\DataDetailAgen::find()->where(['no_acak'=>$no_acak])->one();
//        //$dataAgen = \backend\models\DataAgen::find()->where(['id_agen'=>$dataDetailAgen['no_acak']])->one();


        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    public function actionDaftarKepemilikan(){
   $searchModel = new DaftarKepemilikanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
          

        return $this->render('daftar-kepemilikan', [
                  'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);

    }
    /**
     * Displays a single DataItemBarangAgen model.
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
     * Creates a new DataItemBarangAgen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {

        $no_acak = Yii::$app->user->identity->no_acak;
        $modelItemBarang = DataItemBarangAgen::find()->where(['no_acak' => $no_acak]);
        if ($modelItemBarang->exists()) {
            Yii::$app->session->setFlash('danger', 'Tidak bisa menambah Item, Item sudah ada');
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            $modelItemBarang = DataItemBarangAgen::find()->where(['no_acak' => $no_acak]);

            $model = new DataItemBarangAgen();
        }
        $model->no_acak = $no_acak;
        if ($model->load(Yii::$app->request->post())) {
            foreach (Yii::$app->request->post('selection') as $id) {
                $dataBarang = \backend\models\DataBarang::findOne($id);
                $id_ref_barang = $dataBarang['id_ref_barang'];
                $dataToko = \backend\models\DataToko::find()->where(['id_data_agen'=>$dataBarang['id_data_agen']])->one();
                $model->id_data_toko = $dataToko['id'];
                $model->id_data_barang=$id;
                $modelItemBarang = DataItemBarangAgen::find()->where(['id_ref_barang' => $id_ref_barang,'id_data_toko'=>$dataToko['id']]);
                if ($modelItemBarang->exists()) {
                    continue;
                }
       
            $model->id_ref_barang = $id_ref_barang;
            $model->tgl_masuk = date('Y-m-d');
            $model->save(false);
           }
           return $this->redirect(Yii::$app->request->referrer);
        }

        $dataBarang = \backend\models\DataBarang::getDataBarangByAgenTurunan($this->no_acak_promo);
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $dataBarang,
            'key' => 'id'
        ]);
        return $this->renderAjax('_form', [
                    'model' => $model,
                    'dataProvider' => $dataProvider
        ]);
    }

    public function actionCekItemAgen() {
        $no_acak = Yii::$app->user->identity->no_acak;
        $id_data_barang = Yii::$app->request->post('id_data_barang');
        foreach ($id_data_barang as $id) {
            $id_data_barang = $id;
  $dataBarang = \backend\models\DataBarang::findOne($id_data_barang);
                $dataToko = \backend\models\DataToko::find()->where(['id_data_agen'=>$dataBarang['id_data_agen']])->one();
              
            $model = DataItemBarangAgen::find()->where(['id_ref_barang' => $dataBarang['id_ref_barang'],'id_data_toko'=>$dataToko['id']])->exists();
        }
        return Json::encode($model);
    }

    /**
     * Updates an existing DataItemBarangAgen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderAjax('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DataItemBarangAgen model.
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
     * Finds the DataItemBarangAgen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DataItemBarangAgen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = DataItemBarangAgen::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
