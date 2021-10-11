<?php

namespace backend\controllers;

use Yii;
use backend\models\AturBagiHasilProgram;
use backend\models\AturBagiHasilProgramSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AturBagiHasilProgramController implements the CRUD actions for AturBagiHasilProgram model.
 */
class AturBagiHasilProgramController extends Controller
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
     * Lists all AturBagiHasilProgram models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AturBagiHasilProgramSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AturBagiHasilProgram model.
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
     * Creates a new AturBagiHasilProgram model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AturBagiHasilProgram();

       $modelRefAgen = \backend\models\RefAgen::getDropdownlist();
       $modelRefProgramAgen = \backend\models\RefProgramAgen::dropdownlist();
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
            'modelRefAgen'=>$modelRefAgen,
            'modelRefProgramAgen'=>$modelRefProgramAgen
        ]);
    }

    /**
     * Updates an existing AturBagiHasilProgram model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

       $modelRefAgen = \backend\models\RefAgen::getDropdownlist();
       $modelRefProgramAgen = \backend\models\RefProgramAgen::dropdownlist();
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
            'modelRefAgen'=>$modelRefAgen,
            'modelRefProgramAgen'=>$modelRefProgramAgen
        ]);
    }

    /**
     * Deletes an existing AturBagiHasilProgram model.
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
     * Finds the AturBagiHasilProgram model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AturBagiHasilProgram the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AturBagiHasilProgram::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
