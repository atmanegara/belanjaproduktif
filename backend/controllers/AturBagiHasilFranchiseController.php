<?php

namespace backend\controllers;

use Yii;
use backend\models\AturBagiHasilFranchise;
use backend\models\AturBagiHasilFranchiseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AturBagiHasilFranchiseController implements the CRUD actions for AturBagiHasilFranchise model.
 */
class AturBagiHasilFranchiseController extends Controller
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
     * Lists all AturBagiHasilFranchise models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AturBagiHasilFranchiseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AturBagiHasilFranchise model.
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
     * Creates a new AturBagiHasilFranchise model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AturBagiHasilFranchise();
$modelRefAgen = \backend\models\RefAgen::getDropdownlist();
        if ($model->load(Yii::$app->request->post()) ) {
        if($model->save()){
         return $this->redirect(Yii::$app->request->referrer);
        }else{
           Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
           return \kartik\form\ActiveForm::validate($model);
        }
        }

        return $this->renderAjax('_form', [
            'model' => $model,
            'modelRefAgen'=>$modelRefAgen
        ]);
    }

    /**
     * Updates an existing AturBagiHasilFranchise model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

$modelRefAgen = \backend\models\RefAgen::getDropdownlist();
        if ($model->load(Yii::$app->request->post()) ) {
        if($model->save()){
            return $this->redirect(Yii::$app->request->referrer);
        }else{
           Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
           return \kartik\form\ActiveForm::validate($model);
        }
        }

        return $this->renderAjax('update', [
            'model' => $model,
            'modelRefAgen'=>$modelRefAgen
        ]);
    }

    /**
     * Deletes an existing AturBagiHasilFranchise model.
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
     * Finds the AturBagiHasilFranchise model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AturBagiHasilFranchise the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AturBagiHasilFranchise::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
