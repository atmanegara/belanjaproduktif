<?php

namespace backend\controllers;

use Yii;
use backend\models\RefSyaratAgen;
use backend\models\RefSyaratAgenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\RefAgen;

/**
 * RefSyaratAgenController implements the CRUD actions for RefSyaratAgen model.
 */
class RefSyaratAgenController extends Controller {

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
     * Lists all RefSyaratAgen models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new RefSyaratAgenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RefSyaratAgen model.
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
     * Creates a new RefSyaratAgen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new RefSyaratAgen();
        $modelRefAgen = RefAgen::getDropdownlist();
        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {

                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

                return \kartik\form\ActiveForm::validate($model);
            }

            if ($model->save()) {
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return \kartik\form\ActiveForm::validate($model);
            }
        }

        return $this->renderAjax('_form', [
                    'model' => $model,
                    'modelRefAgen' => $modelRefAgen
        ]);
    }

    /**
     * Updates an existing RefSyaratAgen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id,$syarat) {
        $model = $this->findModel($id);
        $modelRefAgen = RefAgen::getDropdownlist();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return \kartik\form\ActiveForm::validate($model);
            }
        }
        return $this->renderAjax('update', [
            'syarat'=>$syarat,
                    'model' => $model,
                    'modelRefAgen' => $modelRefAgen
        ]);
    }

    /**
     * Deletes an existing RefSyaratAgen model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the RefSyaratAgen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RefSyaratAgen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = RefSyaratAgen::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
