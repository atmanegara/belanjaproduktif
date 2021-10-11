<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller {

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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new \common\models\User();
        $itemsRole = \backend\models\Role::find()->where(['id' => ['7', '8', '10']])->asArray()->all();
        if ($model->load(Yii::$app->request->post())) {
            $model->setPassword($model->password_string);
            $model->generateAuthKey();
            $model->save();
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderAjax('_form', [
                    'model' => $model,
                    'itemsRole' => $itemsRole
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $itemsRole = \backend\models\Role::find()->where(['id' => ['7', '8', '10']])->asArray()->all();
        if ($model->load(Yii::$app->request->post())) {
            $modelx = \common\models\User::findOne($id);
            $modelx->setPassword($model->password_string);
            $modelx->generateAuthKey();
            $modelx->save();
            $model->save(false);
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderAjax('_form', [
                    'model' => $model,
                    'itemsRole' => $itemsRole
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $model = $this->findModel($id); //->delete();
        $no_acak = $model['no_acak'];
        $dataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak])->one();
        \backend\models\DataAgen::deleteAll(['no_acak' => $no_acak]);
        \backend\models\RegistrasiAgen::deleteAll(['no_acak' => $no_acak]);
     \backend\models\ArsipRegistrasiAgen::deleteAll(['no_acak'=>$no_acak]);
        \backend\models\DataBarang::deleteAll(['id_data_agen' => $dataAgen['id']]);
        \backend\models\DataToko::deleteAll(['id_data_agen'=>$dataAgen['id']]);
     //   \backend\models\DataKomisi::deleteAll(['id_data_agen' => $dataAgen['id']]);
        \backend\models\DataSaldo::deleteAll(['no_acak' => $no_acak]);
      //  \backend\models\TransaksiKomisi::deleteAll(['no_acak_penerima'=>$no_acak]);
        \backend\models\DataAnggota::deleteAll(['no_acak'=>$no_acak]);
     //   \backend\models\TransaksiSaldo::
        $model->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDeleteAll() {
        $selection = Yii::$app->request->post('id');
        foreach ($selection as $val) {
            $model = $this->findModel($val);
            $no_acak = $model['no_acak'];
            $dataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak])->one();
            $model->delete();
            \backend\models\DataAgen::deleteAll(['no_acak' => $no_acak]);
            \backend\models\RegistrasiAgen::deleteAll(['no_acak' => $no_acak]);
            \backend\models\DataBarang::deleteAll(['id_data_agen' => $dataAgen['id']]);
            \backend\models\DataSaldo::deleteAll(['no_acak' => $no_acak]);
        \backend\models\DataAnggota::deleteAll(['no_acak'=>$no_acak]);
        \backend\models\DataToko::deleteAll(['id_data_agen'=>$dataAgen['id']]);
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionLoginas($token = null) {
        if ($token == null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        if (Yii::$app->user->loginByAccessToken($token)) {

            //reset token
            User::updateAll([
                'auth_key' => Yii::$app->security->generateRandomString()],
                    "auth_key = '" . $token . "'"
            );

            return $this->goHome();
        } else {
            return $this->goBack();
        }
    }

    public function actionLogoutUser() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
