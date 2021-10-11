<?php

namespace backend\controllers;

use Yii;
use backend\models\KonfirmasiTopup;
use backend\models\KonfirmasiTopupSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\QueryModel;
use yii\web\UploadedFile;
use backend\models\RefBank;
use backend\models\DataAgen;
use backend\models\StatusPembayaran;
use backend\models\DataSaldo;
use backend\models\TransaksiSaldo;
use kartik\growl\Growl;

/**
 * KonfirmasiTopupController implements the CRUD actions for KonfirmasiTopup model.
 */
class KonfirmasiTopupController extends Controller
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
     * Lists all KonfirmasiTopup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $totalBelumVerifikasi = KonfirmasiTopup::find()->where(['id_status_pembayaran'=>1])->count(); //Menunggu Verifikasi
        $totalBelumKOnfirmasi = KonfirmasiTopup::find()->where(['id_status_pembayaran'=>3])->count(); //Menunggu Pembayaran
        $totalterkonfirmasi = KonfirmasiTopup::find()->where(['id_status_pembayaran'=>2])->count(); //konfirmasi
        $totaltolak = KonfirmasiTopup::find()->where(['id_status_pembayaran'=>4])->count(); //tolak
        
        $searchModel = new KonfirmasiTopupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'totalBelumKOnfirmasi'=>$totalBelumKOnfirmasi,
            'totalBelumVerifikasi'=>$totalBelumVerifikasi,
            'totalterkonfirmasi'=>$totalterkonfirmasi,
            'totaltolak'=>$totaltolak
        ]);
    }
    public function actionDetail()
    {
        $role_id = Yii::$app->user->identity->role_id;
        $searchModel = new KonfirmasiTopupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
   if(in_array($role_id, ['1'])){
        $dataProvider->query->where(['id_status_pembayaran'=>1]);
       
   }else{
        $no_acak = Yii::$app->user->identity->no_acak;
        $dataProvider->query->where(['konfirmasi_topup.no_acak'=>$no_acak]);
   }
        return $this->render('detail', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
     public function actionDetailVerifikasi()
    {
        $role_id = Yii::$app->user->identity->role_id;
        $searchModel = new KonfirmasiTopupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       $dataProvider->query->where(['id_status_pembayaran'=>2]);
       
  
        return $this->render('detail-verifikasi', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
        public function actionDetailBatal()
    {
        $role_id = Yii::$app->user->identity->role_id;
        $no_acak = Yii::$app->user->identity->no_acak;
        $searchModel = new \backend\models\KonfirmasiTopupBatalSearch();
        $searchModel->no_acak=$no_acak;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
   
        return $this->render('detail-batal', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
     public function actionKonfirmasi($id_status_pembayaran)
    {
        $role_id = Yii::$app->user->identity->role_id;
        $searchModel = new KonfirmasiTopupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 
        $dataProvider->query->where(['id_status_pembayaran'=>$id_status_pembayaran]);
       
 
        return $this->render('konfirmasi', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single KonfirmasiTopup model.
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
     * Creates a new KonfirmasiTopup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $no_acak=Yii::$app->user->identity->no_acak;
        $model = new KonfirmasiTopup();
        $modelTentangKami = \backend\models\TentangKami::find()->one();
        $model->no_invoice = '#'.QueryModel::noinvoice();
        if ($model->load(Yii::$app->request->post())) {
            $model->id_status_pembayaran=3; //belum  bayar sanak
            $model->no_acak = $no_acak;
            $model->save(false);
            return $this->redirect(['detail']);
        }

        return $this->renderAjax('_form_saldo', [
            'model' => $model,
            'modelTentangKami'=>$modelTentangKami
        ]);
    }
    public function actionCreateSaldo()
    {
         $model = new KonfirmasiTopup();
      $modelTentangKami = \backend\models\TentangKami::find()->one();
         $dataAgen = DataAgen::dropdownagenAllNoAcak();
        $model->no_invoice = '#'.QueryModel::noinvoice();
        if ($model->load(Yii::$app->request->post())) {
            $model->id_status_pembayaran=3; //belum  bayar sanak
        //    $model->no_acak = $no_acak;
            $model->save(false);
            return $this->redirect(['detail']);
        }

        return $this->renderAjax('create_saldo', [
            'model' => $model,
            'dataAgen'=>$dataAgen,
            'modelTentangKami'=>$modelTentangKami
        ]);
    }
    /**
     * Updates an existing KonfirmasiTopup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdatePembayaran($id)
    {
        $model = $this->findModel($id);
        $no_acak=$model['no_acak'];
        $modelRefBank = RefBank::getDropdownbank();
        $modelDataAgen = DataAgen::getOneRowByNoacak($no_acak);
        $modelStatusPembayaran = StatusPembayaran::Dropdownlist();
        if ($model->load(Yii::$app->request->post())) {
            
            if($model->save(false)){
                $model->id_ket_saldo=1;
                   $model->id_status_pembayaran=1;
                   $model->tgl_transfer = date('Y-m-d', strtotime($model->tgl_transfer));
                   $model->filedok = UploadedFile::getInstance($model, 'filedok');
                   
                   if ($model->upload()) {
                       
                       if ($model->save(false)) {
                           
                    
                    Yii::$app->session->setFlash('success','Sukses');
                 
                
                return $this->redirect(Yii::$app->request->referrer);
                       }
                   }
            }
        }
        
        return $this->renderAjax('_form_pembayaran', [
            'model' => $model,
            'modelRefBank'=>$modelRefBank,
            'modelDataAgen'=>$modelDataAgen,
            'modelStatusPembayaran'=>$modelStatusPembayaran
        ]);
    }
    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelRefBank = RefBank::getDropdownbank();
        $modelDataAgen = DataAgen::getOneRowByNoacak($model['no_acak']);
        $modelStatusPembayaran = StatusPembayaran::Dropdownlist();
        $modelTransfer = \backend\models\MetodeTransfer::dropdownlist();
        if ($model->load(Yii::$app->request->post())) {
          
            $model->id_user = Yii::$app->user->identity->id;
            if($model->save(false)){
         //   $model->id_status_pembayaran=1;
            if($model->id_status_pembayaran=='2'){
                $modelTransaksiSaldo = new TransaksiSaldo();
                $modelTransaksiSaldo->no_acak = $model['no_acak'];
                $modelTransaksiSaldo->no_invoice = $model['no_invoice'];
                if($model->id_ket_saldo==2){
                $modelTransaksiSaldo->nominal_keluar = $model['nominal'];
                $modelTransaksiSaldo->nominal_sisa = DataSaldo::nominaldulu($model['no_acak'])-$model['nominal'];
                $modelTransaksiSaldo->id_ket_saldo=2;    
                }else{
                $modelTransaksiSaldo->nominal_masuk = $model['nominal'];
                $modelTransaksiSaldo->nominal_sisa = DataSaldo::nominaldulu($model['no_acak'])+$model['nominal'];
              $modelTransaksiSaldo->id_ket_saldo=1;  
              }
                $modelTransaksiSaldo->tgl_transaksi = $model['tgl_transfer'];
                $modelTransaksiSaldo->id_metode_transfer = $model['id_metode_transfer'];
                $modelTransaksiSaldo->id_ref_bank = $model['from_bank'];
                $modelTransaksiSaldo->save(false);
                
                $dataSaldocek = DataSaldo::find()->where(['no_acak'=>$model['no_acak']]);
                if($dataSaldocek->exists()){
                    $modelDataSaldo = $dataSaldocek->one();
                }else{
                $modelDataSaldo = new DataSaldo();
                }
             //   return var_dump($model['no_acak']);
                $modelDataSaldo->no_acak = $model['no_acak'];
                $modelDataSaldo->tgl_masuk = date('Y-m-d');
                  if($model->id_ket_saldo==2){
                $modelDataSaldo->nominal_awal = DataSaldo::nominaldulu($model['no_acak'])-$model['nominal'];
                      
                  }else{
                $modelDataSaldo->nominal_awal = DataSaldo::nominaldulu($model['no_acak'])+$model['nominal'];
                  }
                $modelDataSaldo->save(false);
             
                Yii::$app->session->setFlash('success','Sukses');
          
            }
            
            return $this->redirect(Yii::$app->request->referrer);
            }
        }

        return $this->renderAjax('_form', [
            'model' => $model,
            'modelRefBank'=>$modelRefBank,
            'modelDataAgen'=>$modelDataAgen,
            'modelStatusPembayaran'=>$modelStatusPembayaran,
            'modelTransfer'=>$modelTransfer
        ]);
    }
     public function actionUpdatePencairan($id)
    {
        $model = $this->findModel($id);
        $modelRefBank = RefBank::getDropdownbank();
        $modelDataAgen = DataAgen::getOneRowByNoacak($model['no_acak']);
        $modelStatusPembayaran = StatusPembayaran::Dropdownlist();
        $modelTransfer = \backend\models\MetodeTransfer::dropdownlist();
        if ($model->load(Yii::$app->request->post())) {
          
            $model->id_user = Yii::$app->user->identity->id;
            if($model->save(false)){
         //   $model->id_status_pembayaran=1;
            if($model->id_status_pembayaran=='2'){
                $modelTransaksiSaldo = new TransaksiSaldo();
                $modelTransaksiSaldo->no_acak = $model['no_acak'];
                $modelTransaksiSaldo->no_invoice = $model['no_invoice'];
                if($model->id_ket_saldo==2){
                $modelTransaksiSaldo->nominal_keluar = $model['nominal'];
                $modelTransaksiSaldo->nominal_sisa = DataSaldo::nominaldulu($model['no_acak'])-$model['nominal'];
                $modelTransaksiSaldo->id_ket_saldo=2;    
                }else{
                $modelTransaksiSaldo->nominal_masuk = $model['nominal'];
                $modelTransaksiSaldo->nominal_sisa = DataSaldo::nominaldulu($model['no_acak'])+$model['nominal'];
              $modelTransaksiSaldo->id_ket_saldo=1;  
              }
                $modelTransaksiSaldo->tgl_transaksi = $model['tgl_transfer'];
                $modelTransaksiSaldo->id_metode_transfer = $model['id_metode_transfer'];
                $modelTransaksiSaldo->id_ref_bank = $model['from_bank'];
                $modelTransaksiSaldo->save(false);
                
                $dataSaldocek = DataSaldo::find()->where(['no_acak'=>$model['no_acak']]);
                if($dataSaldocek->exists()){
                    $modelDataSaldo = $dataSaldocek->one();
                }else{
                $modelDataSaldo = new DataSaldo();
                }
             //   return var_dump($model['no_acak']);
                $modelDataSaldo->no_acak = $model['no_acak'];
                $modelDataSaldo->tgl_masuk = date('Y-m-d');
                  if($model->id_ket_saldo==2){
                $modelDataSaldo->nominal_awal = DataSaldo::nominaldulu($model['no_acak'])-$model['nominal'];
                      
                  }else{
                $modelDataSaldo->nominal_awal = DataSaldo::nominaldulu($model['no_acak'])+$model['nominal'];
                  }
                $modelDataSaldo->save(false);
             
                Yii::$app->session->setFlash('success','Sukses');
          
            }
            
            return $this->redirect(Yii::$app->request->referrer);
            }
        }

        return $this->renderAjax('_form_pencairan', [
            'model' => $model,
            'modelRefBank'=>$modelRefBank,
            'modelDataAgen'=>$modelDataAgen,
            'modelStatusPembayaran'=>$modelStatusPembayaran,
            'modelTransfer'=>$modelTransfer
        ]);
    }
  public function actionUpdateRe($id)
    {
        $model = $this->findModel($id);
        $modelRefBank = RefBank::getDropdownbank();
        $modelDataAgen = DataAgen::getOneRowByNoacak($model['no_acak']);
        $modelStatusPembayaran = StatusPembayaran::Dropdownlist();
        $modelTransfer = \backend\models\MetodeTransfer::dropdownlist();
        if ($model->load(Yii::$app->request->post())) {
          $model->id_status_pembayaran=4;
          $model->id_ket_saldo=4;
            $model->id_user = Yii::$app->user->identity->id;
            if($model->save(false)){
       
                $modelTransaksiSaldo = DataSaldo::find()
                        ->where([
                            'no_acak'=>$model['no_acak'],
                        ]);
 
             $dataSaldocek = DataSaldo::find()->where(['no_acak'=>$model['no_acak']]);
                if($dataSaldocek->exists()){
                    $modelDataSaldo = $dataSaldocek->one();
                $modelDataSaldo->nominal_awal = DataSaldo::nominaldulu($model['no_acak'])-$model['nominal'];
                      
               
                $modelDataSaldo->save(false);
                }
                Yii::$app->session->setFlash('success','Sukses');
         
            
            return $this->redirect(Yii::$app->request->referrer);
            }
        }

        return $this->renderAjax('_form_re', [
            'model' => $model,
            'modelRefBank'=>$modelRefBank,
            'modelDataAgen'=>$modelDataAgen,
            'modelStatusPembayaran'=>$modelStatusPembayaran,
            'modelTransfer'=>$modelTransfer
        ]);
    }
    /**
     * Deletes an existing KonfirmasiTopup model.
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
     * Finds the KonfirmasiTopup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KonfirmasiTopup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KonfirmasiTopup::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionDetailSaldo($id){
        $model= KonfirmasiTopup::find()->where(['id'=>$id])->one();
        return $this->render('detail-saldo',[
            'model'=>$model
        ]);
    }
   
}
