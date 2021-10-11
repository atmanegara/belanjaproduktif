<?php

namespace backend\controllers;

use Yii;
use backend\models\AturMarginItem;
use backend\models\AturMarginItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AturMarginItemController implements the CRUD actions for AturMarginItem model.
 */
class AturMarginItemController extends Controller
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
     * Lists all AturMarginItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AturMarginItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

   $modelRefBarang = \backend\models\RefBarang::dropdownlist();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelRefBarang'=>$modelRefBarang
        ]);
    }

    /**
     * Displays a single AturMarginItem model.
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
     * Creates a new AturMarginItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AturMarginItem();
   $modelRefBarang = \backend\models\RefBarang::dropdownlist();
        if ($model->load(Yii::$app->request->post())) {
 $nominal = $model->nilai;
            foreach($model->id_ref_barang as $valitem){
                $model->isNewRecord=true;
                $model->id=null;
                $model->id_ref_barang = $valitem;
                $model->nilai = $nominal;
                $model->save(false);
            }
            //if( $model->save()){
            return $this->redirect(Yii::$app->request->referrer);
       // }else{
//                 Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
//           return \kartik\form\ActiveForm::validate($model);
//            }
        }

        return $this->renderAjax('_form', [
            'model' => $model,
            'modelRefBarang'=>$modelRefBarang
        ]);
    }

    /**
     * Updates an existing AturMarginItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
$modelRefBarang = \backend\models\RefBarang::dropdownlist();
        if ($model->load(Yii::$app->request->post())) {
            
            if( $model->save()){
                //cek harga satuan di agen
                $modelcekDataBarang= \backend\models\DataBarang::find()->where([
                    'id_ref_barang'=>$model->id_ref_barang
                ]);
                if($modelcekDataBarang->exists()){
                    $allDataBarang = $modelcekDataBarang->all();
                    foreach($allDataBarang  as $idBarang){
                        $id_barang=$idBarang['id'];
                        //cek harga satuan di data barang
                        $modelBarang = \backend\models\DataBarang::findOne($id_barang);
                        $modelBarang->isNewRecord=false;
                        $modelBarang->harga_satuan=$model->harga_satuan;
                        $modelBarang->save(false);
                        //cek harga satuan di stok barang agen
                          $modelSotokBarang = \backend\models\StokBarang::find()->where(['id_data_barang'=>$id_barang])->one();
                        $modelSotokBarang->isNewRecord=false;
                        $margin = ($model->harga_satuan*($model->nilai/100));
                        
                        $harga_jual = $model->harga_satuan+$margin;
                        $modelSotokBarang->harga_jual=$harga_jual;
                        $modelSotokBarang->save(false);
                    }
                }
            return $this->redirect(Yii::$app->request->referrer);
    }else{
                 Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
           return \kartik\form\ActiveForm::validate($model);
            }
        }
        return $this->renderAjax('_form', [
            'model' => $model,
            'modelRefBarang'=>$modelRefBarang
        ]);
    }

    /**
     * Deletes an existing AturMarginItem model.
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
     * Finds the AturMarginItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AturMarginItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AturMarginItem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
