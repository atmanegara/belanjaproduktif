<?php

namespace backend\controllers;

use Yii;
use backend\models\DataAgenWaris;
use backend\models\DataAgenWarisSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\RefBank;
use yii\bootstrap4\ActiveForm;
use yii\web\Response;

/**
 * DataAgenWarisController implements the CRUD actions for DataAgenWaris model.
 */
class DataAgenWarisController extends Controller
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
     * Lists all DataAgenWaris models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DataAgenWarisSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DataAgenWaris model.
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
     * Creates a new DataAgenWaris model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_data_agen,$no_acak)
    {
        
        $modelRefBank = RefBank::getDropdownbank();
        $model = new DataAgenWaris();
        if ($model->load(Yii::$app->request->post())) {
            $model->id_data_agen = $id_data_agen;
            $model->no_acak=$no_acak;
            if($model->save()){
            return $this->redirect(Yii::$app->request->referrer); //Yii::$app->request->referrer);
            }else{
                Yii::$app->response->format= Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->renderAjax('_form', [
            'model' => $model,
            'modelRefBank'=>$modelRefBank
        ]);
    }

    /**
     * Updates an existing DataAgenWaris model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
       $modelRefBank = RefBank::getDropdownbank();
 
        if ($model->load(Yii::$app->request->post()) ) {
 if($model->save()){
            return $this->redirect(Yii::$app->request->referrer); //Yii::$app->request->referrer);
            }else{
                Yii::$app->response->format= Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
             }

        return $this->renderAjax('_form', [
            'model' => $model,
            'modelRefBank'=>$modelRefBank
       ]);
    }

    /**
     * Deletes an existing DataAgenWaris model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

      return $this->redirect(Yii::$app->request->referrer); //Yii::$app->request->referrer);
          }

    /**
     * Finds the DataAgenWaris model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DataAgenWaris the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DataAgenWaris::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
