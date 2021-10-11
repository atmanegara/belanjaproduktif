<?php

namespace backend\controllers;

use Yii;
use backend\models\DataLevel;
use backend\models\DataLevelSearch;
use backend\models\DataAgen;
use backend\models\DataAgenSearch;
use backend\models\DataAgenLevelSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DataLevelController implements the CRUD actions for DataLevel model.
 */
class DataLevelController extends Controller
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
     * Lists all DataLevel models.
     * @return mixed
     */
    public function actionIndex(){

        $searchModel = new DataAgenLevelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
     
       return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
  
        ]);
    }
    public function actionIndexold()
    {
        $searchModel = new DataLevelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DataLevel model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($no_acak)
    {
        
        $modelDataAgen = DataAgen::findOne(['no_acak'=>$no_acak]);
        //list data riwayat level
          $searchModel = new DataLevelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['no_acak'=>$no_acak]);
       
        return $this->render('view', [
            'modelDataAgen' => $modelDataAgen,
              'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new DataLevel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new DataLevel();
        $modelDataAgen = DataAgen::findOne($id);
        $modelRefAgen = \backend\models\RefAgen::getDropdownlistByAktif();
        if ($model->load(Yii::$app->request->post())) {
            $no_acak = $modelDataAgen['no_acak'];
            $id_ref_agen = $modelDataAgen['id_ref_agen'];
            $model->no_acak=$no_acak;
            $model->dari_id_ref_agen=$id_ref_agen;
            $model->tgl_masuk = date('Y-m-d');
            if($model->save()){
                $nama_agen = \backend\models\RefAgen::findOne($model->ke_id_ref_agen)->kd_agen;
                $id_agen = $nama_agen.str_pad($modelDataAgen->id, 8, '0', STR_PAD_LEFT);
                  $modelDataAgen->id_agen = $id_agen;
                $modelDataAgen->id_ref_agen=$model->ke_id_ref_agen;
                if(in_array($id_ref_agen,['7'])){
                    $modelDataAgen->no_acak_ref='';
                }
                if($modelDataAgen->save()){
                    $dataRuler= \backend\models\Role::find()->where(['id_ref_agen'=>$model->ke_id_ref_agen])->one();
               //     return var_dump($dataRuler);//
                    $idroler=$dataRuler['id'];
                    
                    $dataUser = \backend\models\User::find()->where(['no_acak'=>$no_acak])->one();
                    $dataUser->id_ref_agen=$model->ke_id_ref_agen;
                    $dataUser->role_id=$idroler;
                    $dataUser->save(false);
                }
                $dataAnggota = \backend\models\DataAnggota::find()->where([
                    'no_acak_agen' =>$no_acak
                ]);
                if($dataAnggota->exists()){
                    $modelDataAnggota = $dataAnggota->all();
                    foreach($modelDataAnggota as $valAnggota){
                        $dataRegistrasi = \backend\models\ArsipRegistrasiAgen::find()
                                ->where(['no_acak'=>$valAnggota['no_acak']]);
                        if($dataRegistrasi->exists()){
                            $agen = $dataRegistrasi->one();
                            $no_acak_agen = $agen['no_acak'];
                          $sql = "Update arsip_registrasi_agen set id_referen_agen=:id_referen_agen where no_acak=:no_acak";
                          $params=[
                              ':no_acak'=>$no_acak_agen,
                              'id_referen_agen'=>$id_agen
                          ];
                          Yii::$app->db->createCommand($sql, $params)->execute();
                          
                           $sql = "Update registrasi_agen set id_referen_agen=:id_referen_agen where no_acak=:no_acak";
                          $params=[
                              ':no_acak'=>$no_acak_agen,
                              'id_referen_agen'=>$id_agen
                          ];
                          Yii::$app->db->createCommand($sql, $params)->execute();
                        }
                    }
      
                }
                
                   $sql = "Update registrasi_agen set id_ref_agen=:id_ref_agen where no_acak=:no_acak";
                          $params=[
                              ':no_acak'=>$no_acak,
                             // 'id_referen_agen'=>$id_agen,
                              ':id_ref_agen'=>$model->ke_id_ref_agen
                          ];
                          Yii::$app->db->createCommand($sql, $params)->execute();
                          //pembayaran
                $modelCekPembayaranLama = \backend\models\KonfirmasiPembayaran::find()->where(['no_acak'=>$no_acak]);
                if($modelCekPembayaranLama->exists()){
                $modelPembayaran = $modelCekPembayaranLama->one(); //
                }else{
                  $modelPembayaran=  new \backend\models\KonfirmasiPembayaran();
                }                
//insert ke arsip yg lama
                $sql ="insert into konfirmasi_pembayaran_arsip select * from konfirmasi_pembayaran where no_acak=:no_acak";
                $params=[
                    ':no_acak'=>$no_acak
                ];
                Yii::$app->db->createCommand($sql, $params)->execute();
                
                $modelPembayaran->no_invoice = \backend\models\QueryModel::noinvoice();
                $modelPembayaran->no_acak = $no_acak;
                $id_status_pembayaran = 3;
                $id_role = 0;
                $id_status_dp = 1;
                if (in_array($model->ke_id_ref_agen, ['3', '4', '7'])) {
                    $id_status_pembayaran = 3;
                    $id_status_dp = 2;
                    $id_role = \backend\models\Role::findOne(['id_ref_agen' => $model->ke_id_ref_agen])->id;
                }
                $modelPembayaran->id_status_pembayaran = $id_status_pembayaran;
                $modelPembayaran->id_status_dp = $id_status_dp;
                $modelPembayaran->save(false);
               
            return $this->redirect(Yii::$app->request->referrer);
            }
        }

        return $this->renderAjax('_form', [
            'model' => $model,
            'modelDataAgen'=>$modelDataAgen,
            'modelRefAgen'=>$modelRefAgen
        ]);
    }

    /**
     * Updates an existing DataLevel model.
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

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DataLevel model.
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
     * Finds the DataLevel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DataLevel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DataLevel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
