<?php

namespace backend\controllers;

use Yii;
use backend\models\TutupBuku;
use backend\models\TutupBukuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\RefPosting;

/**
 * TutupBukuController implements the CRUD actions for TutupBuku model.
 */
class TutupBukuController extends Controller {

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
     * Lists all TutupBuku models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TutupBukuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexAgen() {

        $no_acak = Yii::$app->user->identity->no_acak;
        $searchModel = new TutupBukuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['no_acak_user' => $no_acak]);

        return $this->render('index-agen', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TutupBuku model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TutupBuku model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $modelRefPosting = RefPosting::dropDownListPosting();
        $model = new TutupBuku();
          $model->scenario = 'create';
        $bulan = \common\component\SettingComponent::listBulan();
$model->no_acak_user=Yii::$app->user->identity->no_acak;

       if ( $model->load(Yii::$app->request->post()))

    {


      if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))

      {

         Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

         return \yii\widgets\ActiveForm::validate($model);

      }
            $no_acak_agen = Yii::$app->user->identity->no_acak;
            $dataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak_agen])->one();
            $id_data_agen = $dataAgen['id'];
            $dataToko = \backend\models\DataToko::find()->where(['id_data_agen'=>$id_data_agen])->one();
            //    Yii::$app->session->setFlash('danger', 'Bulan dan Tahun transaksi sudah dilaporkan');
            //     $model->validate('bulan_posting');

            $tgl_lapor = $model->tgl_lapor;
            $tgl_lapor_akhir = $model->tgl_lapor_akhir;
