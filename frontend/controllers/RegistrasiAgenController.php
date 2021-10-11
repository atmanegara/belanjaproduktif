<?php

namespace frontend\controllers;

use Yii;
use frontend\models\RegistrasiAgen;
use frontend\models\RegistrasiAgenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\RefKelurahan;
use frontend\models\RefKecamatan;
use frontend\models\RefAgen;
use backend\models\QueryModel;
use frontend\models\SignupForm;
use common\models\User;
use backend\models\KonfirmasiPembayaran;
use frontend\models\DataDetailAgen;
use backend\models\Role;
use kartik\mpdf\Pdf;
/**
 * RegistrasiAgenController implements the CRUD actions for RegistrasiAgen model.
 */
class RegistrasiAgenController extends Controller
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
     * Lists all RegistrasiAgen models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RegistrasiAgenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RegistrasiAgen model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        
        $tentangkami = \backend\models\TentangKami::find()->one();
        $model=$this->findModel($id);
        $no_acak = $model['no_acak'];
//        
//          $email = Yii::$app->mailer->compose(['html' => 'layouts/text'])
//                        ->setTo('atma_1989@yahoo.com')
//                        ->setFrom([Yii::$app->params['adminEmail'] => 'Kemkes e-jafung'])
//                        ->setSubject('Activate Your Account')
//                        ->setTextBody('asd')
//                        ->send();
////                        
//        $model = new \frontend\models\ContactForm();
//        $model->body = 'adada';
//        $model->subject='jdudlnya';
//        $model->email='atma_1989@yahoo.com';
//        $model->name='asdasd';
//        $model->sendEmail('atma_1989@yahoo.com');

        return $this->render('view', [
            'model' => $model,
            'modelTentangKami'=>$tentangkami
        ]);
    }
 public function actionPrintView($id){
     
   $modelFotoProfil = \backend\models\FotoProfil::find()->one();
        $modelTentangKami = \backend\models\TentangKami::find()->one();
    // get your HTML raw content without any layouts or scripts
    $content = $this->renderPartial('print-view', [
            'model' => $this->findModel($id),
        'modelTentangKami'=>$modelTentangKami,
        'modelFotoProfil'=>$modelFotoProfil
        ]);  
    $pdf = Yii::$app->pdf;
$mpdf = $pdf->api; // fetches mpdf api
$mpdf->SetHeader('Belanja Produktif'); // call methods or set any properties
$mpdf->WriteHtml($content); // call mpdf write html
echo $mpdf->Output('filename', 'I');
    // setup kartik\mpdf\Pdf component
//    $pdf = new Pdf([
//        // set to use core fonts only
//        'mode' => Pdf::MODE, 
//        // A4 paper format
//        'format' => Pdf::FORMAT_A4, 
//        // portrait orientation
//        'orientation' => Pdf::ORIENT_PORTRAIT, 
//        // stream to browser inline
//        'destination' => Pdf::DEST_BROWSER, 
//        // your html content input
//        'content' => $content,  
//        // format content from your own css file if needed or use the
//        // enhanced bootstrap css built by Krajee for mPDF formatting 
//        'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
//        // any css to be embedded if required
//        'cssInline' => '.kv-heading-1{font-size:18px}', 
//         // set mPDF properties on the fly
//        'options' => ['title' => 'Krajee Report Title'],
//         // call mPDF methods on the fly
//        'methods' => [ 
//            'SetHeader'=>['Krajee Report Header'], 
//            'SetFooter'=>['{PAGENO}'],
//        ]
//    ]);
//    
//    // return the pdf output as per the destination setting
//    return $pdf->render(); 

  
    }
    /**
     * Creates a new RegistrasiAgen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RegistrasiAgen();
        $modelKabupaten = \backend\models\Kabupaten::dropdownlist();
      
        $modelKecamatan = \backend\models\Kecamatan::getKecatamanDropdownAll();
        $modelKelurahan = \backend\models\Kelurahan::getDropdownkelurahanAll();
        $modelRefAgen = RefAgen::getDropdownAgenReg();
        if ($model->load(Yii::$app->request->post())) {
//        if($model->id_ref_agen=='1'){
          $id_referensi_agen ='#'  ;
//             
//        }else{
//             $id_referensi_agen ='#'  ;
//        }
        $model->id_referensi_agen=$id_referensi_agen;
            $no_acak=QueryModel::noacak();
            $model->email=$no_acak.'@belanjaproduktif.com';
            
            $model->no_acak=$no_acak;
            $model->no_reg='REG'.$no_acak;
            $model->id_ref_proses_pendaftaran=1;
            $model->tgl_registrasi=date('Y-m-d');
             $dataAgenEx= \backend\models\DataAgen::find()->where(['id_agen'=>$id_referensi_agen]);
            if($dataAgenEx->exists()){
                $dataAgenEx = $dataAgenEx->one();
                if($model->id_referensi_agen=='#'){
                    //lanjutkan mark # adalah ID refernnya BElanja produktif
                }elseif($model->id_referensi_agen<> $dataAgenEx['id_agen']){
    Yii::$app->session->setFlash('danger','ID Referensi tidak sesuai, cek kembali');
    return $this->redirect(Yii::$app->request->referrer);
                }
                 $no_acakref = $dataAgenEx['no_acak'];
            }else{
                $no_acakref = $id_referensi_agen;
            }
                    if($model->save()){
                $modelDetailAgen = new DataDetailAgen();
                $modelDetailAgen->no_acak=$no_acak;
                $modelDetailAgen->cara_daftar=$model->cara_daftar;
                $modelDetailAgen->id_data_agen=$model->getPrimaryKey();
                    $modelDetailAgen->id_referensi_agen = $model->id_referensi_agen;
                    $modelDetailAgen->tgl_gabung = $model->tgl_registrasi;
                    $modelDetailAgen->no_acak_referensi=$no_acakref;
                    $modelDetailAgen->save(false);
                  $modelPembayaran = new KonfirmasiPembayaran();
                  $modelPembayaran->no_invoice=QueryModel::noinvoice();
                  $modelPembayaran->no_acak=$no_acak;
                  $id_status_pembayaran=3;
               //   $id_role=0;
                  $id_status_dp=1;
                  if(in_array($model->id_ref_agen, ['3','4','7'])){
                      $id_status_pembayaran=2;
                      $id_status_dp=2;
                       
                  }
                          $id_role = Role::findOne(['id_ref_agen'=>$model->id_ref_agen])->id;
             
                  $modelPembayaran->id_status_pembayaran=$id_status_pembayaran;
                  $modelPembayaran->id_status_dp=$id_status_dp;
                  $modelPembayaran->save(false);
                  $username = $model->username;
                $user = new User();
                $user->id_agen = $model->id_referensi_agen;
                $user->no_acak=$no_acak;
                $user->role_id = $id_role;
                $user->id_ref_agen = $model->id_ref_agen;
                $user->username = $username;
                $user->email = $model->email;
                $user->status = User::STATUS_ACTIVE;
                $user->password_string=$model->password;
                $user->setPassword($model->password);
                $user->generateAuthKey();
                $user->generateEmailVerificationToken();
             $user->save();
        QueryModel::kirimEmail($no_acak);
           $sql = "insert into arsip_registrasi_agen select * from registrasi_agen where no_acak=:no_acak";
           $params=[
               ':no_acak'=>$no_acak
           ];
           Yii::$app->db->createCommand($sql, $params)->execute();
            return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelKabupaten'=>$modelKabupaten,
'modelKelurahan'=>$modelKelurahan,
           'modelKecamatan'=>$modelKecamatan,
            'modelRefAgen'=>$modelRefAgen
        ]);
    }

    /**
     * Updates an existing RegistrasiAgen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $modelRefKelurahan = RefKelurahan::getDropdownkelurahan();
        $modelRefKecamatan = RefKecamatan::getDropdownkecamatan();
        $modelRefAgen = RefAgen::getDropdownAgen();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
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
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RegistrasiAgen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RegistrasiAgen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RegistrasiAgen::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    
    public function actionDataAgen($id_ref_agen){
        switch ($id_ref_agen){
            case '1':
                $id_ref_agen=0;
                break;
            case '2':
                $id_ref_agen=1;
                break;
            case '3':
                $id_ref_agen=2;
                break;
            case '4':
                $id_ref_agen=3;
                break;
            
        }
            $html = '<option value=0>Pilih Salah Satu....</option> ';
            
            if($id_ref_agen=='0'){
                 $html .= "<option value=$id_ref_agen>Belanja Produktif</option>";
          return $html;
      }
      if($id_ref_agen==1){
        $array = (new \yii\db\Query())
                ->select('a.no_acak,a.id_agen,a.nama_agen,a.alamat,b.alamat as alamat_toko,b.nama_toko')
->from('data_agen a')
->innerJoin('data_toko b','a.id=b.id_data_agen')->where(['a.id_ref_agen'=>$id_ref_agen])->all();//
      }else{
          $array =\backend\models\DataAgen::find()->where(['id_ref_agen'=>$id_ref_agen])->all();
      }
  //    $alamat_toko='';
       foreach($array as $value){
            $id = $value['id'];
            $no_acak = $value['no_acak'];
            $id_agen =(string) $value['id_agen'];
            $nama_agen = $value['nama_agen'];
            $alamat = $value['alamat'];
            if($id_ref_agen==1){
                $alamat = $value['alamat_toko'];
            }
//            
            $template ='<div class="row">' .
    '<div class="col-sm-5"> <b style="margin-left:5px">'.$id_agen . '</b>' . 
    '</div>' .
    '<div class="col-sm-3"><i class="fa fa-code-fork"></i> ' . $nama_agen . '</div>' .
    '<div class="col-sm-3"><i class="fa fa-star"></i> ' . $alamat . '</div>' .
'</div>';
          $html .= "<option value=$id_agen>".$nama_agen ."</option>";
       }
        return $html;
    }
   
}
?>

