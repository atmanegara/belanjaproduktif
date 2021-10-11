<?php

namespace backend\controllers;

use Yii;
use backend\models\ProgramAgen;
use backend\models\ProgramAgenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProgramAgenController implements the CRUD actions for ProgramAgen model.
 */
class ProgramAgenController extends Controller
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
     * Lists all ProgramAgen models.
     * @return mixed
     */
    public function actionIndex()
    {
//        $searchModel = new ProgramAgenSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
  $query = (new \yii\db\Query())
          ->select(['a.id_ref_program_agen,b.nama_program,count(a.id_data_agen) as bykagen'])
          ->from('program_agen a')
          ->innerJoin('ref_program_agen b','b.id=a.id_ref_program_agen')->groupBy('a.id_ref_program_agen');
  $dataProvider = new \yii\data\ActiveDataProvider([
      'query'=>$query,
      'key'=>'id_ref_program_agen'
  ]);
        return $this->render('index', [
     //       'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
   public function actionIndexAgen()
    {
        $no_acak = Yii::$app->user->identity->no_acak;
        $searchModel = new ProgramAgenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->query->where(['no_acak'=>$no_acak]);
    
        return $this->render('index-agen', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single ProgramAgen model.
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

    public function actionDetail($id_ref_program_agen){
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query'=> ProgramAgen::find()->where(['id_ref_program_agen'=>$id_ref_program_agen])
        ]);
        
        return $this->render('detail',[
            'dataProvider'=>$dataProvider
        ]);
    }
    /**
     * Creates a new ProgramAgen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
$modelRefProgram = \backend\models\RefProgramAgen::dropdownlist();
        $model = new ProgramAgen();
$listAgen = \backend\models\DataAgen::dropdownagenAll();
            
        if ($model->load(Yii::$app->request->post())) {
            $id_data_agen=$model->id_data_agen;
            $dataAgen = \backend\models\DataAgen::find()->where(['id'=>$id_data_agen])->one();
            $model->no_acak=$dataAgen['no_acak'];
         //   $model->id_data_agen=$dataAgen['id'];
            $model->tahun=date('Y');
             if($model->save()){
            return $this->redirect(Yii::$app->request->referrer);
             }else{
                 Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
           return \kartik\form\ActiveForm::validate($model);
             }
        }

        return $this->renderAjax('_form', [
            'model' => $model,
            'modelRefProgram'=>$modelRefProgram,
            'listAgen'=>$listAgen
        ]);
    }

    /**
     * Updates an existing ProgramAgen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProgramAgen model.
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
     * Finds the ProgramAgen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProgramAgen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProgramAgen::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
