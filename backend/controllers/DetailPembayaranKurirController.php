<?php

namespace backend\controllers;

use Yii;
use backend\models\DetailPembayaranKurir;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DetailPembayaranKurirController implements the CRUD actions for DetailPembayaranKurir model.
 */
class DetailPembayaranKurirController extends Controller
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
     * Lists all DetailPembayaranKurir models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => DetailPembayaranKurir::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DetailPembayaranKurir model.
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
     * Creates a new DetailPembayaranKurir model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($no_invoice)
    {
        $model = new DetailPembayaranKurir();
        $model->no_invoice = $no_invoice;
        $detailPembayaran = \backend\models\DetailPembayaran::find()->where(['no_invoice'=>$no_invoice])->one();
        if($detailPembayaran['id_ref_kurir']){
           $modelKurir = \backend\models\DataKurir::dropDownKurirByKurir($detailPembayaran['id_ref_kurir']);
        }else{
$modelKurir = \backend\models\DataKurir::dropDownKurir();
        }
        if ($model->load(Yii::$app->request->post())) {
            $modelDetailPembayaran = \backend\models\DetailPembayaran::find()->where([
                'no_invoice'=>$no_invoice
            ])->one();
            $modelDetailPembayaran->id_ref_kurir = $model->id_data_kurir;
            
            $model->status_pesanan_kurir=0; //diproses 
            if($model->save()){
               //history belanja
            $modelHistoryBelanja = new \backend\models\HistoryBelanja();
            $modelHistoryBelanja->no_invoice = $no_invoice;
            $modelHistoryBelanja->status_belanja=0;
            $modelHistoryBelanja->save(false);
            $modelDetailPembayaran->save(false);
            //
            $modelDetailPembayaranKurir = \backend\models\DetailPembayaranKurir::find()->where([
                'no_invoice'=>$no_invoice
            ])->one();
            $modelDetailPembayaranKurir->id_data_kurir=$model->id_data_kurir;
            $modelDetailPembayaranKurir->save(false);
            return $this->redirect(Yii::$app->request->referrer);
            }
        }

        return $this->renderAjax('_form', [
            'model' => $model,'modelKurir'=>$modelKurir
        ]);
    }

    /**
     * Updates an existing DetailPembayaranKurir model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DetailPembayaranKurir model.
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
     * Finds the DetailPembayaranKurir model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DetailPembayaranKurir the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DetailPembayaranKurir::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionStatusPembayaran($no_acak){
        $model = DetailPembayaranKurir::find()->where(['no_acak'=>$no_acak])->one();
        return $this->render('status-pembayaran',[
            'model'=>$model
        ]);
        
    }
     public function actionStatusPengiriman($no_invoice){
        $model = DetailPembayaranKurir::find()->where(['no_invoice'=>$no_invoice]);
        if($model->exists()){
            $model=$model->one();
        }else{
             return $this->render('status-pengiriman_1');
        }
        return $this->render('status-pengiriman',[
            'model'=>$model
        ]);
        
    }
}
