<?php

namespace backend\controllers;

use Yii;
use backend\models\KonfirmasiPembayaran;
use backend\models\KonfirmasiPembayaranSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\RefBank;
use yii\web\UploadedFile;
use yii\web\Response;
use yii\bootstrap\ActiveForm;
use backend\models\StatusPembayaran;
use backend\models\RegistrasiAgen;
use backend\models\ArsipRegistrasiAgen;
use backend\models\Role;
use common\models\User;
use backend\models\AturBagiHasilFranchise;
use frontend\models\DataDetailAgen;
use backend\models\DataAgen;
use backend\models\DataKomisi;
use backend\models\TransaksiKomisi;
use backend\models\QueryModel;
use backend\models\Franchice;

/**
 * KonfirmasiPembayaranController implements the CRUD actions for KonfirmasiPembayaran model.
 */
class KonfirmasiPembayaranController extends Controller {

    /**
     *
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => [
                        'POST'
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all KonfirmasiPembayaran models.
     *
     * @return mixed
     */
    public function actionIndex($id_status_pembayaran = null) {
        $modelStatusPembayaran = StatusPembayaran::Dropdownlist();
        $searchModel = new KonfirmasiPembayaranSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if ($id_status_pembayaran) {
            $dataProvider->query->where(['id_status_pembayaran' => $id_status_pembayaran]);
        }
        //total All;
        $countAll = KonfirmasiPembayaran::find()->count();
        //total Menunggu
        $countAll3 = KonfirmasiPembayaran::find()->where(['id_status_pembayaran' => 3])->count();
        //total bayar belum verifikasi
        $countAll1 = KonfirmasiPembayaran::find()->where(['id_status_pembayaran' => 1])->count();
        //total bayar belum verifikasi
        $countAll2 = KonfirmasiPembayaran::find()->where(['id_status_pembayaran' => 2])->count();

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider, 'modelStatusPembayaran' => $modelStatusPembayaran,
                    'countAll' => $countAll, 'countAll1' => $countAll1, 'countAll2' => $countAll2, 'countAll3' => $countAll3
        ]);
    }

    /**
     * Displays a single KonfirmasiPembayaran model.
     *
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $model = $this->findModel($id);
        $no_invoice = $model->no_invoice;
        $modelStatusPembayaran = StatusPembayaran::Dropdownlist();
        $no_acak = $model['no_acak'];
        $modelRegistrasiAgen = RegistrasiAgen::find()->where([
                    'no_acak' => $no_acak
                ])->one();
        $modelRole = Role::dropdownRole();
        $modelRefStatusDp = \backend\models\StatusDp::dropdownlist();
        if ($model->load(Yii::$app->request->post())) {
            if (!$model->nominal) {
                //               return var_dump($model->getErrors());
                Yii::$app->session->setFlash('danger', 'No Registrasi : , belum melakukan pembayaran');
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                if ($model->id_status_pembayaran == '2') {
                    $id_ref_agen = $modelRegistrasiAgen['id_ref_agen'];
                    $modelRole = Role::find()->where(['id_ref_agen' => $id_ref_agen])->one();
                    $model->role_id = $modelRole['id'];
                    $model->id_metode_transfer = 2;
                    $modelPendapatanReg = new \backend\models\PendapatanRegistrasi();
                    $modelPendapatanReg->id_ref_agen = $id_ref_agen; //$modelRegistrasiAgen['id_ref_agen'];
                    $modelPendapatanReg->nominal = $model['nominal'];
                    $modelPendapatanReg->tgl_masuk = date('Y-m-d');
                    $modelPendapatanReg->save(false);

                    $dataRegistrasi = RegistrasiAgen::find()->where(['no_acak' => $no_acak])->one();
                    //id agen atas
//                    $detailAgen = DataAgen::find()->innerJoin('data_detail_agen', 'data_agen.id_agen=data_detail_agen.id_referensi_agen')
//                            ->where([
//                                'data_detail_agen.no_acak' => $no_acak
//                            ]);
                    $dataAnggota = [];
                    if ($dataRegistrasi['id_referen_agen'] != '#') {
                        $id_referen_agen = $dataRegistrasi['id_referen_agen'];
                        $modelAgen = DataAgen::find()->where(['id_agen' => $id_referen_agen])->one();
                        $id_ref_agen = $modelAgen['id_ref_agen']; // id_ref_agen_penerima
                        $id_data_agen = '#';
                        $no_acak_pemberi = $dataRegistrasi['no_acak'];
                        $no_acak_penerima = $modelAgen['no_acak'];

                        //dibagi ke tukang rekrut
                        $dataAnggota[] = [
                            'id_data_agen' => $id_data_agen,
                            'no_acak_penerima' => $no_acak_penerima,
                            'no_acak_pemberi' => $no_acak_pemberi,
                            'id_ref_agen' => $id_ref_agen
                        ];
                        //bagi lg ke BP
                        $dataAnggota[] = [
                            'id_data_agen' => Yii::$app->user->identity->id_agen,
                            'no_acak_penerima' => Yii::$app->user->identity->no_acak,
                            'no_acak_pemberi' => $no_acak_pemberi,
                            'id_ref_agen' => $id_ref_agen
                        ];
                    } else {
                        $id_ref_agen = Yii::$app->user->identity->id_ref_agen;
                        $no_acak_pemberi = $dataRegistrasi['no_acak'];
                        $no_acak_penerima = Yii::$app->user->identity->no_acak;
                        $id_data_agen = Yii::$app->user->identity->id_agen;

                        //bagi ke BP
                        $dataAnggota[] = [
                            'id_data_agen' => Yii::$app->user->identity->id_agen,
                            'no_acak_penerima' => Yii::$app->user->identity->no_acak,
                            'no_acak_pemberi' => $no_acak_pemberi,
                            'id_ref_agen' => 5
                        ];
                    }

                    // cek id refernsi agen
                    // $cekDetailAgen = DetailAgen::find()->where(['no_acak'=>$no_acak])->one();


                    $ket = 1;
                    $selesai = false;
                    //     return var_dump($dataAnggota);
                    foreach ($dataAnggota as $valAnggota) {
                        $id_data_agen = $valAnggota['id_data_agen'];
                        $no_acak_penerima = $valAnggota['no_acak_penerima'];
                        $no_acak_pemberi = $valAnggota['no_acak_pemberi'];
                        $id_ref_agen = $valAnggota['id_ref_agen'];
                        $nilai_franchice = AturBagiHasilFranchise::find()->where([
                                    'id_ref_agen' => $id_ref_agen
                                ])->one();
                        $bagi_hasil = $model['nominal'] * ($nilai_franchice['nilai'] / 100); // nilai franchice dalam persen decimal
                        
                        if (QueryModel::insertKomisi($id_data_agen, $no_acak_penerima, $no_acak_pemberi, $model['nominal'], $nilai_franchice['nilai'] / 100, $bagi_hasil, $ket)) {
                            $selesai = true;
                        }
                    }
                    if ($selesai) {
                        
                    } else {
                        Yii::$app->session->setFlash('danger', 'Gagal Konfirmasi');
                        return $this->redirect(Yii::$app->request->referrer);
                    }

                    //jika cicil
                    if ($model->id_status_dp == '1') {
                        $franchice = Franchice::find()->where(['id_ref_agen' => $modelRegistrasiAgen['id_ref_agen']])->one();
                        $modelDp = new \backend\models\DpPembayaran();
                        $modelDp->no_acak = $no_acak;
                        $modelDp->no_invoice = $no_invoice;
                        $modelDp->id_franchice = $franchice['id'];
                        $modelDp->id_status_dp = 1;
                        $modelDp->tahap_dp = 1;
                        $modelDp->nominal = $franchice['total'];
                        $modelDp->uang_muka = $model['nominal'];
                        $modelDp->sisa = $franchice['total'] - $model['nominal'];
                        $modelDp->save(false);
                    }
                    $modelUser = User::find()->where([
                                'no_acak' => $no_acak
                            ])->one();
                    $modelUser->role_id = $model->role_id;
                    $modelUser->save(false);
                    $model->save(false);
                    $id_konfirmasi_pembayaran = $model->getPrimaryKey();
                    $sql = "REPLACE INTO data_pembayaran SELECT * FROM konfirmasi_pembayaran where id=:id";
                    $params = [
                        ':id' => $id_konfirmasi_pembayaran
                    ];
                    Yii::$app->db->createCommand($sql, $params)->execute();
                    Yii::$app->session->setFlash('success', 'Konfirmasi berhasil');
                    return $this->redirect(Yii::$app->request->referrer);
                }
            }
        }
        return $this->render('view', [
                    'model' => $model,
                    'modelStatusPembayaran' => $modelStatusPembayaran,
                    'modelRegistrasiAgen' => $modelRegistrasiAgen,
                    'modelRole' => $modelRole,
                    'modelRefStatusDp' => $modelRefStatusDp
        ]);
    }

    /**
     * Creates a new KonfirmasiPembayaran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate() {
        $model = new KonfirmasiPembayaran();
        $modelRefBank = RefBank::getDropdownbank();
        $model->no_acak = $no_acak;
        if ($model->load(Yii::$app->request->post())) {

            $model->id_status_pembayaran = 1;
            if ($model->save())
                ;
            return $this->redirect([
                        'view',
                        'id' => $model->id
            ]);
        }

        return $this->renderAjax('_form', [
                    'model' => $model,
                    'modelRefBank' => $modelRefBank
        ]);
    }

    /**
     * Updates an existing KonfirmasiPembayaran model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        
            $id_status_pembayaran=1;
            if(!$model->nominal){
            $id_status_pembayaran=3;
        }
       $model->id_status_pembayaran=$id_status_pembayaran;
             $model->save(false);
             TransaksiKomisi::deleteAll(['no_acak_pemberi' => $model['no_acak']]);
             DataKomisi::deleteAll(['no_acak' => $model['no_acak']]);
 
        return $this->redirect(Yii::$app->request->referrer);

      
    }

    public function actionKonfirmasi($no_acak, $no_invoice) {
        
        $modelex = KonfirmasiPembayaran::find()->where([
            'no_acak' => $no_acak
        ]);
        if ($modelex->exists()) {
            $model = $modelex->one();
        } else {
            $model = new KonfirmasiPembayaran();
            $model->no_invoice = $no_invoice;
        }
        $modelRefBank = RefBank::getDropdownbank();
        $dataReg = RegistrasiAgen::findOne(['no_acak' => $no_acak]);
        $model->no_acak = $no_acak;
        if ($model->load(Yii::$app->request->post())) {
            $model->id_user = Yii::$app->user->identity->id;
            
            Yii::$app->response->format = Response::FORMAT_JSON;
            $no_invoice = $model->no_invoice;
            $model->id_status_pembayaran = 1; //
            $model->tgl_transfer = date('Y-m-d', strtotime($model->tgl_transfer));
            $model->role_id = 0;
            $model->filebukti = UploadedFile::getInstance($model, 'filebukti');

            if ($model->upload()) {

                if ($model->save(false)) {
                    $msg = "**[PEMBAYARAN PENDAFTARAN]** Pembayaran Pendaftaran Agen Sudah diTransafer ke Admin dengan No Invoice :" . $no_invoice . ','
                            . ' No Reg :' . $dataReg['no_reg'] . ', NIK / Nama : ' . $dataReg['nik'] . ' / ' . $dataReg['nama'] . 'Terdaftar Sebagai Agen : **' . strtoupper(\backend\models\RefAgen::findOne($dataReg['id_ref_agen'])->nama_agen) . '**';
                    Yii::$app->session->setFlash('success', 'Terima kasih, anda berhasil melakukan pembayaran dengan No Invoice ' . $no_invoice);
                    \backend\models\BotModel::sendReply($msg);
                    return $this->redirect(['view-konfirmasi', 'no_invoice' => $no_invoice]);
                }
            } else {
                return ActiveForm::validate($model);
            }
        }
        return $this->renderAjax('_form', [
                    'model' => $model,
                    'modelRefBank' => $modelRefBank
        ]);
    }

    public function actionKonfirmasiDp($no_acak) {
        $model = new KonfirmasiPembayaran();
//        $model = KonfirmasiPembayaran::findOne([
//            'no_acak' => $no_acak
//        ]);
        $model->no_acak = $no_acak;
        $model->no_invoice = (string) QueryModel::noinvoice();
        $modelRefBank = RefBank::getDropdownbank();
        $modelDp = \backend\models\DpPembayaran::find()->where(['no_acak' => $no_acak]);
        if ($modelDp->exists()) {
            $modelDp = $modelDp->one();
            $model->nominal_sisa = $modelDp['sisa'];
        }
        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $no_invoice = $model->no_invoice;
            $model->id_status_pembayaran = 1; //
            $model->id_status_dp = 1; //
            $model->tgl_transfer = date('Y-m-d', strtotime($model->tgl_transfer));
            $model->role_id = 0;
            $model->filebukti = UploadedFile::getInstance($model, 'filebukti');

            if ($model->upload()) {

                if ($model->save(false)) {
                    $modelDpnew = new \backend\models\DpPembayaran();
                    $modelDpnew->isNewRecord = true;
                    $modelDpnew->no_acak = $no_acak;
                    $modelDpnew->no_invoice = $model->no_invoice;
                    $modelDpnew->id_franchice = $modelDp['id_franchice'];
                    $modelDpnew->id_status_dp = 1;
                    $modelDpnew->tahap_dp = $modelDp['tahap_dp'] + 1;
                    $modelDpnew->nominal = $modelDp['nominal'];
                    $modelDpnew->uang_muka = $model->nominal;
                    $modelDpnew->sisa = $modelDp['sisa'] - $model->nominal;
                    $modelDpnew->save(false);

                    $id_konfirmasi_pembayaran = $model->getPrimaryKey();
                    $sql = "INSERT INTO data_pembayaran SELECT * FROM konfirmasi_pembayaran where id=:id";
                    $params = [
                        ':id' => $id_konfirmasi_pembayaran
                    ];
                    Yii::$app->db->createCommand($sql, $params)->execute();

                    Yii::$app->session->setFlash('success', 'Terima kasih, anda berhasil melakukan pembayaran dengan No Invoice ' . $no_invoice);
                    return $this->redirect(['view-konfirmasi', 'no_invoice' => $no_invoice]);
                }
            } else {
                return ActiveForm::validate($model);
            }
        }
        return $this->renderAjax('_form_dp', [
                    'model' => $model,
                    'modelRefBank' => $modelRefBank
        ]);
    }

    /**
     * Deletes an existing KonfirmasiPembayaran model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewKonfirmasi($no_invoice) {
        $model = KonfirmasiPembayaran::find()->where([
                    'no_invoice' => $no_invoice
                ])->one();
        return $this->render('view-konfirmasi', [
                    'model' => $model
        ]);
    }
  public function actionViewInvoice() {
      $no_acak = Yii::$app->user->identity->no_acak;
        $model = KonfirmasiPembayaran::find()->where([
                    'no_acak' => $no_acak
                ])->one();
        return $this->render('view-invoice', [
                    'model' => $model
        ]);
    }
    public function actionDelete($id) {

        $model = $this->findModel($id);
        
  TransaksiKomisi::deleteAll(['no_acak_pemberi' => $model['no_acak']]);
             DataKomisi::deleteAll(['no_acak' => $model['no_acak']]);
             $model->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the KonfirmasiPembayaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     * @return KonfirmasiPembayaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = KonfirmasiPembayaran::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

//print invoice

    public function actionPreviewInvoice($id) {
        $query = KonfirmasiPembayaran::find()->where(['id' => $id])->one();
        $no_acak = $query['no_acak'];
        $modelTentangKami = \backend\models\TentangKami::find()->one();
        $modelFotoProfil = \backend\models\FotoProfil::find()->one();
        
        $dataAgen = RegistrasiAgen::find()->where(['no_acak' => $query['no_acak']])->one();
        $namaAgen = $dataAgen['nama'];
        $dataPribadi = DataAgen::find()->where(['no_acak'=>$no_acak]);
        if($dataPribadi->exists()){
            $dataAgenPribadi = $dataPribadi->one();
            $namaAgen = $dataAgenPribadi['nama_agen'];
        }
        //Tanda Tangan
        $modelTandaTangan = \backend\models\RefTtd::find()->where(['id_laporan'=>'1'])->one();
        return $this->render('preview-invoice', [
                    'query' => $query,
                    'no_acak' => $no_acak,
                    'modelTentangKami' => $modelTentangKami,
                    'modelFotoProfil' => $modelFotoProfil,
                    'dataAgen' => $dataAgen,
            'modelTandaTangan'=>$modelTandaTangan,
            'id'=>$id,
            'namaAgen'=>$namaAgen
        ]);
    }

    public function actionPrintInvoice($id) {
        $query = KonfirmasiPembayaran::find()->where(['id' => $id])->one();
        $no_acak = $query['no_acak'];
        $modelTentangKami = \backend\models\TentangKami::find()->one();
        $modelFotoProfil = \backend\models\FotoProfil::find()->one();
        $dataAgen = RegistrasiAgen::find()->where(['no_acak' => $query['no_acak']])->one();
       $namaAgen = $dataAgen['nama'];
        $dataPribadi = DataAgen::find()->where(['no_acak'=>$no_acak]);
        if($dataPribadi->exists()){
            $dataAgenPribadi = $dataPribadi->one();
            $namaAgen = $dataAgenPribadi['nama_agen'];
        }
        //Tanda Tangan
        $modelTandaTangan = \backend\models\RefTtd::find()->where(['id_laporan'=>'1'])->one();

        $filename = $no_acak . '.pdf';
        $content = $this->renderPartial('print-invoice', [
            'query' => $query,
            'no_acak' => $no_acak,
            'modelTentangKami' => $modelTentangKami,
            'modelFotoProfil' => $modelFotoProfil,
            'dataAgen' => $dataAgen,
            'modelTandaTangan'=>$modelTandaTangan,
            'namaAgen'=>$namaAgen
        ]);


        $pdf = new \kartik\mpdf\Pdf();
        $mpdf = $pdf->api;
        $mpdf->WriteHtml($content);
        return $mpdf->Output($filename, 'I');
    }

}
