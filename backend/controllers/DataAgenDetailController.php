<?php

namespace backend\controllers;

use Yii;
use backend\models\DataAgenDetail;
use backend\models\DataAgenDetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DataAgenDetailController implements the CRUD actions for DataAgenDetail model.
 */
class DataAgenDetailController extends Controller
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
     * Lists all DataAgenDetail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DataAgenDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DataAgenDetail model.
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
     * Creates a new DataAgenDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DataAgenDetail();
        $model->no_acak = Yii::$app->user->identity->no_acak;
        $modelRefBank = \backend\models\RefBank::getDropdownbank();
     
   if ($model->load(Yii::$app->request->post())) {
            if($model->save()){
            return $this->redirect(Yii::$app->request->referrer);
            }else{
                    Yii::$app->response->format= \yii\web\Response::FORMAT_JSON;
                return \kartik\form\ActiveForm::validate($model);
            }
        }

        return $this->renderAjax('_form', [
            'model' => $model,
            'modelRefBank'=>$modelRefBank
        ]);
    }

    /**
     * Updates an existing DataAgenDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelRefBank = \backend\models\RefBank::getDropdownbank();

       
   if ($model->load(Yii::$app->request->post())) {
            if($model->save()){
            return $this->redirect(Yii::$app->request->referrer);
            }else{
                    Yii::$app->response->format= \yii\web\Response::FORMAT_JSON;
                return \kartik\form\ActiveForm::validate($model);
            }
        }

        return $this->renderAjax('_form', [
            'model' => $model,
            'modelRefBank'=>$modelRefBank
        ]);
    }

    /**
     * Deletes an existing DataAgenDetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

           return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the DataAgenDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DataAgenDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DataAgenDetail::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
