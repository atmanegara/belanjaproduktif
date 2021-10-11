<?php

namespace backend\controllers;

use Yii;
use backend\models\DataKomisi;
use backend\models\DataKomisiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DataKomisiController implements the CRUD actions for DataKomisi model.
 */
class DataKomisiController extends Controller {

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
     * Lists all DataKomisi models.
     * @return mixed
     */
    public function actionIndex($id_ref_agen = null) {
        //cekdataagen
        $dataAgen = \backend\models\DataAgen::ambilNoAcakAgenRefAgen($id_ref_agen);
        $searchModel = new DataKomisiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if ($id_ref_agen) {
            if ($id_ref_agen == '5') {
                $dataProvider->query->where(['no_acak' =>Yii::$app->user->identity->no_acak]);
            } else {
                $dataProvider->query->where(['no_acak' => $dataAgen]);
            }
        }
        $totalBp = (new \yii\db\Query())
                        ->select(['sum(nominal) as nominal'])->from('data_komisi')->where(['no_acak' => Yii::$app->user->identity->no_acak])->one();
        //Total Promo
        $totalPromo = (new \yii\db\Query())
                ->select(['sum(nominal) as nominal'])->from('data_komisi')->where(['no_acak' => \backend\models\DataAgen::ambilNoAcakAgenRefAgen(1)])
                ->one();
        //Total Stokis
        $totalStokis = (new \yii\db\Query())
                ->select(['sum(nominal) as nominal'])->from('data_komisi')->where(['no_acak' => \backend\models\DataAgen::ambilNoAcakAgenRefAgen(7)])
                ->one();
        //Total pasok
        $totalPasok = (new \yii\db\Query())
                ->select(['sum(nominal) as nominal'])->from('data_komisi')->where(['no_acak' => \backend\models\DataAgen::ambilNoAcakAgenRefAgen(2)])
                ->one();
        //total niaga
        $totalNiaga = (new \yii\db\Query())
                ->select(['sum(nominal) as nominal'])->from('data_komisi')->where(['no_acak' => \backend\models\DataAgen::ambilNoAcakAgenRefAgen(3)])
                ->one();
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'totalBp' => $totalBp,
                    'totalPromo' => $totalPromo,
                    'totalPasok' => $totalPasok,
                    'totalNiaga' => $totalNiaga,
                    'totalStokis' => $totalStokis,
        ]);
    }

    public function actionNoIndex() {
        $no_acak = Yii::$app->user->identity->no_acak;
        $kadaasing = \backend\models\RegistrasiAgen::find()->where([
                    'no_acak' => $no_acak, 'id_ref_proses_pendaftaran' => '2'
                ])->exists();
        if (!$kadaasing) {
            return $this->renderAjax('no-index');
        }
    }

    public function actionIndexAgen() {
        $no_acak = Yii::$app->user->identity->no_acak;
        $kadaasing = \backend\models\RegistrasiAgen::find()->where([
                    'no_acak' => $no_acak, 'id_ref_proses_pendaftaran' => '2'
                ])->exists();
        if (!$kadaasing) {
            Yii::$app->session->setFlash('danger', 'Data Pribadi Agen Belum di Kirim ke Admin BP');
            return $this->redirect(Yii::$app->request->referrer);
        }

        $dataKomisi = DataKomisi::find()->where(['no_acak' => $no_acak])->one();
        $modelTotalTransksi = \backend\models\TransaksiKomisi::find()->where(['no_acak_penerima' => $no_acak])->count();
//         $searchModel = new DataKomisiSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//        
//             $dataProvider->query->where(['no_acak'=>$no_acak]);
//    
        return $this->render('index-agen', [
                    'dataKomisi' => $dataKomisi,
                    'modelTotalTransksi' => $modelTotalTransksi,
                    'no_acak' => $no_acak
                        //'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DataKomisi model.
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
     * Creates a new DataKomisi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new DataKomisi();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderAjax('_form', [
                    'model' => $model,
        ]);
    }

    public function actionCreateSaldo() {
        $model = new DataKomisi();
        $dataAgen = \backend\models\DataAgen::dropdownagenAll();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderAjax('_form_saldo', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing DataKomisi model.
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

        return $this->renderAjax('_form', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DataKomisi model.
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
     * Finds the DataKomisi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DataKomisi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = DataKomisi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionTransferKebank($no_acak) {
        $model = new \backend\models\KonfirmasiPencairan();
        $cekRekening = \backend\models\DataAgenDetail::find()->where(['no_acak' => $no_acak, 'aktif' => 'Y']);
        if ($cekRekening->exists()) {
            $dataWaris = $cekRekening->one();
        } else {
            return $this->renderAjax('non-rekening');
        }
        if ($model->load(Yii::$app->request->post())) {
                $nominal_ajuan = $model->nominal;
                //nominal komisi tersisa
                  $dataKomisi = DataKomisi::find()->where(['no_acak'=>$no_acak])->one();
                  if(($nominal_ajuan > $dataKomisi['nominal']) or $dataKomisi['nominal']==0){
                      Yii::$app->session->setFlash('warning','Komisi tidak mencukupi nominal yang di ajukan');
//                      echo \yii\bootstrap4\Alert::widget([
//                          'options'=>[
//                             'class' => 'alert-info',
//                          ],
//                          'body'=>'Komisi Tidak Cukup'
//                      ]);
            return $this->redirect(Yii::$app->request->referrer);
                  }
            $model->no_acak = $no_acak;
            $model->no_invoice = '#' . \backend\models\QueryModel::noinvoice();
            $model->id_metode_transfer = 2;
            $model->id_status_pembayaran = 1;
            $model->from_bank = $dataWaris['id_ref_bank'];
            $model->id_ket = 2;
            $model->status_pencarian = 2; //ke bank;
            $model->pencarian_sbg = 2; //sebagai komisi;
            $model->save(false);
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->renderAjax('transfer-kebank', [
                    'model' => $model,
                    'dataWaris' => $dataWaris
        ]);
    }

    public function actionTransferKeagen($no_acak) {
        $modelKonfirmasiPencairan = new \backend\models\KonfirmasiPencairan();
        $dataWaris = \backend\models\DataAgenDetail::find()->where(['no_acak' => $no_acak])->one();
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
//            $dataAgen = \backend\models\DataAgen::find()
//                            ->innerJoin('data_anggota', 'data_agen.no_acak=data_anggota.no_acak')
//                            ->where(['data_anggota.no_acak_agen' => $value['no_acak']])->all(); //agen niaga
//            foreach ($dataAgen as $value) {
//                $dataAgenList[] = [
//                    'id' => $value['id'],
//                    'nama_agen' => $value['nama_agen'] . ' / ' . $value['id_agen']
//                ];
//                $dataAgen = \backend\models\DataAgen::find()
//                                ->innerJoin('data_anggota', 'data_agen.no_acak=data_anggota.no_acak')
//                                ->where(['data_anggota.no_acak_agen' => $value['no_acak']])->all(); //agen niaga
//                foreach ($dataAgen as $value) {
//                    $dataAgenList[] = [
//                        'id' => $value['id'],
//                        'nama_agen' => $value['nama_agen'] . ' / ' . $value['id_agen']
//                    ];
//                }
//            }
        }
        $dataAgenList = \yii\helpers\ArrayHelper::map($dataAgenList, 'id', 'nama_agen');

        if ($modelKonfirmasiPencairan->load(Yii::$app->request->post())) {
//                $nominal_ajuan = $modelKonfirmasiPencairan->nominal;
//                //nominal komisi tersisa
//                  $dataKomisi = DataKomisi::find()->where(['no_acak'=>$no_acak])->one();
//                  if(($nominal_ajuan > $dataKomisi['nominal']) or $dataKomisi['nominal']==0){
//                      Yii::$app->session->setFlash('warning','Nominal Komisi tidak cukup');
////                      echo \yii\bootstrap4\Alert::widget([
////                          'options'=>[
////                             'class' => 'alert-info',
////                          ],
////                          'body'=>'Komisi Tidak Cukup'
////                      ]);
//            return $this->redirect(Yii::$app->request->referrer);
//                  }
            $modelKonfirmasiPencairan->no_acak = $no_acak;
            $modelKonfirmasiPencairan->no_invoice = '#' . \backend\models\QueryModel::noinvoice();
            $modelKonfirmasiPencairan->id_metode_transfer = 2;
            $modelKonfirmasiPencairan->id_status_pembayaran = 1;
            $modelKonfirmasiPencairan->from_bank = $dataWaris['id_ref_bank'];
            //     $modelKonfirmasiPencairan->id_data_agen = $dataWaris['jns_bank'];
            $modelKonfirmasiPencairan->id_ket = 2;
            $modelKonfirmasiPencairan->status_pencarian = 1; //ke agen;
            $modelKonfirmasiPencairan->save(false);
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->renderAjax('transfer-keagen', [
                    'model' => $modelKonfirmasiPencairan,
                    'dataWaris' => $dataWaris,
                    'dataAgenList' => $dataAgenList
        ]);
    }

    public function actionTransferKesaldo($no_acak) {
        $modelKonfirmasiPencairan = new \backend\models\KonfirmasiPencairan();
        $modelKonfirmasiPencairan->pencarian_sbg = 1;




        if ($modelKonfirmasiPencairan->load(Yii::$app->request->post())) {
             $nominal = $modelKonfirmasiPencairan->nominal;
            ///potong komisi
             $komisi = DataKomisi::find()->where(['no_acak' => $no_acak])->one();
            $danaSebelumnya = $komisi['nominal'];
          if($nominal >$danaSebelumnya ){
       Yii::$app->session->setFlash('danger','Gagal Transfer');
       Yii::$app->session->setFlash('danger','Nominal terlalu besar');
            return $this->redirect(Yii::$app->request->referrer);       
          }
              $komisi->nominal = $danaSebelumnya - $nominal;
            $komisi->save(false);
            
            $no_invoice = \backend\models\QueryModel::noinvoice();
            $modelKonfirmasiPencairan->no_acak = $no_acak;
            $modelKonfirmasiPencairan->no_invoice = '#' . $no_invoice;
            $modelKonfirmasiPencairan->id_metode_transfer = 2;
            $modelKonfirmasiPencairan->id_status_pembayaran = 2;
            $modelKonfirmasiPencairan->from_bank = '-';
            $modelKonfirmasiPencairan->pencarian_sbg = 1;
            $modelKonfirmasiPencairan->id_ket = 2;
            $modelKonfirmasiPencairan->status_pencarian = 1; //ke agen;
            $modelKonfirmasiPencairan->save(false);
            $id = $modelKonfirmasiPencairan->getPrimaryKey();

            $sql = "insert into riwayat_pencairan select :no_acak,:tgl_pencairan, a.* from konfirmasi_pencairan a where a.id=:id";
            $params = [
                ':no_acak' => \backend\models\QueryModel::noacak(),
                ':tgl_pencairan' => date('Y-m-d'),
                ':id' => $id
            ];
            Yii::$app->db->createCommand($sql, $params)->execute();
            //masuk ke saldo
            $modelSaldo = \backend\models\DataSaldo::find()->where(['no_acak' => $no_acak]);
            if ($modelSaldo->exists()) {
                $saldo = $modelSaldo->one();
                $saldoSebalumnya = $saldo['nominal_awal'];
                $totSaldo = $nominal + $saldoSebalumnya;
                $saldo->nominal_awal = $totSaldo;
            } else
                $saldo = new \backend\models\DataSaldo ();
            $totSaldo = $modelKonfirmasiPencairan->nominal;
            $saldo->nominal_awal = $totSaldo;
            $saldo->no_acak = $no_acak;

            $saldo->tgl_masuk = date('Y-m-d');
            $saldo->save(false);
            //masuk transaksi saldo
            $modelTransaksiSaldo = new \backend\models\TransaksiSaldo();
            $modelTransaksiSaldo->no_acak=$no_acak;
            $modelTransaksiSaldo->no_invoice = $no_invoice;
            $modelTransaksiSaldo->tgl_transaksi = date('Y-m-d');
            $modelTransaksiSaldo->nominal_masuk = $modelKonfirmasiPencairan->nominal;
            $modelTransaksiSaldo->nominal_keluar = 0;
            $modelTransaksiSaldo->nominal_sisa = $totSaldo;
            $modelTransaksiSaldo->save(false);

           
       Yii::$app->session->setFlash('success','Transfer Sukses');
            return $this->redirect(Yii::$app->request->referrer);
        }


        return $this->renderAjax('transfer-kesaldo', [
                    'model' => $modelKonfirmasiPencairan,
        ]);
    }

}
