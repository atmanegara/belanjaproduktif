<?php

namespace backend\controllers;

use Yii;
use backend\models\DataBarangMasuk;
use backend\models\DataBarangMasukSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DataBarangMasukController implements the CRUD actions for DataBarangMasuk model.
 */
class DataBarangMasukController extends Controller
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
     * Lists all DataBarangMasuk models.
     * @return mixed
     */
    public function actionIndex()
    {
        //gudang
        $refGudang = \backend\models\RefGudang::dropDownlist();
        $refSuplier = \backend\models\RefSuplier::getDropdownlist();
        $searchModel = new DataBarangMasukSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 $model = new DataBarangMasuk();
if (Yii::$app->request->isAjax) {
        if ($model->load(Yii::$app->request->post()) ) {
           $model->save();
            //stok barang di gudang masuk
            $cekStokGudang = \backend\models\StokGudang::find()
                    ->where([
                        'id_ref_gudang'=>$model->id_ref_gudang,
                        'id_ref_barang'=>$model->id_ref_barang
                    ]);
            $stokLama = 0;
            if($cekStokGudang->exists()){
             $stokGudang = $cekStokGudang->one(); 
             $stokLama = $stokGudang->qty;
            }else{
            $stokGudang = new \backend\models\StokGudang();
            }
            $stokGudang->id_ref_barang= $model->id_ref_barang;
            $stokGudang->id_ref_gudang = $model->id_ref_gudang;
            $stokGudang->harga_satuan = $model->harga_satuan;
            $stokGudang->qty = $stokLama+$model->qty;
            $stokGudang->save(false);
      $model = new DataBarangMasuk();
   }
}
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model,
            'refGudang'=>$refGudang,
            'refSuplier'=>$refSuplier
        ]);
    }

    /**
     * Displays a single DataBarangMasuk model.
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
     * Creates a new DataBarangMasuk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DataBarangMasuk();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DataBarangMasuk model.
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
     * Deletes an existing DataBarangMasuk model.
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
     * Finds the DataBarangMasuk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DataBarangMasuk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DataBarangMasuk::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
