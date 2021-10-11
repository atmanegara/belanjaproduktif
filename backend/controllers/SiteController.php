<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\KonfirmasiPembayaran;
use backend\models\RefAgen;
use backend\models\Franchice;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'request-password-reset'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'home', 'print-invoice', 'data-agen-exists'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
//    public function actionIndex() {
//        return $this->render('index');
//    }

    public function actionIndex() {
        $model = [];
        $role_id = Yii::$app->user->identity->role_id;
        $id_ref_agen = Yii::$app->user->identity->id_ref_agen;
        $no_acak = Yii::$app->user->identity->no_acak;
        $tentangkami = \backend\models\TentangKami::find()->one();
        $model = RefAgen::find()->where(['id' => $id_ref_agen])->one();
        if (in_array($role_id, ['2', '3', '4', '6'])) {
            $cekKonfirmasiPembayaran = KonfirmasiPembayaran::find()->where(['no_acak' => $no_acak]);
            if (!$cekKonfirmasiPembayaran->exists()) {
                $cekAgenReg = \backend\models\RegistrasiAgen::find()->where(['no_acak' => $no_acak]);
                if ($cekAgenReg->exists()) {
                    $cekAgenReg = $cekAgenReg->one();
                    $franchice = Franchice::find()->where(['id_ref_agen' => $regAgenModel['id_ref_agen']])->one();
                    $no_invoice = \backend\models\QueryModel::noinvoice();
                    return $this->render('home-konfirmasi', [
                                'no_acak' => $no_acak,
                                'no_invoice' => $no_invoice,
                                'franchice' => $franchice,
                        'cekAgenReg'=>$cekAgenReg,
                        'tentangkami'=>$tentangkami
                    ]);
                } else {
                    return $this->redirect(Yii::getAlias('@admin_frontend').'/web/registrasi-agen/create');
                }
            }

            $konfirmasiPembayaranExits = KonfirmasiPembayaran::find()->where(['no_acak' => $no_acak, 'id_status_pembayaran' => '3']);
            
            if ($konfirmasiPembayaranExits->exists()) {
               $cekAgenReg = \backend\models\RegistrasiAgen::find()->where(['no_acak' => $no_acak])->one();
                 $franchice = Franchice::find()->where(['id_ref_agen' => $id_ref_agen]);
                if ($franchice->exists()) {
                    $franchice = $franchice->one();
                    $modelKonfirmasiPembayaran = $konfirmasiPembayaranExits->one();
                    $no_invoice = $modelKonfirmasiPembayaran['no_invoice'];
                    return $this->render('home-konfirmasi', [
                                'no_acak' => $no_acak,
                                'no_invoice' => $no_invoice,
                        'cekAgenReg'=>$cekAgenReg,
                                'franchice' => $franchice,
                        'tentangkami'=>$tentangkami
                    ]);
                }
            }
        }
        
        //cek cicilan
        if (in_array($role_id, ['2', '3', '4','5','6'])) {

            $expembayaran = KonfirmasiPembayaran::find()->where(['no_acak' => $no_acak]);
            if ($expembayaran->exists()) {
                $status_dp = $expembayaran->all();
                foreach ($status_dp as $val) {
                    $id_status_dp = $val['id_status_dp'];
                    if ($id_status_dp == '2') {
                        $id_status_dp = '2';
                    }
                }
 if (in_array($role_id, ['4','5','6'])) { //bila daftarnya kada babayaran, dianggap lunas haja
                    $id_status_dp = '2';
                }
               
            }
            
            $jumanggotaAgen = \backend\models\DataAnggota::jumAnggota($no_acak);
            $progressprogram = \backend\models\QueryModel::geProgressPersenProgram($no_acak);
            $url = $model['url'];
            $dataAgen = \backend\models\DataAgen::find()->where(['no_acak'=>$no_acak])->exists();
        } else {
            $modelRegAgen = \backend\models\RegistrasiAgen::find(['no_acak' => $no_acak]);
            //jumlah anggota 
            $jumanggota = \backend\models\DataAgen::jumAnggotaFix();
            $jumanggotanon = \backend\models\DataAgen::jumAnggotaNoFix();
            $pendapatan = \backend\models\DataKomisi::sumAllKomisi($no_acak);
            $bykProgramAgen = \backend\models\ProgramAgen::bykProgramAgen();
            $url = 'home';
            return $this->render($url, [
                        'id_ref_agen' => $id_ref_agen,
                        'model' => $model,
                        'jumanggota' => $jumanggota,
                        'jumanggotanon' => $jumanggotanon,
                        'pendapatan' => $pendapatan,
                        'bykProgramAgen' => $bykProgramAgen,
                        'modelRegAgen' => $modelRegAgen
            ]);
        }
//        if (in_array($role_id, ['5'])) {
//            $url = 'hak-akses';
//        }

        return $this->render($url, [
                'jumanggotaAgen'=>$jumanggotaAgen,
                    'id_ref_agen' => $id_ref_agen,
                    'model' => $model,
                    'progressprogram' => $progressprogram,
                    'id_status_dp' => $id_status_dp,
            'dataAgen'=>$dataAgen
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin() {

        $this->layout = "main-login";
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $role_id = Yii::$app->user->identity->role_id;
            if (in_array($role_id, ['5'])) {
                $no_acak = Yii::$app->user->identity->no_acak;
                $modelDataAnggota = \backend\models\DataAnggota::find()->where(['no_acak'=>$no_acak])->exists();
                if($modelDataAnggota){
            return $this->goBack();
                    
                }else{
                return $this->redirect(Yii::getAlias('@admin_frontend/web'));
                }
            }

            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset() {
        $this->layout = "main-login";
        $model = new \frontend\models\PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token) {
        try {
            $model = new \frontend\models\ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

    public function actionPrintInvoice() {
        $id_ref_agen = Yii::$app->user->identity->id_ref_agen;

        $franchice = Franchice::find()->where(['id_ref_agen' => $id_ref_agen])->one();
        $content = $this->renderPartial('view-invoice', [
            'franchice' => $franchice
        ]);

        $pdf = Yii::$app->pdf; // or new Pdf();
        $mpdf = $pdf->api; // fetches mpdf api
        $mpdf->SetHeader('Kartik Header'); // call methods or set any properties
        $mpdf->WriteHtml($content); // call mpdf write html
        echo $mpdf->Output('filename', 'I'); // call the mpdf api output as needed
    }

    public function actionDataAgenExists() {
        return $this->render('data-agen-exists');
    }

}
