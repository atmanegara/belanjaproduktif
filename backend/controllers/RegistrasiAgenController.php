<?php

namespace backend\controllers;

use Yii;
use backend\models\RegistrasiAgen;
use backend\models\RegistrasiAgenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\RefProsesPendaftaran;
use backend\models\DataAgen;
use yii\data\ActiveDataProvider;
use backend\models\DataAgenWaris;
use backend\models\BerkasAgen;
use common\models\User;
use backend\models\KonfirmasiPembayaran;
use backend\models\QueryModel;
use Pusher\Pusher;
use backend\models\BotModel;
use backend\models\DataAgenDetail;

/**
 * RegistrasiAgenController implements the CRUD actions for RegistrasiAgen model.
 */
class RegistrasiAgenController extends Controller {

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
     * Lists all RegistrasiAgen models.
     * @return mixed
     */
    public function actionIndex($id_ref_proses_pendaftaran = null) {
        $searchModel = new RegistrasiAgenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if ($id_ref_proses_pendaftaran) {
            $dataProvider->query->where(['id_ref_proses_pendaftaran' => $id_ref_proses_pendaftaran]);
        }
        //total all
        $countAll = RegistrasiAgen::find()->count();
        //total prosess
        $countProces = RegistrasiAgen::find()->where(['id_ref_proses_pendaftaran' => 1])->count();
        //total selesai
        $countSelesai = RegistrasiAgen::find()->where(['id_ref_proses_pendaftaran' => 2])->count();

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'countAll' => $countAll,
                    'countProces' => $countProces,
                    'countSelesai' => $countSelesai
        ]);
    }

    /**
     * Displays a single RegistrasiAgen model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
//     public function actionView($id)
//     {
//         return $this->renderAjax('view', [
//             'model' => $this->findModel($id),
//         ]);
//     }
    public function actionView($id) {
        //cek Data Registrasi
        $model = $this->findModel($id);
        //cek Data Pribadi
        //     $modelDataAgen
        return $this->renderAjax('view', [
                    'model' => $model,
        ]);
    }

    public function actionKirim($no_acak) {
        $persetujuan = \backend\models\Persetujuan::find()->one();
        $model = RegistrasiAgen::find()->where(['no_acak' => $no_acak])->one();


        if ($model->load(Yii::$app->request->post())) {
            $cekDataWaris = DataAgenWaris::find()->where(['no_acak' => $no_acak])->exists();
            $cekBerkas = BerkasAgen::find()->where(['no_acak' => $no_acak])->exists();
            $cekToko = \backend\models\DataToko::find()->where(['no_acak' => $no_acak])->exists();
            $role_id = Yii::$app->user->identity->role_id;
            if (in_array($role_id, ['2','6'])) {
                if (!$cekToko) {
                    Yii::$app->session->setFlash('danger', 'Harap Lengkapi semua persyaratan (Data Toko)');
                    return $this->redirect(Yii::$app->request->referrer);
                }
            }
            if (!$cekDataWaris) {
                Yii::$app->session->setFlash('danger', 'Harap Lengkapi semua persyaratan (Data Waris)');
                return $this->redirect(Yii::$app->request->referrer);
            }
            if (!$cekBerkas) {
                Yii::$app->session->setFlash('danger', 'Harap Lengkapi semua persyaratan (Data Berkas Persyaratan)');
                return $this->redirect(Yii::$app->request->referrer);
            }
            $model->save(false);
            Yii::$app->session->setFlash('success', 'Data sudah dikirim');
            $msg = '**[DATA PRIBADI]** Data Pribadi Anggota Baru sudah dikirim, No NIK : #' . $model->nik;
            $data['message'] = $msg;
            $app_id = '946345';
            $app_key = 'd9d09bafc66e41e27f56';
            $app_secret = 'fcd37921714e72c982b4';
            $options = array(
                'cluster' => 'mt1',
                'useTLS' => true
            );
            $pusher = new Pusher($app_key, $app_secret, $app_id);
            $pusher->trigger('test_channel', 'my_event', $data);
           BotModel::sendReply($msg);
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->renderAjax('kirim', [
                    'model' => $model,
                    'persetujuan' => $persetujuan
        ]);
    }

    /**
     * Creates a new RegistrasiAgen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_referen_agen = null) {
        $no_acak_agen = Yii::$app->user->identity->no_acak;
        $id_ref_agen = Yii::$app->user->identity->id_ref_agen;
        $dataAgen = DataAgen::find()->where(['no_acak' => $no_acak_agen])->one();
        $model = new RegistrasiAgen();
        //     $filter = ($id_ref_agen). ','.$id_ref_agen;
        $modelRefAgen = \backend\models\RefAgen::getDropdownlistOneAgen($id_ref_agen);
        if ($model->load(Yii::$app->request->post())) {
             
            $no_acak = \backend\models\QueryModel::noacak();
            $email = $no_acak . '@email.com';
            $no_reg = 'REG' . $no_acak;
            $model->no_acak = $no_acak;
            $model->no_reg = $no_reg;
            $model->tgl_registrasi = date('Y-m-d');
            $model->id_ref_proses_pendaftaran = 1;
            $model->id_referen_agen = $id_referen_agen;
              if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
 
               Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
 
               return \kartik\form\ActiveForm::validate($model);
           }
           
            if ($model->save()) {
                $modelAnggota = new \backend\models\DataAnggota();
                $modelAnggota->no_acak = $no_acak;
                $modelAnggota->no_acak_agen = $no_acak_agen;
                $modelAnggota->id_ref_agen = $model->id_ref_agen;
                $modelAnggota->nik = $model->nik;
                $modelAnggota->nama_agen = $model->nama;
                $modelAnggota->alamat = $model->alamat;
                $modelAnggota->nope = $model->nope;
                $modelAnggota->save(false);
                $modelDetailAgen = new \frontend\models\DataDetailAgen();
                $modelDetailAgen->no_acak = $no_acak;
                $modelDetailAgen->cara_daftar = 1;
                $modelDetailAgen->id_data_agen = $model->getPrimaryKey();
                $modelDetailAgen->id_referensi_agen = $dataAgen['id_agen'];
                $modelDetailAgen->tgl_gabung = $model->tgl_registrasi;
                $modelDetailAgen->no_acak_referensi = $dataAgen['no_acak'];
                $modelDetailAgen->save(false);

                //pembayaran
                $modelPembayaran = new KonfirmasiPembayaran();
                $modelPembayaran->no_invoice = QueryModel::noinvoice();
                $modelPembayaran->no_acak = $no_acak;
                $id_status_pembayaran = 3;
                $id_role = 0;
                $id_status_dp = 1;
                if (in_array($model->id_ref_agen, ['3', '4', '7'])) {
                    $id_status_pembayaran = 2;
                    $id_status_dp = 2;
                    $id_role = \backend\models\Role::findOne(['id_ref_agen' => $model->id_ref_agen])->id;
                }
                $modelPembayaran->id_status_pembayaran = $id_status_pembayaran;
                $modelPembayaran->id_status_dp = $id_status_dp;
                $modelPembayaran->save(false);
                //role
                $modelRole = \backend\models\Role::find()->where(['id_ref_agen' => $model->id_ref_agen])->one();
                $password = date('mdHs');
                $user = new User();
                $user->id_agen = $dataAgen['id_agen'];
                $user->no_acak = $no_acak;
                $user->role_id = $modelRole['id'];
                $user->id_ref_agen = $model->id_ref_agen;
                $user->username = $model->username;
                $user->email = $email;
                $user->status = User::STATUS_ACTIVE;
                $user->password_string = $password;
                $user->setPassword($password);
                $user->generateAuthKey();
                $user->generateEmailVerificationToken();
                $user->save();
       
               $sql = "insert into arsip_registrasi_agen select * from registrasi_agen where id=:id";
                $params=[
                    ':id'=>$model->id
                ];
                Yii::$app->db->createCommand($sql,$params)->execute();
                          //kirik keemail belanjaprodukti
                QueryModel::kirimEmail($no_acak);
                return $this->redirect(['view-reg', 'no_acak' => $model->no_acak]);
            } else {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return \kartik\form\ActiveForm::validate($model);
            }
        }

        return $this->renderAjax('_form', [
                    'model' => $model,
                    'modelRefAgen' => $modelRefAgen
        ]);
    }

    public function actionViewReg($no_acak) {
        //akun
        $dataUser = User::find()->where(['no_acak' => $no_acak])->one();
        $dataReg = RegistrasiAgen::find()->where(['no_acak' => $no_acak])->one();
        return $this->render('view-reg', [
                    'dataUser' => $dataUser,
                    'dataReg' => $dataReg
        ]);
    }

    public function actionViewDataAnggota($no_acak) {
        //akun
        $dataUser = User::find()->where(['no_acak' => $no_acak])->one();
        $dataReg = RegistrasiAgen::find()->where(['no_acak' => $no_acak])->one();
        return $this->render('view-data-anggota', [
                    'dataUser' => $dataUser,
                    'dataReg' => $dataReg
        ]);
    }

    /**
     * Updates an existing RegistrasiAgen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->renderAjax('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing RegistrasiAgen model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $modelReg = $this->findModel($id);
        KonfirmasiPembayaran::deleteAll(['no_acak' => $modelReg['no_acak']]);
        $this->findModel($id)->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the RegistrasiAgen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RegistrasiAgen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = RegistrasiAgen::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionVerifikasiData($no_acak) {
        $modelRefProsesPendaftaran = RefProsesPendaftaran::getdropdownlist();
        $model = RegistrasiAgen::findOne(['no_acak' => $no_acak]);
        $id_ref_agen = $model['id_ref_agen'];
        if ($model->load(Yii::$app->request->post())) {
            //    return var_dump($model->id_ref_proses_pendaftaran);
//           $programagen= \backend\models\RefProgramAgen::find()->where(new Expression('FIND_IN_SET(:id_ref_agen, id_ref_agen)'))->addParams([':id_ref_agen' => $id_ref_agen])->one();
     
            if ($model->save(false)) {
  $cekDataAnggota = \backend\models\DataAnggota::find()->where(['no_acak'=>$no_acak]);
       if($cekDataAnggota->exists()){
           $dataAnggota = $cekDataAnggota->one();
            $modelDataAgen = DataAgen::findOne(['no_acak'=>$no_acak]);
           $modelDataAgen->no_acak_ref = $dataAnggota['no_acak_agen'];
           $modelDataAgen->save(false);
       }
                Yii::$app->session->setFlash('success', 'Sukses verifikasi');
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        return $this->renderAjax('verifikasi-data', [
                    'model' => $model,
                    'modelRefProsesPendaftaran' => $modelRefProsesPendaftaran
        ]);
    }

    public function actionViewCalonAgen($no_acak) {
        $modelRegistrasi = RegistrasiAgen::findOne(['no_acak' => $no_acak]);
        $modelex = DataAgen::find()->where(['no_acak' => $no_acak]);
//        if(!$modelex->exists()){
//            return $this->redirect(['#data-agen/create','no_acak'=>$no_acak]);
//        }
        $model = $modelex->one();
        //opor ayam
        $modelAgenWaris = new ActiveDataProvider([
            'query' => DataAgenWaris::find()->where([
                'id_data_agen' => $model['id']
            ])
        ]);
         //datatoko
        $searchModel = new \backend\models\DataTokoSearch();
        $dataProviderToko = $searchModel->search(Yii::$app->request->queryParams);
   
            $dataProviderToko->query->where(['no_acak'=>$no_acak]);
            //data agen detail rekening
            $dataProviderRekening = new ActiveDataProvider([
                'query'=> DataAgenDetail::find()->where(['no_acak'=>$no_acak])
            ]);
        //berkas
        $modelBerkasAgen = new ActiveDataProvider([
            'query' => BerkasAgen::find()->where([
                'id_data_agen' => $model['id']
            ])
        ]);
        return $this->render('view-calon-agen', [
                    'model' => $model,
                    'modelBerkasAgen' => $modelBerkasAgen,
                    'modelAgenWaris' => $modelAgenWaris,
                    'id_data_agen' => $model['id'],
                    'no_acak' => $no_acak,
                    'modelRegistrasi' => $modelRegistrasi,
            'dataProviderToko'=>$dataProviderToko,
            'dataProviderRekening'=>$dataProviderRekening
        ]);
    }

}
