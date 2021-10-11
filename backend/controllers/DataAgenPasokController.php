<?php

namespace backend\controllers;

use Yii;
use backend\models\DataAgenPasok;
use backend\models\DataAgenPasokSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\RegistrasiAgen;
use backend\models\RefAgen;
use backend\models\RefStatusSipil;
use frontend\models\RefKecamatan;
use backend\models\BerkasAgen;
use yii\data\ActiveDataProvider;
use backend\models\DataAgenWaris;
use backend\models\RefProsesPendaftaran;
use yii\web\UploadedFile;
use yii\bootstrap4\ActiveForm;
use yii\web\Response;
use frontend\models\DataDetailAgen;
use backend\models\DataAgen;
/**
 * DataAgenController implements the CRUD actions for DataAgen model.
 */
class DataAgenPasokController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
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
     * Lists all DataAgen models.
     * @return mixed
     */
    public function actionIndex()
    {
        $no_acak = Yii::$app->user->identity->no_acak;
         $searchModel = new DataAgenPasokSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      $dataProvider->query->where(['no_acak'=>$no_acak]);
      
      $dataDetailAgen = DataAgen::find()
      ->innerJoin('data_detail_agen','data_agen.id_agen=data_detail_agen.id_referensi_agen')
      ->where(['data_detail_agen.no_acak'=>$no_acak])->one();
      
       return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
           'no_acak'=>$no_acak,
           'no_acak_ref'=>$dataDetailAgen['no_acak']
        ]);
    }
    public function actionIndexAgen(){
        $no_acak= Yii::$app->user->identity->no_acak;
        $query = DataAgen::find()
        ->select('c.*')
        ->innerJoin('data_detail_agen b','data_agen.id_agen=b.id_referensi_agen')
        ->innerJoin('data_agen c','b.no_acak=c.no_acak')
        ->where([
            'data_agen.no_acak'=>$no_acak
        ]);
//         if($query){
        $dataProvider=new ActiveDataProvider([
            'query'=>$query,
           
        ]);
//         }else{
//             return $this->render('index');
//         }
//         $searchModel = new DataAgenSearch();
//         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//         $dataProvider->query->where(['id_ref_agen'=>$id_ref_agen]);
        return $this->renderAjax('index-agen', [
//            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'no_acak'=>$no_acak
        ]);
    }
    /**
     * Displays a single DataAgen model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($no_acak)
    {
        $modelRegistrasi = RegistrasiAgen::findOne(['no_acak'=>$no_acak]);
        $modelex= DataAgenPasok::find()->where(['nik'=>$modelRegistrasi['nik']]);
        if(!$modelex->exists()){
            return $this->redirect(['#data-agen-pasok/create','no_acak'=>$no_acak]);
        }
        $model= $modelex->one();
        //opor ayam
        $modelAgenWaris = new ActiveDataProvider([
            'query'=>DataAgenWaris::find()->where([
                'id_data_agen'=>$model['id']
            ])
        ]);
        //berkas
        $modelBerkasAgen = new ActiveDataProvider([
            'query'=>BerkasAgen::find()->where([
                'id_data_agen'=>$model['id']
            ])
        ]);
        return $this->renderAjax('view', [
            'model' =>$model,
            'modelBerkasAgen'=>$modelBerkasAgen,
            'modelAgenWaris'=>$modelAgenWaris,
            'id_data_agen'=>$model['id'],
            'no_acak'=>$no_acak
        ]);
    }

    /**
     * Creates a new DataAgen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($no_acak,$no_acak_ref)
    {
        $modelRegistrasi = RegistrasiAgen::findOne(['no_acak'=>$no_acak]);
        $modelRefAgen = \frontend\models\RefAgen::getDropdownAgen();
        $modelStatusSipil = RefStatusSipil::DropDownlist();
        $modelRefKecamatan = RefKecamatan::getDropdownkecamatan();
        $model = new DataAgenPasok();
        $model->id_agen = $modelRegistrasi->refAgen->kd_agen.str_pad($modelRegistrasi['id'],8,'0',STR_PAD_LEFT);
//$model->no_acak=$modelRegistrasi['no_acak'];
$model->id_ref_agen=$modelRegistrasi['id_ref_agen'];
$model->nik = $modelRegistrasi['nik'];
$model->alamat=$modelRegistrasi['alamat'];

        if ($model->load(Yii::$app->request->post())) {
            $model->no_acak_ref=$no_acak_ref;
            $model->no_acak=$no_acak;
            $model->filedok = UploadedFile::getInstance($model, 'filedok');
            
            if($model->upload()){
                $model->save();      
                $modelRegistrasi->id_ref_proses_pendaftaran=3;
                $modelRegistrasi->save(false);
                return $this->redirect(['/#data-agen-pasok/view', 'no_acak' => $no_acak]);
            }else{
                Yii::$app->response->format= Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
      
        }

        return $this->renderAjax('_form', [
            'model' => $model,
            'modelRefAgen'=>$modelRefAgen,
            'modelStatusSipil'=>$modelStatusSipil,
            'modelRefKecamatan'=>$modelRefKecamatan
        ]);
    }

    /**
     * Updates an existing DataAgen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DataAgen model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DataAgen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DataAgen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DataAgen::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    ///data list barang by agen promo
    
//     public function actionDataBarang(){
//         $dataProvider = new ActiveDataProvider([
//             'query'=>DataAgen::find();
//         ]);
        
//         return $this->renderAjax('data-barang',[
//             'dataProvider'=>$dataProvider
//         ]);
//     }
    
}
