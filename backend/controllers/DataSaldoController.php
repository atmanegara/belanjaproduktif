<?php

namespace backend\controllers;

use Yii;
use backend\models\DataSaldo;
use backend\models\DataSaldoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\KonfirmasiTopup;

/**
 * DataSaldoController implements the CRUD actions for DataSaldo model.
 */
class DataSaldoController extends Controller {

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
     * Lists all DataSaldo models.
     * @return mixed
     */
    public function actionIndex() {
        $role_id = Yii::$app->user->identity->role_id;
        $searchModel = new DataSaldoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $totalBelumKOnfirmasi = KonfirmasiTopup::find()->where(['id_status_pembayaran' => 3]);
        $totalBelumVerifikasi = KonfirmasiTopup::find()->where(['id_status_pembayaran' => 1]);
        $totalVerifikasi = KonfirmasiTopup::find()->where(['id_status_pembayaran' => 2]);


        $totalBelumKOnfirmasi = $totalBelumKOnfirmasi->count();
        $totalBelumVerifikasi = $totalBelumVerifikasi->count();
        $totalVerifikasi = $totalVerifikasi->count();
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'totalBelumKOnfirmasi' => $totalBelumKOnfirmasi,
                    'totalBelumVerifikasi' => $totalBelumVerifikasi,
            'totalVerifikasi'=>$totalVerifikasi
        ]);
    }

    public function actionIndexAgen() {

        $role_id = Yii::$app->user->identity->role_id;
        $no_acak = Yii::$app->user->identity->no_acak;
        if (!\backend\models\DataAgen::cekIdAgenExists($no_acak)) {
            //     Yii::$app->session->setFlash('danger','Pastikan anda sudah mengisi data pribadi');
            return $this->redirect(['/site/data-agen-exists']);
        }
        $kadaasing = \backend\models\RegistrasiAgen::find()->where([
                    'no_acak' => $no_acak, 'id_ref_proses_pendaftaran' => '2'
                ])->exists();
        if (!$kadaasing) {
            Yii::$app->session->setFlash('danger', 'Data Pribadi Agen Belum di IInformasikan');
            return $this->redirect(Yii::$app->request->referrer);
        }

         $totalTransaksiBarangViaSaldo = (new \yii\db\Query())
                ->select(['b.no_invoice,b.tgl_transaksi, sum(b.total_jual) as total_jual'])
                ->from('detail_pembayaran a')
                ->innerJoin('transaksi_barang b','a.no_invoice=b.no_invoice')
                ->innerJoin('data_agen c','b.id_data_agen=c.id')
                ->where(['c.no_acak'=>$no_acak,'a.id_metode_pembayaran'=>'1'])->groupBy('a.no_invoice')->count();
                 
        
        $totalBelumKOnfirmasi = KonfirmasiTopup::find()->where(['id_status_pembayaran' => 3]);
//        $totalBelumVerifikasi = KonfirmasiTopup::find()->where(['id_status_pembayaran' => 1]);
        $totalBatal = KonfirmasiTopup::find()->where(['id_status_pembayaran' => 4]);

        //cekbatal agen
          $cekBatal = KonfirmasiTopup::find()->where(['id_status_pembayaran' => 4,'no_acak'=>$no_acak]);
$totalBatalAgen = $totalBatal->andWhere(['no_acak' => $no_acak])->count();
        //$cekBatal = $totalBatal->exists();
        $totalBelumKOnfirmasi = $totalBelumKOnfirmasi->andWhere(['no_acak' => $no_acak]);
           $dataSaldo = DataSaldo::getTotalNominal($no_acak);
      $totalBelumKOnfirmasi = $totalBelumKOnfirmasi->count();
//        $totalBelumVerifikasi = $totalBelumVerifikasi->count();
        
        $totalBatal = $totalBatal->count();
        $totalTransaksiSaldo = \backend\models\TransaksiSaldo::find()->where(['no_acak'=>$no_acak])->count();
        return $this->render('index-agen', [
                    //  'searchModel' => $searchModel,
                    //    'dataProvider' => $dataProvider,
                    'totalBelumKOnfirmasi' => $totalBelumKOnfirmasi,
//                    'totalBelumVerifikasi' => $totalBelumVerifikasi,
                    'no_acak' => $no_acak,
            'dataSaldo'=>$dataSaldo,
            'totalTransaksiSaldo'=>$totalTransaksiSaldo,
            'totalTransaksiBarangViaSaldo'=>$totalTransaksiBarangViaSaldo,
            'totalBatal'=>$totalBatal,
            'cekBatal'=>$cekBatal,
            'totalBatalAgen'=>$totalBatalAgen
        ]);
    }

    /**
     * Displays a single DataSaldo model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->renderAjax('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DataSaldo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {

        $no_acak = Yii::$app->user->identity->no_acak;
        $model = new DataSaldo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->renderAjax('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing DataSaldo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $no_acak = Yii::$app->user->identity->no_acak;
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderAjax('_form', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DataSaldo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DataSaldo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DataSaldo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = DataSaldo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionTransferKebank($no_acak) {
        $modelKonfirmasiSaldo = new KonfirmasiTopup();
        $dataWaris = \backend\models\DataAgenWaris::find()->where(['no_acak' => $no_acak])->one();
        if ($modelKonfirmasiSaldo->load(Yii::$app->request->post())) {
            $modelKonfirmasiSaldo->no_acak = $no_acak;
            $modelKonfirmasiSaldo->no_invoice = '#' . \backend\models\QueryModel::noinvoice();
            $modelKonfirmasiSaldo->id_metode_transfer = 2;
            $modelKonfirmasiSaldo->id_status_pembayaran = 1;
            $modelKonfirmasiSaldo->from_bank = $dataWaris['jns_bank'];
            $modelKonfirmasiSaldo->id_ket_saldo = 2;
            $modelKonfirmasiSaldo->save(false);
            
          
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->renderAjax('transfer-kebank', [
                    'model' => $modelKonfirmasiSaldo
        ]);
    }
  public function actionTransferKeagen($no_acak) {
        $modelKonfirmasiPencairan = new \backend\models\KonfirmasiPencairan();
        $dataAgenList = [];

        $dataAgen = \backend\models\DataAgen::find()
                        ->innerJoin('data_anggota', 'data_agen.no_acak=data_anggota.no_acak')
                        ->where(['data_anggota.no_acak_agen' => $no_acak])->all(); //agen pasok
        foreach ($dataAgen as $value) {
            $dataAgenList[] = [//agen pasok
                'id' => $value['id'],
                'nama_agen' => $value['nama_agen'] . ' / ' . $value['id_agen']
            ];
            $no_acak_ref = $value['no_acak']; //acak agen pasok
            for ($i = 0; $i <= 10; $i++) { //looping 10 kali
                $dataAgen = \backend\models\DataAgen::find()
                        ->innerJoin('data_anggota', 'data_agen.no_acak=data_anggota.no_acak')
                        ->where(['data_anggota.no_acak_agen' => $no_acak_ref]); //agen niaga atau pasok (rekruut sesama pasok)
                if ($dataAgen->exists()) {
                    $no_acak_ref = $value['no_acak'];
                    foreach ($dataAgen->all() as $value) {
                        $dataAgenList[] = [
                            'id' => $value['id'],
                            'nama_agen' => $value['nama_agen'] . ' / ' . $value['id_agen']
                        ];
                    }
                } else {
                    continue;
                }
            }

        }
        $dataAgenList = \yii\helpers\ArrayHelper::map($dataAgenList, 'id', 'nama_agen');

        if ($modelKonfirmasiPencairan->load(Yii::$app->request->post())) {
                $nominal_ajuan = $modelKonfirmasiPencairan->nominal;
                //nominal komisi tersisa
                  $dataKomisi = DataSaldo::find()->where(['no_acak'=>$no_acak])->one();
                  if(($nominal_ajuan > $dataKomisi['nominal_awal']) or $dataKomisi['nominal_awal']<=0){
                      Yii::$app->session->setFlash('warning','Nominal Saldo tidak cukup');
//                      echo \yii\bootstrap4\Alert::widget([
//                          'options'=>[
//                             'class' => 'alert-info',
//                          ],
//                          'body'=>'Komisi Tidak Cukup'
//                      ]);
            return $this->redirect(Yii::$app->request->referrer);
                  }
            $modelKonfirmasiPencairan->no_acak = $no_acak;
            $modelKonfirmasiPencairan->no_invoice = '#' . \backend\models\QueryModel::noinvoice();
            $modelKonfirmasiPencairan->id_metode_transfer = 2;
            $modelKonfirmasiPencairan->id_status_pembayaran = 2;
            $modelKonfirmasiPencairan->from_bank = '-';
                 $modelKonfirmasiPencairan->pencarian_sbg = 1;
            $modelKonfirmasiPencairan->id_ket = 2;
            $modelKonfirmasiPencairan->status_pencarian = 1; //ke agen;
            $modelKonfirmasiPencairan->save(false);
            $id = $modelKonfirmasiPencairan->getPrimaryKey();
            $nominal = $modelKonfirmasiPencairan->nominal;
            //langsung cairkan
              $modelDataAgen = \backend\models\DataAgen::findOne($modelKonfirmasiPencairan->id_data_agen);
                         $modelSaldo =  \backend\models\DataSaldo::find()->where(['no_acak'=>$modelDataAgen['no_acak']]);
                            if($modelSaldo->exists()){
                                 $modelSaldo = $modelSaldo->one();
                             }else{
                                 $modelSaldo = new \backend\models\DataSaldo();
                                 $modelSaldo->no_acak = $modelDataAgen['no_acak'];
                                 
                             }
                             
                       $nominal_awal = $modelSaldo['nominal_awal'];
                       $modelSaldo->nominal_awal = $nominal_awal+$nominal;
                       $modelSaldo->tgl_masuk = date('Y-m-d');
                       $modelSaldo->save(false);
                       //saldo sendiri berkurang
                        $modelSaldo =  \backend\models\DataSaldo::find()->where(['no_acak'=>$no_acak]);
                            if($modelSaldo->exists()){
                                 $modelSaldo = $modelSaldo->one();
                                
                          
                             
                       $nominal_awal = $modelSaldo['nominal_awal'];
                       $modelSaldo->nominal_awal = $nominal_awal-$nominal;
                       $modelSaldo->tgl_masuk = date('Y-m-d');
                       $modelSaldo->save(false);
                          }
                           $sql = "insert into riwayat_pencairan select :no_acak,:tgl_pencairan, a.* from konfirmasi_pencairan a where a.id=:id";
                 $params=[
                     ':no_acak'=> \backend\models\QueryModel::noacak(),
                     ':tgl_pencairan'=>date('Y-m-d'),
                     ':id'=>$id
                 ];
                 Yii::$app->db->createCommand($sql, $params)->execute();
//transaksi saldo
                     $modelTransaksiSaldo = new \backend\models\TransaksiSaldo();
            $modelTransaksiSaldo->no_acak = $no_acak;
            $modelTransaksiSaldo->no_invoice = \backend\models\QueryModel::noinvoice();
            $modelTransaksiSaldo->nominal_keluar = $nominal;
            $modelTransaksiSaldo->nominal_sisa = $nominal_awal - $nominal;
            $modelTransaksiSaldo->id_ket_saldo = 2;  //melakukan pembayaran untuk pencairan

            $modelTransaksiSaldo->tgl_transaksi = date('Y-m-d');
            $modelTransaksiSaldo->id_metode_transfer = 2;
            $modelTransaksiSaldo->id_ref_bank = 0;
            $modelTransaksiSaldo->save(false);
            Yii::$app->session->setFlash('success','Saldo sudah di transfer');

            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->renderAjax('transfer-keagen', [
                    'model' => $modelKonfirmasiPencairan,
                   'dataAgenList' => $dataAgenList
        ]);
    }
    public function actionTransaksiBelanjaSaldo($no_acak){
        $query = (new \yii\db\Query())
                ->select(['b.no_invoice,b.tgl_transaksi, sum(b.total_jual) as total_jual'])
                ->from('detail_pembayaran a')
                ->innerJoin('transaksi_barang b','a.no_invoice=b.no_invoice')
                ->innerJoin('data_agen c','b.id_data_agen=c.id')
                ->where(['c.no_acak'=>$no_acak,'a.id_metode_pembayaran'=>'1'])->groupBy('a.no_invoice');
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query'=>$query
        ]);
                
return $this->render('transaksi-belanja-saldo',[
    'dataProvider' => $dataProvider
]);
    }
}