$tgl_arsip = date('Y-m-d');
            $no_acak = \backend\models\QueryModel::noacak();
            $bulan = date('m', strtotime($tgl_lapor));
            $tahun = date('Y', strtotime($tgl_lapor));
            $model->bulan_posting = $bulan;
            $model->tahun_posting = $tahun;

            $model->verifikasi = 0;
            $model->no_acak = $no_acak;
            $model->no_acak_user = $no_acak_agen;
            if ($model->save()) {
                
                //insert arsip_data_barang
                $sql = "insert into arsip_data_barang select :no_acak as no_acak,:bulan,:tahun,a.* from data_barang a where a.id_data_agen=:id_data_agen";
                $params = [
                    ':no_acak' => $no_acak,
                    ':bulan' => $bulan,
                    ':tahun' => $tahun,
                    ':id_data_agen' => $id_data_agen
                ];
                Yii::$app->db->createCommand($sql, $params)->execute();
                //insert arsip_transaksi_barang
                $sql = "insert into arsip_transaksi_barang "
                        . "select :no_acak as no_acak,:bulan,:tahun,b.* from transaksi_barang b "
                        . "left join data_barang c on b.id_data_barang=c.id and c.id_data_agen=:id_data_agen "
                        . "left join data_agen d on c.id_data_agen=d.id "
                        . "where b.tgl_transaksi between :tgl_lapor and :tgl_lapor_akhir and c.id_data_agen=:id_data_agen";
                $params = [
                    ':no_acak' => $no_acak,
                    ':bulan' => $bulan,
                    ':tahun' => $tahun,
                    ':tgl_lapor' => $tgl_lapor,
                    ':tgl_lapor_akhir' => $tgl_lapor_akhir,
                    ':id_data_agen' => $id_data_agen
                ];
                Yii::$app->db->createCommand($sql, $params)->execute();
                //insert arsip_stok_barang
                $sql = "insert into arsip_stok_barang select :no_acak as no_acak,:bulan,:tahun,c.* from stok_barang c "
                        . "inner join data_barang d on d.id=c.id_data_barang and d.id_data_agen=:id_data_agen "
                        . "inner join data_agen e on d.id_data_agen=e.id and c.id_data_agen=e.id "
                        . "where e.id=:id_data_agen and c.id_data_agen=:id_data_agen";
                $params = [
                    ':no_acak' => $no_acak,
                    ':bulan' => $bulan,
                    ':tahun' => $tahun,
                    ':id_data_agen' => $id_data_agen
                ];
                Yii::$app->db->createCommand($sql, $params)->execute();
                
                //insert arsip_data_komisi
                  $sql = "insert into arsip_transaksi_komisi select :no_acak as no_acak,:tgl_arsip,c.* from transaksi_komisi c "
                        . "inner join data_barang d on d.id=c.id_data_barang and d.id_data_agen=:id_data_agen "
                        . "inner join data_agen e on d.id_data_agen=e.id "
                        . "where e.id=:id_data_agen";
                $params = [
                    ':no_acak' => $no_acak,
                    ':tgl_arsip' => $tgl_arsip,
                    ':id_data_agen' => $id_data_agen
                ];
              Yii::$app->db->createCommand($sql, $params)->execute();
                  
                //insert arsip_data_saldo
                  $sql = "insert into arsip_data_saldo select :no_acak as no_acak,:tgl_arsip,c.* from data_saldo c";
                $params = [
                    ':no_acak' => $no_acak,
                       ':tgl_arsip' => $tgl_arsip,
               
                ];
             Yii::$app->db->createCommand($sql, $params)->execute();
                   
              //insert arsip_data_saldo
                  $sql = "insert into arsip_transaksi_saldo select :no_acak as no_acak,:tgl_arsip,c.* from transaksi_saldo c";
                $params = [
                    ':no_acak' => $no_acak,
                       ':tgl_arsip' => $tgl_arsip,
               
                ];
             Yii::$app->db->createCommand($sql, $params)->execute();
             
                //checkout_item
                $sql = "insert into arsip_checkout_item select :no_acak as no_acak,:tgl_arsip,c.* from checkout_item c where c.tgl_invoice between :tgl_lapor and :tgl_lapor_akhir";
                $params = [
                    ':no_acak' => $no_acak,
                       ':tgl_arsip' => $tgl_arsip,
                    ':tgl_lapor' => $tgl_lapor,
                    ':tgl_lapor_akhir' => $tgl_lapor_akhir,
                ];
                
                Yii::$app->db->createCommand($sql, $params)->execute();
                
                //atur item margin
                  $sql = "insert into arsip_atur_margin_item select :no_acak as no_acak,:tgl_arsip,c.* from atur_margin_item c";
                $params = [
                    ':no_acak' => $no_acak,
                       ':tgl_arsip' => $tgl_arsip,
               
                ];
             Yii::$app->db->createCommand($sql, $params)->execute();
                
                $text="**[PELAPORAN LAPORAN PENJUALAN]** Laporan Penjualan Agen Promo : ".$dataAgen['id_agen'].' / '.$dataAgen['nama_agen'].''
                        . ', Toko : '.$dataToko['nama_toko'].''
                        . ', No Penjualan : '.$no_acak.''
                        . ', Tanggal Laporan : '.$tgl_lapor.' s/d '.$tgl_lapor_akhir;
                \backend\models\BotModel::sendReply($text);
            } else {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return \kartik\form\ActiveForm::validate($model);
            }
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderAjax('_form', [
                    'model' => $model,
                    'bulan' => $bulan,
                    'modelRefPosting' => $modelRefPosting
        ]);
    }

    /**
     * Updates an existing TutupBuku model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TutupBuku model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the TutupBuku model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TutupBuku the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TutupBuku::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionVerifikasi($no_acak) {
        $model = TutupBuku::find()->where(['no_acak' => $no_acak])->one();

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            Yii::$app->session->setFlash('success', 'Sukses terverifikasi');
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderAjax('update', [
                    'model' => $model,
        ]);
    }
//list penerima komisi
    public function actionListPenerimaKomisi($no_acak){
        $query = (new \yii\db\Query())
                ->select('a.id_agen,a.nama_agen,b.no_acak,b.no_acak_penerima')
                ->from('data_agen a')
                ->innerJoin('transaksi_komisi b','b.no_acak_penerima=a.no_acak')
                ->where(['b.no_acak'=>$no_acak])->groupBy('b.no_acak,b.no_acak_penerima');
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query'=>$query
        ]);
        return $this->render('list-penerima-komisi',[
            'dataProvider'=>$dataProvider
        ]);
    }
    
    //cek laporan yang tertinggal
    public function actionListInvoiceLaporan($no_acak){
        $dataTutupBuku = TutupBuku::findOne(['no_acak'=>$no_acak]);
        $tgl_awal = $dataTutupBuku['tgl_lapor'];
        $tgl_akhir = $dataTutupBuku['tgl_lapor_akhir'];
        $no_acak_user = $dataTutupBuku['no_acak_user'];
        $sql = "SELECT * FROM (SELECT * FROM transaksi_barang aa WHERE aa.tgl_transaksi BETWEEN :tgl_lapor AND :tgl_lapor_akhir) a
WHERE  NOT EXISTS (SELECT * FROM arsip_transaksi_barang b WHERE a.no_invoice=b.no_invoice) group by a.no_invoice";
        $dataProvider = new \yii\data\SqlDataProvider([
            'sql'=>$sql,
            'params'=>[
                ':tgl_lapor'=>$tgl_awal,
                ':tgl_lapor_akhir'=>$tgl_akhir
            ],
            'key'=>'no_invoice'
        ]);
         $modelRefPosting = RefPosting::dropDownListPosting();
        $model = new TutupBuku();
        $bulan = \common\component\SettingComponent::listBulan();
$model->no_acak_user=$no_acak_user;

$model->tgl_lapor=$tgl_awal;
$model->tgl_lapor_akhir=$tgl_akhir;
       if ( $model->load(Yii::$app->request->post()))
    {


            $no_acak_agen = $no_acak_user;
            $dataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak_agen])->one();
            $id_data_agen = $dataAgen['id'];
            $dataToko = \backend\models\DataToko::find()->where(['id_data_agen'=>$id_data_agen])->one();
            //    Yii::$app->session->setFlash('danger', 'Bulan dan Tahun transaksi sudah dilaporkan');
            //     $model->validate('bulan_posting');

            $tgl_lapor = $model->tgl_lapor;
            $tgl_lapor_akhir = $model->tgl_lapor_akhir;
$tgl_arsip = date('Y-m-d');
            $no_acak = \backend\models\QueryModel::noacak();
            $bulan = date('m', strtotime($tgl_lapor));
            $tahun = date('Y', strtotime($tgl_lapor));
            $model->bulan_posting = $bulan;
            $model->tahun_posting = $tahun;

            $model->verifikasi = 0;
            $model->no_acak = $no_acak;
            $model->no_acak_user = $no_acak_agen;
            if ($model->save()) {
                
                //insert arsip_data_barang
                $sql = "insert into arsip_data_barang select :no_acak as no_acak,:bulan,:tahun,a.* from data_barang a where a.id_data_agen=:id_data_agen";
                $params = [
                    ':no_acak' => $no_acak,
                    ':bulan' => $bulan,
                    ':tahun' => $tahun,
                    ':id_data_agen' => $id_data_agen
                ];
                Yii::$app->db->createCommand($sql, $params)->execute();
                $selection = Yii::$app->request->post('selection');
                foreach ($selection as $value) {
                    
                
                //insert arsip_transaksi_barang
                $sql = "insert into arsip_transaksi_barang "
                        . "select :no_acak as no_acak,:bulan,:tahun,b.* from transaksi_barang b "
                        . "where  b.no_invoice=:no_invoice";
                $params = [
                    ':no_acak' => $no_acak,
                    ':bulan' => $bulan,
                    ':tahun' => $tahun,
                    ':no_invoice' => $value
                ];
                Yii::$app->db->createCommand($sql, $params)->execute();
                }
                //insert arsip_stok_barang
                $sql = "insert into arsip_stok_barang select :no_acak as no_acak,:bulan,:tahun,c.* from stok_barang c "
                        . "inner join data_barang d on d.id=c.id_data_barang and d.id_data_agen=:id_data_agen "
                        . "inner join data_agen e on d.id_data_agen=e.id and c.id_data_agen=e.id "
                        . "where e.id=:id_data_agen and c.id_data_agen=:id_data_agen";
                $params = [
                    ':no_acak' => $no_acak,
                    ':bulan' => $bulan,
                    ':tahun' => $tahun,
                    ':id_data_agen' => $id_data_agen
                ];
                Yii::$app->db->createCommand($sql, $params)->execute();
                
                //insert arsip_data_komisi
                  $sql = "insert into arsip_transaksi_komisi select :no_acak as no_acak,:tgl_arsip,c.* from transaksi_komisi c "
                        . "inner join data_barang d on d.id=c.id_data_barang and d.id_data_agen=:id_data_agen "
                        . "inner join data_agen e on d.id_data_agen=e.id "
                        . "where e.id=:id_data_agen";
                $params = [
                    ':no_acak' => $no_acak,
                    ':tgl_arsip' => $tgl_arsip,
                    ':id_data_agen' => $id_data_agen
                ];
              Yii::$app->db->createCommand($sql, $params)->execute();
                  
                //insert arsip_data_saldo
                  $sql = "insert into arsip_data_saldo select :no_acak as no_acak,:tgl_arsip,c.* from data_saldo c";
                $params = [
                    ':no_acak' => $no_acak,
                       ':tgl_arsip' => $tgl_arsip,
               
                ];
             Yii::$app->db->createCommand($sql, $params)->execute();
                   
              //insert arsip_data_saldo
                  $sql = "insert into arsip_transaksi_saldo select :no_acak as no_acak,:tgl_arsip,c.* from transaksi_saldo c";
                $params = [
                    ':no_acak' => $no_acak,
                       ':tgl_arsip' => $tgl_arsip,
               
                ];
             Yii::$app->db->createCommand($sql, $params)->execute();
             
                //checkout_item
                $sql = "insert into arsip_checkout_item select :no_acak as no_acak,:tgl_arsip,c.* from checkout_item c where c.tgl_invoice between :tgl_lapor and :tgl_lapor_akhir";
                $params = [
                    ':no_acak' => $no_acak,
                       ':tgl_arsip' => $tgl_arsip,
                    ':tgl_lapor' => $tgl_lapor,
                    ':tgl_lapor_akhir' => $tgl_lapor_akhir,
                ];
                
                Yii::$app->db->createCommand($sql, $params)->execute();
                
                //atur item margin
                  $sql = "insert into arsip_atur_margin_item select :no_acak as no_acak,:tgl_arsip,c.* from atur_margin_item c";
                $params = [
                    ':no_acak' => $no_acak,
                       ':tgl_arsip' => $tgl_arsip,
               
                ];
             Yii::$app->db->createCommand($sql, $params)->execute();
                
                $text="**[PELAPORAN LAPORAN PENJUALAN]** Laporan Penjualan Agen Promo : ".$dataAgen['id_agen'].' / '.$dataAgen['nama_agen'].''
                        . ', Toko : '.$dataToko['nama_toko'].''
                        . ', No Penjualan : '.$no_acak.''
                        . ', Tanggal Laporan : '.$tgl_lapor.' s/d '.$tgl_lapor_akhir;
                \backend\models\BotModel::sendReply($text);
               Yii::$app->session->setFlash('Sukses buat laporan baru');
              return $this->redirect(['index']);
          } 
        }

        return $this->render('list-invoice-laporan',[
            'dataProvider'=>$dataProvider,
            'model'=>$model
        ]);
    }
    
    
}
