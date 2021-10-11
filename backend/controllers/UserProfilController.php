<?php

namespace backend\controllers;

use Yii;
use backend\models\UserProfil;
use backend\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserProfilController implements the CRUD actions for UserProfil model.
 */
class UserProfilController extends Controller
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
     * Lists all UserProfil models.
     * @return mixed
     */
    public function actionIndex()
    {
        $id_user = Yii::$app->user->getId();
        $query = (new \yii\db\Query())
                ->select('a.id,a.username,a.password_string,b.nama_lengkap,b.foto_user')
                ->from('user a')
                ->leftJoin('user_profil b','a.id=b.id_user')
                ->where(['a.id'=>$id_user]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key'=>'id'
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserProfil model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserProfil model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserProfil();
        $model->id_user = Yii::$app->user->identity->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->renderAjax('_form', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UserProfil model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
       $model = User::findOne($id);
     //   $itemsRole = \backend\models\Role::find()->where(['id' => ['7', '8', '10']])->asArray()->all();
        if ($model->load(Yii::$app->request->post())) {
            $modelx = \common\models\User::findOne($id);
            $password_stringold = $modelx->password_string;
            $password_string=$model->password_string;
            $modelx->password_string = $password_string;
            
            $modelx->setPassword($password_string);
            $modelx->generateAuthKey();
            $model->save(false);
            $modelx->save(false);
            $modelCekProfil = UserProfil::find()->where(['id_user'=>$id]);
            if($modelCekProfil->exists()){
                $modelProfil = $modelCekProfil->one();
            }else{
                $modelProfil = new UserProfil();
                $modelProfil->isNewRecord=true;
                $modelProfil->id_user = $id;
            }
            $modelProfil->nama_lengkap = $model->nama_lengkap;
            $modelProfil->save(false);
            if($password_stringold!=$password_string){
                  Yii::$app->user->logout();
                       return $this->goHome();
            }
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderAjax('_form', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UserProfil model.
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
     * Finds the UserProfil model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserProfil the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserProfil::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
