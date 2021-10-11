<?php

namespace backend\controllers;

use Yii;
use backend\models\TransaksiKomisi;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TransaksiKomisiController implements the CRUD actions for TransaksiKomisi model.
 */
class TransaksiKomisiController extends Controller
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
     * Lists all TransaksiKomisi models.
     * @return mixed
     */
    public function actionIndex($no_acak=null)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => TransaksiKomisi::find()->leftJoin('data_komisi','transaksi_komisi.id_data_agen=data_komisi.id_data_agen '
                    . 'AND transaksi_komisi.no_acak_penerima=data_komisi.no_acak'),
        ]);
        if($no_acak){
            $dataProvider->query->where(['no_acak_penerima'=>$no_acak]);
        }
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TransaksiKomisi model.
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
public function actionViewTransaksiKomisi($no_acak){
    $dataTransaksiKOmisi = TransaksiKomisi::find()->where(['no_acak_penerima'=>$no_acak]);
    
    $dataProviderTransaksiKomisi = new ActiveDataProvider([
        'query'=>$dataTransaksiKOmisi
    ]);
    return $this->render('view-transaksi', [
            'dataProvider' => $dataProviderTransaksiKomisi,
        ]);
}
    /**
     * Creates a new TransaksiKomisi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TransaksiKomisi();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TransaksiKomisi model.
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
     * Deletes an existing TransaksiKomisi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        
       $model =  $this->findModel($id);
        $no_acak_penerima = $model['no_acak_penerima'];
        $nominal = $model['nominal'];
       if($model->delete()){
           $modelDataKomisi = \backend\models\DataKomisi::find()->where([
               'no_acak'=>$no_acak_penerima
           ])->one();
           $sisaNominal = $modelDataKomisi['nominal']-$nominal;
           $modelDataKomisi->nominal = $sisaNominal;
           $modelDataKomisi->save(false);
       }

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the TransaksiKomisi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransaksiKomisi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransaksiKomisi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
