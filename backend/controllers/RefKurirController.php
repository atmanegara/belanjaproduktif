<?php

namespace backend\controllers;

use Yii;
use backend\models\RefKurir;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RefKurirController implements the CRUD actions for RefKurir model.
 */
class RefKurirController extends Controller
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
     * Lists all RefKurir models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => RefKurir::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RefKurir model.
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
     * Creates a new RefKurir model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RefKurir();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderAjax('_form', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RefKurir model.
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

        return $this->renderAjax('_form', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing RefKurir model.
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
     * Finds the RefKurir model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RefKurir the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RefKurir::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionCektarif(){
        $hari = date('N', strtotime(Yii::$app->request->get('tglhari')));
        $id_ref_kurir = Yii::$app->request->get('id_ref_kurir');
        $jam_kirim = Yii::$app->request->get('jam_kirim');
        
        $tarifkurir = \backend\models\TarifKurir::find()
                ->where(['id_ref_kurir'=>$id_ref_kurir])
                ->andWhere(['hari'=>$hari])
               ->andWhere('CAST(:jam_kirim as TIME) BETWEEN jam_awal and jam_akhir', [
                   ':jam_kirim'=>$jam_kirim
               ])->one();
         $tarifoPerasi = \backend\models\TarifKurir::find()
                ->where(['id_ref_kurir'=>$id_ref_kurir])
                ->andWhere(['hari'=>$hari])
               ->one();
        return \yii\helpers\Json::encode([
            'ongkir'=>$tarifkurir['tarif'],
            'jamoperasi'=>$tarifoPerasi['jam_awal'].' s/d '.$tarifoPerasi['jam_akhir']
        ]);
        
    }
}
