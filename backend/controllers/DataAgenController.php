<?php

namespace backend\controllers;

use Yii;
use backend\models\DataAgen;
use backend\models\DataAgenJoinSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\RegistrasiAgen;
use backend\models\RefAgen;
use backend\models\RefStatusSipil;
use frontend\models\RefKecamatan;
use backend\models\BerkasAgen;
use yii\data\ActiveDataProvider;
use backend\models\DataAgenWaris;
use backend\models\RefProsesPendaftaran;
use yii\web\UploadedFile;
use yii\bootstrap4\ActiveForm;
use yii\web\Response;
use backend\models\DataAgenSearch;
use backend\models\RefSyaratAgen;
use backend\models\DataAgenDetail;
use backend\models\RefBank;
use backend\models\ArsipRegistrasiAgen;
/**
 * DataAgenController implements the CRUD actions for DataAgen model.
 */
class DataAgenController extends Controller {

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
     * Lists all DataAgen models.
     * @return mixed
     */
    public function actionIndex() {

        $no_acak = '';
        $searchModel = new DataAgenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $regAgen = RegistrasiAgen::find()->where(['no_acak' => $no_acak])->one();

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'no_acak' => $no_acak,
                    'regAgen' => $regAgen
        ]);
    }

    public function actionJoin() {

        $no_acak = '';
        $searchModel = new DataAgenJoinSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //      $dataProvider->
        $regAgen = RegistrasiAgen::find()->where(['no_acak' => $no_acak])->one();

        return $this->render('index-join', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'no_acak' => $no_acak,
                    'regAgen' => $regAgen
        ]);
    }

    public function actionCreateJoin($no_acak) {
        $dataAgenModel = DataAgen::find()->where(['no_acak' => $no_acak])->one();

        $dataAgenId = DataAgen::getAgenRefId();
        if ($dataAgenModel->load(Yii::$app->request->post())) {
            $no_acak_ref = $dataAgenModel->no_acak_ref;


            $dataAgenModel->save(false);
            $data_anggotaex = \backend\models\DataAnggota::find()->where(['no_acak' => $no_acak]);
            if ($data_anggotaex->exists()) {
                $modelAnggota = $data_anggotaex->one();
            } else {
                $modelAnggota = new \backend\models\DataAnggota();
            }
            $modelAnggota->no_acak = $no_acak;
            $modelAnggota->no_acak_agen = $no_acak_ref;
            $modelAnggota->id_ref_agen = $dataAgenModel->id_ref_agen;
            $modelAnggota->nik = $dataAgenModel->nik;
            $modelAnggota->nama_agen = $dataAgenModel->nama_agen;
            $modelAnggota->alamat = $dataAgenModel->alamat;
            $modelAnggota->nope = $dataAgenModel->no_wa;
            $modelAnggota->save(false);
            //registrasi
            $modelRegistrasi = RegistrasiAgen::find()->where(['no_acak'=>$no_acak]);
            if($modelRegistrasi->exists()){
                $dataAgen = DataAgen::findOne(['no_acak'=>$no_acak_ref]);
                $modelRegistrasi->id_referensi_agen=$dataAgen['id_agen'];
                $modelRegistrasi->save(false);
            } 
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->renderAjax('create-join', [
                    'model' => $dataAgenModel,
                    'dataAgenId' => $dataAgenId
        ]);
    }

    public function actionIndexAgen() {
        $no_acak = Yii::$app->user->identity->no_acak;
        $regAgen = RegistrasiAgen::find()->where(['no_acak' => $no_acak])->one();
        $searchModel = new DataAgenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['data_agen.no_acak' => $no_acak]);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'no_acak' => $no_acak,
                    'regAgen' => $regAgen
        ]);
    }

    public function actionIndexAgenPasok() {
        $no_acak = Yii::$app->user->identity->no_acak;

        $searchModel = new DataAgenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['no_acak_ref' => $no_acak]);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'no_acak' => $no_acak
        ]);
    }

    public function actionIndexAgenNiaga() {
        $no_acak = Yii::$app->user->identity->no_acak;

        $searchModel = new DataAgenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['no_acak_ref' => $no_acak]);
        return $this->renderAjax('index-agen', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'no_acak' => $no_acak
        ]);
    }

    /**
     * Displays a single DataAgen model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($no_acak) {
        $modelRegistrasi = RegistrasiAgen::findOne(['no_acak' => $no_acak]);
        $modelex = DataAgen::find()->where(['no_acak' => $no_acak]);
        if (!$modelex->exists()) {
            Yii::$app->session->setFlash('warning', 'Data tidak ditemukan / belum lengkap, cek kembali data Pribadi Agen');
            return $this->redirect(Yii::$app->request->referrer);
        }
        $model = $modelex->one();
        //opor ayam
        $modelAgenWaris = new ActiveDataProvider([
            'query' => DataAgenWaris::find()->where([
                'id_data_agen' => $model['id']
            ])
        ]);
        //berkas
        $id_data_agen = $model['id'];
        $id_ref_agen = $model['id_ref_agen'];
        $modelBerkasAgen = new ActiveDataProvider([
            'query' => BerkasAgen::dataProviderQuery($id_data_agen)
        ]);
        
        //datatoko
        $searchModel = new \backend\models\DataTokoSearch();
        $dataProviderToko = $searchModel->search(Yii::$app->request->queryParams);
   
            $dataProviderToko->query->where(['no_acak'=>$no_acak]);
//data agen detail rekening
            $dataProviderRekening = new ActiveDataProvider([
                'query'=> DataAgenDetail::find()->where(['no_acak'=>$no_acak])
            ]);
  
        return $this->render('view', [
            'dataProviderToko'=>$dataProviderToko,
                    'model' => $model,
                    'modelBerkasAgen' => $modelBerkasAgen,
                    'modelAgenWaris' => $modelAgenWaris,
                    'id_data_agen' => $model['id'],
                    'no_acak' => $no_acak,
                    'modelRegistrasi' => $modelRegistrasi,
            'dataProviderRekening'=>$dataProviderRekening
        ]);
    }

    /**
     * Creates a new DataAgen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($no_acak) {
        $modelKabupaten = \backend\models\Kabupaten::dropdownlist();
        $id_agen = Yii::$app->user->identity->id_agen;
        $dataAgenRef = DataAgen::find()->where(['id_agen' => $id_agen])->one();
        $no_acak_ref = $dataAgenRef['no_acak'];
        $modelRegistrasi =RegistrasiAgen::findOne(['no_acak' => $no_acak]);
        $modelRefAgen = \frontend\models\RefAgen::getDropdownAgen();
        $modelStatusSipil = RefStatusSipil::DropDownlist();
        $modelRefKecamatan = RefKecamatan::getDropdownkecamatan();
        $model = new DataAgen();
        $model->id_agen = $modelRegistrasi->refAgen->kd_agen . str_pad($modelRegistrasi['id'], 8, '0', STR_PAD_LEFT);
//$model->no_acak=$modelRegistrasi['no_acak'];
        $model->id_ref_agen = $modelRegistrasi['id_ref_agen'];
        $model->nik = $modelRegistrasi['nik'];
        $model->alamat = $modelRegistrasi['alamat'];
        $model->nama_agen = $modelRegistrasi['nama'];
        if ($model->load(Yii::$app->request->post())) {
            $model->no_acak_ref = $no_acak_ref;
            $model->no_acak = $no_acak;
            $model->filedok = UploadedFile::getInstance($model, 'filedok');

            if ($model->save()) {
                //$model->save();
                $modelRegistrasi->id_ref_proses_pendaftaran = 1;
                $modelRegistrasi->save(false);
                return $this->redirect(['view','no_acak'=>$no_acak]);
            } else {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->renderAjax('_form', [
                    'model' => $model,
                    'modelRefAgen' => $modelRefAgen,
                    'modelStatusSipil' => $modelStatusSipil,
                    'modelRefKecamatan' => $modelRefKecamatan,
                    'modelKabupaten' => $modelKabupaten
        ]);
    }

    public function actionReupload($id) {
        $model = DataAgen::findOne($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->filedok = UploadedFile::getInstance($model, 'filedok');

            if ($model->reupload()) {
                if ($model->save()) {
                    return $this->redirect(Yii::$app->request->referrer);
                }
            }
        }
        return $this->renderAjax('reupload', [
                    'model' => $model
        ]);
    }

    /**
     * Updates an existing DataAgen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {

        $model = $this->findModel($id);
        $no_acak = $model['no_acak'];
        $modelKabupaten = \backend\models\Kabupaten::dropdownlist();
        $id_agen = Yii::$app->user->identity->id_agen;
        $dataAgenRef = DataAgen::find()->where(['id_agen' => $id_agen])->one();
        $no_acak_ref = $dataAgenRef['no_acak'];
    //    $modelRegistrasi = RegistrasiAgen::findOne(['no_acak' => $no_acak]);
        $modelRefAgen = \frontend\models\RefAgen::getDropdownAgen();
        $modelStatusSipil = RefStatusSipil::DropDownlist();
        $modelRefKecamatan = RefKecamatan::getDropdownkecamatan();
        //    $model = new DataAgen();
      //  $model->id_agen = $modelRegistrasi->refAgen->kd_agen . str_pad($modelRegistrasi['id'], 8, '0', STR_PAD_LEFT);
//$model->no_acak=$modelRegistrasi['no_acak'];
       // $model->id_ref_agen = $modelRegistrasi['id_ref_agen'];
 //       $model->nik = $modelRegistrasi['nik'];
       // $model->alamat = $modelRegistrasi['alamat'];
        if ($model->load(Yii::$app->request->post())) {
            $model->no_acak_ref = $no_acak_ref;
            $model->no_acak = $no_acak;
            //  $model->filedok = UploadedFile::getInstance($model, 'filedok');
            //  if($model->reupload()){
            if ($model->save()) {
                //     $modelRegistrasi->id_ref_proses_pendaftaran=3;
                //      $modelRegistrasi->save(false);
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->renderAjax('update', [
                    'model' => $model,
                    'modelRefAgen' => $modelRefAgen,
                    'modelStatusSipil' => $modelStatusSipil,
                    'modelRefKecamatan' => $modelRefKecamatan,
                    'modelKabupaten' => $modelKabupaten
        ]);
    }

    /**
     * Deletes an existing DataAgen model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteAll($no_acak) {
        DataAgen::deleteAll(['no_acak' => $no_acak]);
        RegistrasiAgen::deleteAll(['no_acak' => $no_acak]);
        \backend\models\KonfirmasiPembayaran::deleteAll(['no_acak' => $no_acak]);

//        $this->findModel($id)->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the DataAgen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DataAgen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = DataAgen::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    ///data list barang by agen promo
//     public function actionDataBarang(){
//         $dataProvider = new ActiveDataProvider([
//             'query'=>DataAgen::find();
//         ]);
//         return $this->renderAjax('data-barang',[
//             'dataProvider'=>$dataProvider
//         ]);
//     }
    
        public function actionPreviewFormulirAgen($no_acak) {


        //profil perusahanaan
        $modelTentangKami = \backend\models\TentangKami::find()->where(['id'=>1])->one();
//data foto Pribadi
        $modelFotoProfil = \backend\models\FotoProfil::find()->one();

        $modelDataAgen = DataAgen::find()->where(['no_acak' => $no_acak])->one();
        //data rekening
        $modelRekening = DataAgenDetail::find()->where(['no_acak'=>$no_acak])->one();
        //data Waris
        $modelDataWaris = DataAgenWaris::find()->where(['id_data_agen' => $modelDataAgen['id']])->one();

        
        //pembayaran
        $modelDataPembayaran = \backend\models\DataPembayaran::find()->where(['no_acak'=>$no_acak])->one();
        
        //sarayat wajib hak
        $modelSyaratWajibHak = RefSyaratAgen::find()->where(['id_ref_agen'=>$modelDataAgen['id_ref_agen']])->one();
        return $this->render('preview-formulir-agen', [
                    'modelDataAgen' => $modelDataAgen,
                    'modelDataWaris' => $modelDataWaris,
                    'modelFotoProfil' => $modelFotoProfil,
                    'modelTentangKami' => $modelTentangKami,
            'modelDataPembayaran'=>$modelDataPembayaran,
            'modelRekening'=>$modelRekening,
                    'no_acak' => $no_acak,
            'modelSyaratWajibHak'=>$modelSyaratWajibHak
        ]);
    }
    
    public function actionPrintFormulirAgen($no_acak,$export) {


        //profil perusahanaan
        $modelTentangKami = \backend\models\TentangKami::find()->where(['id'=>1])->one();
//data foto Pribadi
        $modelFotoProfil = \backend\models\FotoProfil::find()->one();

        $modelDataAgen = DataAgen::find()->where(['no_acak' => $no_acak])->one();
   //data rekening
        $modelRekening = DataAgenDetail::find()->where(['no_acak'=>$no_acak])->one();
     
        //data Waris
        $modelDataWaris = DataAgenWaris::find()->where(['id_data_agen' => $modelDataAgen['id']])->one();
    //pembayaran
        $modelDataPembayaran = \backend\models\DataPembayaran::find()->where(['no_acak'=>$no_acak])->one();
    //sarayat wajib hak
        $modelSyaratWajibHak = RefSyaratAgen::find()->where(['id_ref_agen'=>$modelDataAgen['id_ref_agen']])->one();
     $content= $this->renderPartial('formulir-agen', [
                    'modelDataAgen' => $modelDataAgen,
                    'modelDataWaris' => $modelDataWaris,
                    'modelFotoProfil' => $modelFotoProfil,
                    'modelTentangKami' => $modelTentangKami,
        'modelRekening'=>$modelRekening,
                'modelDataPembayaran'=>$modelDataPembayaran,
                    'no_acak' => $no_acak,
            'modelSyaratWajibHak'=>$modelSyaratWajibHak
        ]);
     $filename=$no_acak;
     if($export=='pdf'){
             $pdf = new \kartik\mpdf\Pdf();
            $mpdf = $pdf->api;
            $mpdf->WriteHtml($content);
            return   $mpdf->Output($filename, 'I');
        }elseif($export=='xls'){
            
            header("Content-type: application/vnd.ms-excel");
            header('Content-Disposition: attachment; filename="' . $filename . '.xls"');
            return $content;
        }
    }
 public function actionAgenList($q = null, $id = null) {
   Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    $out = ['results' => ['id' => '', 'text' => '']];
    if (!is_null($q)) {
        $query =(new \yii\db\Query());
        $query->select(['id,concat(id_agen," - ",nama_agen) AS text'])
            ->from('data_Agen')
            ->where(['like', 'nama_agen', $q])
                ->orFilterWhere(['LIKE','id_agen',$q])
            ->limit(20);
        $command = $query->createCommand();
        $data = $command->queryAll();
        $out['results'] = array_values($data);
    }
    elseif ($id > 0) {
        $out['results'] = ['id' => $id, 'text' => City::find($id)->name];
    }
    return $out;
}
}
