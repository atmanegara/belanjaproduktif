<?php

namespace backend\controllers;

use Yii;
use backend\models\DataToko;
use backend\models\DataTokoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DataTokoController implements the CRUD actions for DataToko model.
 */
class DataTokoController extends Controller
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
     * Lists all DataToko models.
     * @return mixed
     */
    public function actionIndex()
    {
        $role_id = Yii::$app->user->identity->role_id;
       
        $no_acak = Yii::$app->user->identity->no_acak;
        $searchModel = new DataTokoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       if(in_array($role_id, ['2','6'])){
            $dataProvider->query->where(['no_acak'=>$no_acak]);
        }  
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DataToko model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DataToko model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $no_acak = Yii::$app->user->identity->no_acak;
        $modelKabupaten = \backend\models\Kabupaten::dropdownlist();
        
        $dataAgen = \backend\models\DataAgen::find()->where(['no_acak'=>$no_acak])->one();
        $model = new DataToko();
$model->id_data_agen = $dataAgen['id'];
        if ($model->load(Yii::$app->request->post())) {
           $model->no_acak =$no_acak;
            if($model->save()){
            return $this->redirect(Yii::$app->request->referrer);
            }else{
                 Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
           return \kartik\form\ActiveForm::validate($model);
            }
        }

        return $this->renderAjax('_form', [
            'model' => $model,
            'modelKabupaten'=>$modelKabupaten
        ]);
    }

    /**
     * Updates an existing DataToko model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
      $modelKabupaten = \backend\models\Kabupaten::dropdownlist();
 
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderAjax('_form', [
            'model' => $model,
            'modelKabupaten'=>$modelKabupaten
        ]);
    }

    /**
     * Deletes an existing DataToko model.
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
     * Finds the DataToko model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DataToko the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DataToko::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
        public function actionTampilkanTokoByIdKel($id_kel){
        $dataAgen = DataToko::find()->where(['id_kelurahan'=>$id_kel])->all();
       $html = " <option>Pilih Salah Satu...</option>";
        foreach($dataAgen as $val){
        $id_data_agen = $val['id_data_agen'];
        $nama_agan = $val['nama_toko'];
        $html .= "<option value=$id_data_agen>$nama_agan</option>";
        }
        return $html;
    }
}
