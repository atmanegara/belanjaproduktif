<?php

namespace backend\controllers;

use Yii;
use backend\models\DataBagiHasil;
use backend\models\DataBagiHasilSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
use backend\models\KondisiBagiHasil;
/**
 * DataBagiHasilController implements the CRUD actions for DataBagiHasil model.
 */
class DataBagiHasilController extends Controller {

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
     * Lists all DataBagiHasil models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new DataBagiHasilSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DataBagiHasil model.
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
     * Creates a new DataBagiHasil model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($no_acak_tutup_buku, $no_acak_user) {
        $model = new DataBagiHasil();
        $dataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak_user])->one();
        if ($model->load(Yii::$app->request->post())) {
            $dataAnggotaAgenPromo = '';
            //
            $no_acak = \backend\models\QueryModel::noacak();
            $dataAnggota = \backend\models\DataAnggota::find()->where(['no_acak_agen' => $no_acak_user])->all();
            //aggen pasok dari agen promo
            $query = \backend\models\QueryModel::getTransaksiPenjualan($no_acak_tutup_buku, $dataAgen['id']);

            $atur_bagi_hasil_jual = \backend\models\AturBagiHasilJual::find()->orderBy('id_ref_agen')->all();
            foreach ($query as $valJual) {
                $dataAnggotaAgen = [];
                $no_acak_pembeli = $valJual['no_acak_pembeli'];
                $no_acak_promo = $valJual['no_acak_agen_promo'];
                //   return var_dump($valAnggota);
                // $dataAgenRef = \backend\models\DataAgen::find()->where(['no_acak'=>$valJual['no_acak_pembeli']])->one();
                $dataAgenPembeli = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak_pembeli])->one();
                $no_acak_referensi = $dataAgenPembeli['no_acak_ref'];
                $level = 0;
                $hasil = 0;
                $itemPasok = 'N';
                $ket_sumber = 2;
                $kondisi = false;
                $kondisiPromo = false;
                $kode_anggota = [];
                if (in_array(Yii::$app->user->identity->role_id, ['1'])) {
//
//                    //masukkan BP dalam anggota
//                    $dataAnggotaAgen[] = [
//                        'no_acak' => Yii::$app->user->identity->no_acak,
//                        'id_data_agen' => Yii::$app->user->identity->id_agen,
//                        'id_ref_agen' => Yii::$app->user->identity->id_ref_agen,
//                        'level' => 0, //artinya direkut sesama BP langsung
//                        'itemPasok' => 'N',
//                        'ket_sumber' => $ket_sumber,
//                            //      'ket_agen' => "99" //BP
//                    ];
//                    $kode_anggota[] = '99';
//                }
//                if ($dataAgenPembeli['id_ref_agen'] == '1') {
//                    $no_acak_referensi = $no_acak_user;
//                    $levelpasok = 0;
//                    $tingkat = 0;
//                    for ($tingkat = 0; $tingkat < 10; $tingkat++) {
//                        $dataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak_referensi, 'id_ref_agen' => '1']); //artinya sesama pasok
//                        if ($dataAgen->exists()) {
//                            $level = $tingkat + 1; //menunjukan jika direkrot oleh pasok 1, jika level=2 artinya direkrot pasok no 2, pasok(1) rekrot pasok(2) rekrut pasok
//                            $dataAgenPasok = $dataAgen->one(); //promo
//
//                            $ket_agen = '2'; //2:Hanya promo
//                            $kode_anggota[] = $ket_agen;
//                            $dataAnggotaAgen[] = [
//                                'no_acak' => $dataAgenPasok['no_acak'],
//                                'id_data_agen' => $dataAgenPasok['id'],
//                                'id_ref_agen' => $dataAgenPasok['id_ref_agen'],
//                                'level' => $level,
//                                'itemPasok' => $itemPasok,
//                                'ket_sumber' => $ket_sumber,
//                                    //       'ket_agen'=>$ket_agen
//                            ];
//
//                            $dataItemBelanja = (new \yii\db\Query())
//                                    ->select('a.item_barang,b.no_acak,d.id,d.id_ref_agen,d.nama_agen,d.id_agen')
//                                    ->from('data_barang a')
//                                    ->innerJoin('data_item_barang_agen b', 'a.id_ref_barang=b.id_ref_barang')
//                                    ->innerJoin('data_agen d', 'b.no_acak=d.no_acak')
//                                //    ->leftJoin('data_agen d', 'b.no_acak=d.no_acak')
//                                    ->where([
//                                'b.no_acak' => \yii\helpers\ArrayHelper::map(\backend\models\DataAnggota::find()->where(['no_acak_agen'=>$no_acak_user])->asArray()->all(),'no_acak','no_acak'),
//                                'b.id_ref_barang' => $valJual['id_ref_barang']
//                            ]);
//                            if ($dataItemBelanja->exists()) { //cek siapa pemilik item ini dalam agen promo itu sendiri
//                                $kondisi = true;
//                                $ket_sumber = 4;
//                                $itemPasok = 'Y';
//                                $dataAgenPasokItem = $dataItemBelanja->one();
//                                $dataAnggotaAgen[] = [
//                                    'no_acak' => $dataAgenPasokItem['no_acak'],
//                                    'id_data_agen' => $dataAgenPasokItem['id'],
//                                    'id_ref_agen' => $dataAgenPasokItem['id_ref_agen'],
//                                    'level' => 1,
//                                    'itemPasok' => $itemPasok,
//                                    'ket_sumber' => $ket_sumber
//                                ];
//                                $ket_agen = '12';
//                                $kode_anggota[] = $ket_agen;
//                            }
//
//
//                            $no_acak_referensi = $dataAgenPasok['no_acak_ref'];
//                        }
//                    }
//                }
//
////stokis
//                if ($dataAgenPembeli['id_ref_agen'] == '7') {
//                    $no_acak_referensi = $no_acak_user;
//                    $levelpasok = 0;
//                    $tingkat = 0;
//                    for ($tingkat = 0; $tingkat < 10; $tingkat++) {
//                        $dataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak_referensi, 'id_ref_agen' => '7']); //artinya direkut sesama stokis
//                        if ($dataAgen->exists()) {
//                            $level = $tingkat + 1; //menunjukan jika direkrot oleh pasok 1, jika level=2 artinya direkrot pasok no 2, pasok(1) rekrot pasok(2) rekrut pasok
//                            $dataAgenPasok = $dataAgen->one();
//
//                            $ket_agen = '2'; //2:Hanya pasok rekrot bukan pemilik item
//                            $kode_anggota[] = $ket_agen;
//                            $dataAnggotaAgen[] = [
//                                'no_acak' => $dataAgenPasok['no_acak'],
//                                'id_data_agen' => $dataAgenPasok['id'],
//                                'id_ref_agen' => $dataAgenPasok['id_ref_agen'],
//                                'level' => $level,
//                                'itemPasok' => $itemPasok,
//                                'ket_sumber' => $ket_sumber,
//                                    //       'ket_agen'=>$ket_agen
//                            ];
// $dataItemBelanja = (new \yii\db\Query())
//                                    ->select('a.item_barang,b.no_acak,d.id,d.id_ref_agen,d.nama_agen,d.id_agen')
//                                    ->from('data_barang a')
//                                    ->innerJoin('data_item_barang_agen b', 'a.id_ref_barang=b.id_ref_barang')
//                                    ->innerJoin('data_agen d', 'b.no_acak=d.no_acak')
//                                //    ->leftJoin('data_agen d', 'b.no_acak=d.no_acak')
//                                    ->where([
//                                'b.no_acak' => \yii\helpers\ArrayHelper::map(\backend\models\DataAnggota::find()->where(['no_acak_agen'=>$no_acak_user])->asArray()->all(),'no_acak','no_acak'),
//                                'b.id_ref_barang' => $valJual['id_ref_barang']
//                            ]);
// 
////                            $dataItemBelanja = (new \yii\db\Query())
////                                    ->select('a.item_barang,b.no_acak,d.id,d.id_ref_agen,d.nama_agen,d.id_agen')
////                                    ->from('data_barang a')
////                                    ->leftJoin('data_item_barang_agen b', 'a.id_ref_barang=b.id_ref_barang')
////                                    ->innerJoin('data_agen c', 'a.id_data_agen=c.id')
////                                    ->leftJoin('data_agen d', 'b.no_acak=d.no_acak')
////                                    ->where([
////                                'c.no_acak' => $no_acak_user,
////                                'b.id_ref_barang' => $valJual['id_ref_barang']
////                            ]);
//                            if ($dataItemBelanja->exists()) { //cek siapa pemilik item ini dalam agen promo itu sendiri
//                                $kondisi = true;
//                                $ket_sumber = 4;
//                                $itemPasok = 'Y';
//                                $dataAgenPasokItem = $dataItemBelanja->one();
//                                $dataAnggotaAgen[] = [
//                                    'no_acak' => $dataAgenPasokItem['no_acak'],
//                                    'id_data_agen' => $dataAgenPasokItem['id'],
//                                    'id_ref_agen' => $dataAgenPasokItem['id_ref_agen'],
//                                    'level' => 1,
//                                    'itemPasok' => $itemPasok,
//                                    'ket_sumber' => $ket_sumber
//                                ];
//                                $ket_agen = '12';
//                                $kode_anggota[] = $ket_agen;
//                            }
//
//
//                            $no_acak_referensi = $dataAgenPasok['no_acak_ref'];
//                        }
//                    }
//                }
//
//                if ($dataAgenPembeli['id_ref_agen'] == '2') {
//                    $level = 0;
//                    $levelpasok = 0;
//                    $tingkat = 0;
//                    for ($tingkat = 0; $tingkat < 10; $tingkat++) {
//                        $dataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak_referensi, 'id_ref_agen' => '2']); //artinya direkut sesama pasok
//                        if ($dataAgen->exists()) {
//                            $level = $level + 1; //menunjukan jika direkrot oleh pasok 1, jika level=2 artinya direkrot pasok no 2, pasok(1) rekrot pasok(2) rekrut pasok
//                            $dataAgenPasok = $dataAgen->one();
//
//                            $dataItemPasok = (new \yii\db\Query())
//                                    ->select('a.item_barang,b.no_acak,d.id,d.id_ref_agen,d.nama_agen,d.id_agen')
//                                    ->from('data_barang a')
//                                    ->leftJoin('data_item_barang_agen b', 'a.id_ref_barang=b.id_ref_barang')
//                                    ->innerJoin('data_agen c', 'a.id_data_agen=c.id')
//                                    ->leftJoin('data_agen d', 'b.no_acak=d.no_acak')
//                                    ->where([
//                                'b.no_acak' => $no_acak_referensi,
//                                'b.id_ref_barang' => $valJual['id_ref_barang']
//                            ]);
//                            if ($dataItemPasok->exists()) {  //cek apakah pasok yang merekrot pemilik item
//                                $kondisi = true;
//                                $itemPasok = 'Y';
//                                $levelpasok++;
//                                $ket_sumber = 4;
//                                $ket_agen = "21"; //"21:Pasok Rekrot Pasok Pemilik Item" 
//                                $dataAgenPasokItem = $dataItemPasok->one();
//                                $dataAnggotaAgen[] = [
//                                    'no_acak' => $dataAgenPasokItem['no_acak'],
//                                    'id_data_agen' => $dataAgenPasokItem['id'],
//                                    'id_ref_agen' => $dataAgenPasokItem['id_ref_agen'],
//                                    'level' => 1,
//                                    'itemPasok' => $itemPasok,
//                                    'ket_sumber' => $ket_sumber
//                                ];
//                                $kode_anggota[] = $ket_agen;
//                            } else {
//                                if ($level == '1') {
//                                    $ket_agen = '2'; //2:Hanya pasok rekrot bukan pemilik item
//                                    $kode_anggota[] = $ket_agen;
//                                    $dataAnggotaAgen[] = [
//                                        'no_acak' => $dataAgenPasok['no_acak'],
//                                        'id_data_agen' => $dataAgenPasok['id'],
//                                        'id_ref_agen' => $dataAgenPasok['id_ref_agen'],
//                                        'level' => $level,
//                                        'itemPasok' => $itemPasok,
//                                        'ket_sumber' => $ket_sumber,
//                                            //       'ket_agen'=>$ket_agen
//                                    ];
//                                }
//                                if ($level == '1') {
////                                    $dataItemBelanja = (new \yii\db\Query())
////                                            ->select('a.item_barang,b.no_acak,c.id,c.id_ref_agen,c.nama_agen,c.id_agen')
////                                            ->from('data_barang a')
////                                            ->innerJoin('data_item_barang_agen b', 'a.id_ref_barang=b.id_ref_barang')
////                                            ->innerJoin('data_agen c', 'b.no_acak=c.no_acak')
////                                            ->where([
////                                        'c.no_acak_ref' => $no_acak_user,
////                                        'b.id_ref_barang' => $valJual['id_ref_barang']
////                                    ]);
//                                    
//                                     $dataItemBelanja = (new \yii\db\Query())
//                                    ->select('a.item_barang,b.no_acak,d.id,d.id_ref_agen,d.nama_agen,d.id_agen')
//                                    ->from('data_barang a')
//                                    ->innerJoin('data_item_barang_agen b', 'a.id_ref_barang=b.id_ref_barang')
//                                    ->innerJoin('data_agen d', 'b.no_acak=d.no_acak')
//                                //    ->leftJoin('data_agen d', 'b.no_acak=d.no_acak')
//                                    ->where([
//                                'b.no_acak' => \yii\helpers\ArrayHelper::map(\backend\models\DataAnggota::find()->where(['no_acak_agen'=>$no_acak_user])->asArray()->all(),'no_acak','no_acak'),
//                                'b.id_ref_barang' => $valJual['id_ref_barang']
//                            ]);
//                                     
//                                    if ($dataItemBelanja->exists()) { //cek siapa pemilik item ini dalam agen promo itu sendiri
//                                        $kondisi = true;
//                                        $ket_sumber = 4;
//                                        $itemPasok = 'Y';
//                                        $dataAgenPasokItem = $dataItemBelanja->one();
//                                        $dataAnggotaAgen[] = [
//                                            'no_acak' => $dataAgenPasokItem['no_acak'],
//                                            'id_data_agen' => $dataAgenPasokItem['id'],
//                                            'id_ref_agen' => $dataAgenPasokItem['id_ref_agen'],
//                                            'level' => 1,
//                                            'itemPasok' => $itemPasok,
//                                            'ket_sumber' => $ket_sumber
//                                        ];
//                                        $ket_agen = '12';
//                                        $kode_anggota[] = $ket_agen;
//                                    }
//                                }
//                            }
//                            $no_acak_referensi = $dataAgenPasok['no_acak_ref'];
//                        } else {
//                            $dataAnggotaAgenPromo = '';
//                            if ($no_acak_promo != $no_acak_referensi) {
//                                $no_acak_referensi = $no_acak_promo;
//                            }
//                            $dataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak_referensi, 'id_ref_agen' => '1']); //agen promo
//                            $dataAgenPromo = $dataAgen->one();
//                            $ket_agen = '1';
//
//                            $dataAnggotaAgen[] = [
//                                'no_acak' => $dataAgenPromo['no_acak'],
//                                'id_data_agen' => $dataAgenPromo['id'],
//                                'id_ref_agen' => $dataAgenPromo['id_ref_agen'],
//                                'level' => $level, //artinya direkut  BP langsung
//                                'itemPasok' => $itemPasok,
//                                'ket_sumber' => $ket_sumber,
//                                    // 'ket_agen'=>'1', //Promo
//                            ];
//
//                            $dataAnggotaAgenPromo = [
//                                'no_acak' => $dataAgenPromo['no_acak'],
//                                'id_data_agen' => $dataAgenPromo['id'],
//                                'id_ref_agen' => $dataAgenPromo['id_ref_agen'],
//                                'level' => $level, //artinya direkut  BP langsung
//                                'itemPasok' => $itemPasok,
//                                'ket_sumber' => $ket_sumber,
//                                    // 'ket_agen'=>'1', //Promo
//                            ];
//                            $kode_anggota[] = $ket_agen;
//                            $tingkat = 11;
//                            if ($level == '0') {
//                                $dataItemBelanja = (new \yii\db\Query())
//                                        ->select('a.item_barang,b.no_acak,c.id,c.id_ref_agen,c.nama_agen,c.id_agen')
//                                        ->from('data_barang a')
//                                        ->innerJoin('data_item_barang_agen b', 'a.id_ref_barang=b.id_ref_barang')
//                                        ->innerJoin('data_agen c', 'b.no_acak=c.no_acak')
//                                        ->where([
//                                    'c.no_acak_ref' => $no_acak_user,
//                                    'b.id_ref_barang' => $valJual['id_ref_barang']
//                                ]);
//                                if ($dataItemBelanja->exists()) {
//                                    $kondisi = true;
//                                    $ket_sumber = 4;
//                                    $itemPasok = 'Y';
//                                    $dataAgenPasokItem = $dataItemBelanja->one();
//                                    $dataAnggotaAgen[] = [
//                                        'no_acak' => $dataAgenPasokItem['no_acak'],
//                                        'id_data_agen' => $dataAgenPasokItem['id'],
//                                        'id_ref_agen' => $dataAgenPasokItem['id_ref_agen'],
//                                        'level' => 1,
//                                        'itemPasok' => $itemPasok,
//                                        'ket_sumber' => $ket_sumber
//                                    ];
//                                    $ket_agen = '12';
//                                    $kode_anggota[] = $ket_agen;
//                                }
//                            }
//                        }
//                    }
//                }
//
//
//                if ($dataAgenPembeli['id_ref_agen'] == '3') {
//                    $level = 0;
//                    $levelpasok = 0;
//                    $dataAnggotaAgenPromo = '';
//                    $tingkat = 0;
//                    for ($tingkat = 0; $tingkat < 10; $tingkat++) {
//                        $dataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak_referensi, 'id_ref_agen' => '3']);
//                        if ($dataAgen->exists()) {  //artinya direkut sesama niaga
//                            $level = $level + 1; //menunjukan jika direkrot oleh niaga 1, jika level=2 artinya direkrot niaga no 2, niaga(1) rekrot niaga(2) rekrut niaga
//                            $dataAgenx = $dataAgen->one();
//                           if ($level == '1') {    
//                               $dataAnggotaAgen[] = [
//                                'no_acak' => $dataAgenx['no_acak'],
//                                'id_data_agen' => $dataAgenx['id'],
//                                'id_ref_agen' => $dataAgenx['id_ref_agen'],
//                                'level' => $level,
//                                'itemPasok' => $itemPasok,
//                                'ket_sumber' => $ket_sumber
//                            ];
//
//                            $ket_agen = '3'; //pasok yang rekrut niaga
//                           }
//                            $no_acak_referensi = $dataAgenx['no_acak_ref'];
//                            $kode_anggota[] = $ket_agen;
//                        } else {
//                            $dataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak_referensi, 'id_ref_agen' => '2']); //apakah pasok yang merekrtut ada pasok lain yang merekrot
//                            if ($dataAgen->exists()) {
//                                $dataAgenx = $dataAgen->one();
//                                $tingkatx = 0;
//                                for ($tingkat = 0; $tingkat < 10; $tingkat++) {
//                                    $dataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak_referensi, 'id_ref_agen' => '2']); //artinya direkut sesama pasok
//                                    if ($dataAgen->exists()) {
//                                      $level = $level + 1;
//                                      
//                                      $levelpasok = $levelpasok + 1; //menunjukan jika direkrot oleh pasok 1, jika level=2 artinya direkrot pasok no 2, pasok(1) rekrot pasok(2) rekrut pasok
//                                        $dataAgenPasok = $dataAgen->one();
//
//                                        $dataItemPasok = (new \yii\db\Query())
//                                                ->select('a.item_barang,b.no_acak,d.id,d.id_ref_agen,d.nama_agen,d.id_agen')
//                                                ->from('data_barang a')
//                                                ->leftJoin('data_item_barang_agen b', 'a.id_ref_barang=b.id_ref_barang')
//                                                ->innerJoin('data_agen c', 'a.id_data_agen=c.id')
//                                                ->leftJoin('data_agen d', 'b.no_acak=d.no_acak')
//                                                ->where([
//                                            'b.no_acak' => $no_acak_referensi,
//                                            'b.id_ref_barang' => $valJual['id_ref_barang']
//                                        ]);
//                                        if ($dataItemPasok->exists()) {  //cek apakah pasok yang merekrot pemilik item
//                                            $kondisi = true;
//                                            $itemPasok = 'Y';
//                                        //    $levelpasok++;
//                                            $ket_sumber = 4;
//                                            $ket_agen = "21"; //"21:Pasok Rekrot Pasok Pemilik Item" 
//                                            $dataAgenPasokItem = $dataItemPasok->one();
//                                            $dataAnggotaAgen[] = [
//                                                'no_acak' => $dataAgenPasokItem['no_acak'],
//                                                'id_data_agen' => $dataAgenPasokItem['id'],
//                                                'id_ref_agen' => $dataAgenPasokItem['id_ref_agen'],
//                                                'level' => 1,
//                                                'itemPasok' => $itemPasok,
//                                                'ket_sumber' => $ket_sumber
//                                            ];
//                                            $kode_anggota[] = $ket_agen;
//                                        } else {
//                                         
//                                            //  return var_dump($level)
//                                            if ($level == '1') {
//                                                   $ket_agen = '2'; //2:Hanya pasok rekrot bukan pemilik item
//
//                                            $kode_anggota[] = $ket_agen;
//                                                $dataAnggotaAgen[] = [
//                                                    'no_acak' => $dataAgenPasok['no_acak'],
//                                                    'id_data_agen' => $dataAgenPasok['id'],
//                                                    'id_ref_agen' => $dataAgenPasok['id_ref_agen'],
//                                                    'level' => $level,
//                                                    'itemPasok' => $itemPasok,
//                                                    'ket_sumber' => $ket_sumber,
//                                                        //       'ket_agen'=>$ket_agen
//                                                ];
//                                                //     return var_dump($dataAnggotaAgen);
//                                            }
//                                            if ($levelpasok == '1') {
//                                                $dataItemBelanja = (new \yii\db\Query())
//                                                        ->select('a.item_barang,b.no_acak,c.id,c.id_ref_agen,c.nama_agen,c.id_agen')
//                                                        ->from('data_barang a')
//                                                        ->innerJoin('data_item_barang_agen b', 'a.id_ref_barang=b.id_ref_barang')
//                                                        ->innerJoin('data_agen c', 'b.no_acak=c.no_acak')
//                                                        ->where([
//                                                    'c.no_acak_ref' => $no_acak_user,
//                                                    'b.id_ref_barang' => $valJual['id_ref_barang']
//                                                ]);
//                                                if ($dataItemBelanja->exists()) {
//                                                    $kondisi = true;
//                                                    $ket_sumber = 4;
//                                                    $itemPasok = 'Y';
//                                                    $dataAgenPasokItem = $dataItemBelanja->one();
//                                                    $dataAnggotaAgen[] = [
//                                                        'no_acak' => $dataAgenPasokItem['no_acak'],
//                                                        'id_data_agen' => $dataAgenPasokItem['id'],
//                                                        'id_ref_agen' => $dataAgenPasokItem['id_ref_agen'],
//                                                        'level' => 1,
//                                                        'itemPasok' => $itemPasok,
//                                                        'ket_sumber' => $ket_sumber
//                                                    ];
//                                                    $ket_agen = '12';
//                                                    $kode_anggota[] = $ket_agen;
//                                                }
//                                            }
//                                        }
//                                        $no_acak_referensi = $dataAgenPasok['no_acak_ref'];
//                                    } else {
//                                        if ($no_acak_promo != $no_acak_referensi) {
//                                            $no_acak_referensi = $no_acak_promo;
//                                        }
//                                        $dataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak_referensi, 'id_ref_agen' => '1']); //agen promo
//                                        $dataAgenPromo = $dataAgen->one();
//                                        $ket_agen = '1';
//
//                                        $dataAnggotaAgen[] = [
//                                            'no_acak' => $dataAgenPromo['no_acak'],
//                                            'id_data_agen' => $dataAgenPromo['id'],
//                                            'id_ref_agen' => $dataAgenPromo['id_ref_agen'],
//                                            'level' => $level, //artinya direkut  BP langsung
//                                            'itemPasok' => $itemPasok,
//                                            'ket_sumber' => $ket_sumber,
//                                                // 'ket_agen'=>'1', //Promo
//                                        ];
//                                        $kode_anggota[] = $ket_agen;
//                                        $tingkat = 11;
//
//                                        $dataAnggotaAgenPromo = [
//                                            'no_acak' => $dataAgenPromo['no_acak'],
//                                            'id_data_agen' => $dataAgenPromo['id'],
//                                            'id_ref_agen' => $dataAgenPromo['id_ref_agen'],
//                                            'level' => $level, //artinya direkut  BP langsung
//                                            'itemPasok' => $itemPasok,
//                                            'ket_sumber' => $ket_sumber,
//                                                // 'ket_agen'=>'1', //Promo
//                                        ];
//                                        ;
//                                    }
//                                }
//
//                                // 
//                                // if($dataAgen['id_ref_agen']=='3'){ //1 tingkat niaga
//                                //     $no_acak_referensi = $dataAgen['no_acak_ref'];
//                                // }
//                            } else {
//                                $dataAnggotaAgenPromo = '';
//                                if ($no_acak_promo != $no_acak_referensi) {
//                                    $no_acak_referensi = $no_acak_promo;
//                                }
//                                $dataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak_referensi, 'id_ref_agen' => '1']); //agen promo
//                                $dataAgenPromo = $dataAgen->one();
//                                $ket_agen = '1'; //ini pasti promo
//
//                                $dataAnggotaAgen[] = [
//                                    'no_acak' => $dataAgenPromo['no_acak'],
//                                    'id_data_agen' => $dataAgenPromo['id'],
//                                    'id_ref_agen' => $dataAgenPromo['id_ref_agen'],
//                                    'level' => $level, //artinya direkut  BP langsung
//                                    'itemPasok' => $itemPasok,
//                                    'ket_sumber' => $ket_sumber,
//                                        // 'ket_agen'=>'1', //Promo
//                                ];
//
//
//                                $dataAnggotaAgenPromo = [
//                                    'no_acak' => $dataAgenPromo['no_acak'],
//                                    'id_data_agen' => $dataAgenPromo['id'],
//                                    'id_ref_agen' => $dataAgenPromo['id_ref_agen'],
//                                    'level' => $level, //artinya direkut  BP langsung
//                                    'itemPasok' => $itemPasok,
//                                    'ket_sumber' => $ket_sumber,
//                                        // 'ket_agen'=>'1', //Promo
//                                ];
//
//                                $kode_anggota[] = $ket_agen;
//                                $tingkat = 11;
//                                if ($level == 0) {
//                                    $dataItemBelanja = (new \yii\db\Query())
//                                            ->select('a.item_barang,b.no_acak,c.id,c.id_ref_agen,c.nama_agen,c.id_agen')
//                                            ->from('data_barang a')
//                                            ->innerJoin('data_item_barang_agen b', 'a.id_ref_barang=b.id_ref_barang')
//                                            ->innerJoin('data_agen c', 'b.no_acak=c.no_acak')
//                                            ->where([
//                                        'c.no_acak_ref' => $no_acak_user,
//                                        'b.id_ref_barang' => $valJual['id_ref_barang']
//                                    ]);
//                                    if ($dataItemBelanja->exists()) {
//                                        $kondisi = true;
//                                        $ket_sumber = 4;
//                                        $itemPasok = 'Y';
//                                        $dataAgenPasokItem = $dataItemBelanja->one();
//                                        $dataAnggotaAgen[] = [
//                                            'no_acak' => $dataAgenPasokItem['no_acak'],
//                                            'id_data_agen' => $dataAgenPasokItem['id'],
//                                            'id_ref_agen' => $dataAgenPasokItem['id_ref_agen'],
//                                            'level' => 1,
//                                            'itemPasok' => $itemPasok,
//                                            'ket_sumber' => $ket_sumber
//                                        ];
//                                        $ket_agen = '12';
//                                        $kode_anggota[] = $ket_agen;
//                                    }
//                                }
//                            }
//                        }
//                    }
//         
//                }
//
//              
$dataReturn = KondisiBagiHasil::kondisiBagiHasil($no_acak_pembeli,$no_acak_user,$valJual);
$kode_anggota = $dataReturn['kode_anggota'];
$dataAnggotaAgen = $dataReturn['dataAnggotaAgen'];
                }
                $kondisi = implode(',', $kode_anggota);
                $html = '';
                switch ($kondisi) {
                    case in_array($kondisi, ['99,1']): //hanya promo dan pasok rekrut
                        $kali3promobp = true;
                        //agen bp
                        $dataAnggotaAgen[] = [
                            'no_acak' => Yii::$app->user->identity->no_acak,
                            'id_data_agen' => Yii::$app->user->identity->id_agen,
                            'id_ref_agen' => 3, //18%
                            'level' => 99, //artinya direkut sesama BP langsung
                            'itemPasok' => 'N',
                            'ket_sumber' => $ket_sumber,
                                //      'ket_agen' => "99" //BP
                        ];
                        $dataAnggotaAgen[] = [
                            'no_acak' => Yii::$app->user->identity->no_acak,
                            'id_data_agen' => Yii::$app->user->identity->id_agen,
                            'id_ref_agen' => 6, //7%
                            'level' => 99, //artinya direkut sesama BP langsung
                            'itemPasok' => 'N',
                            'ket_sumber' => $ket_sumber,
                                //      'ket_agen' => "99" //BP
                        ];
                        $dataAnggotaAgen[] = [
                            'no_acak' => Yii::$app->user->identity->no_acak,
                            'id_data_agen' => Yii::$app->user->identity->id_agen,
                            'id_ref_agen' => Yii::$app->user->identity->id_ref_agen,
                            'level' => 99, //artinya direkut sesama BP langsung
                            'itemPasok' => 'N',
                            'ket_sumber' => $ket_sumber,
                                //      'ket_agen' => "99" //BP
                        ];
                        //agen promo
                        //    $dataAnggotaAgen[] = $dataAnggotaAgenPromo;
                        break;
                    case in_array($kondisi, ['99,3,1']): //direkrot niaga,direkrot pasok, tidak memiliki item,25,18,25,25+25
                        $kali2bp = true;
                        $kali2promobp = true;
                        //agen bp
                        $dataAnggotaAgen[] = [
                            'no_acak' => Yii::$app->user->identity->no_acak,
                            'id_data_agen' => Yii::$app->user->identity->id_agen,
                            'id_ref_agen' => Yii::$app->user->identity->id_ref_agen,
                            'level' => 99, //artinya direkut sesama BP langsung
                            'itemPasok' => 'N',
                            'ket_sumber' => $ket_sumber,
                                //      'ket_agen' => "99" //BP
                        ];

//        $dataAnggotaAgen[] = [
//                            'no_acak' => Yii::$app->user->identity->no_acak,
//                            'id_data_agen' => Yii::$app->user->identity->id_agen,
//                            'id_ref_agen' => 3,
//                            'level' => 99, //artinya direkut sesama BP langsung
//                            'itemPasok' => 'N',
//                            'ket_sumber' => $ket_sumber,
//                                //      'ket_agen' => "99" //BP
//                        ];
                        $dataAnggotaAgen[] = [
                            'no_acak' => Yii::$app->user->identity->no_acak,
                            'id_data_agen' => Yii::$app->user->identity->id_agen,
                            'id_ref_agen' => 6,
                            'level' => 99, //artinya direkut sesama BP langsung
                            'itemPasok' => 'N',
                            'ket_sumber' => $ket_sumber,
                                //      'ket_agen' => "99" //BP
                        ];
                        break;
                    case in_array($kondisi, ['99,3,12,1']): //direkrot niaga, rekrto pasok tidak memilik item tp item milik pasok lain,25,18,25,25+7
                        $kali2bp = true;
                        $kali2promobp = true;
                        //agen bp
                        $dataAnggotaAgen[] = [
                            'no_acak' => Yii::$app->user->identity->no_acak,
                            'id_data_agen' => Yii::$app->user->identity->id_agen,
                            'id_ref_agen' => 6,
                            'level' => 99, //artinya direkut sesama BP langsung
                            'itemPasok' => 'N',
                            'ket_sumber' => $ket_sumber,
                                //      'ket_agen' => "99" //BP
                        ];
                        break;
                    case in_array($kondisi, ['99,21,1']): //pasok rekrot tp memiliki item,
                        $kali2bp = true;
                        $kali2promobp = true;
                        //agen bp
                        $dataAnggotaAgen[] = [
                            'no_acak' => Yii::$app->user->identity->no_acak,
                            'id_data_agen' => Yii::$app->user->identity->id_agen,
                            'id_ref_agen' => Yii::$app->user->identity->id_ref_agen,
                            'level' => 99, //artinya direkut sesama BP langsung
                            'itemPasok' => 'N',
                            'ket_sumber' => $ket_sumber,
                                //      'ket_agen' => "99" //BP
                        ];

                        break;
                    case in_array($kondisi, ['99,3,21,1']): //pasok rekrot ada memiliki item,
                        $kali2bp = true;
                        $kali2promobp = true;
                        //agen bp
                        $dataAnggotaAgen[] = [
                            'no_acak' => Yii::$app->user->identity->no_acak,
                            'id_data_agen' => Yii::$app->user->identity->id_agen,
                            'id_ref_agen' => 6,
                            'level' => 99, //artinya direkut sesama BP langsung
                            'itemPasok' => 'N',
                            'ket_sumber' => $ket_sumber,
                                //      'ket_agen' => "99" //BP
                        ];

                        break;
                    case in_array($kondisi, ['99,1,12']): //pasok langusng rektoy promo,tp item milik pasok lainnya
                        //agen bp
                        $dataAnggotaAgen[] = [
                            'no_acak' => Yii::$app->user->identity->no_acak,
                            'id_data_agen' => Yii::$app->user->identity->id_agen,
                            'id_ref_agen' => Yii::$app->user->identity->id_ref_agen,
                            'level' => 99, //artinya direkut sesama BP langsung
                            'itemPasok' => 'N',
                            'ket_sumber' => $ket_sumber,
                                //      'ket_agen' => "99" //BP
                        ];
                        break;
                    case in_array($kondisi, ['99,2,1']): //pasok rekrot,item tidak ada pemiliknya
                        $kali2bp = true;
                        $kali2promobp = true;
                        //agen bp
                        $dataAnggotaAgen[] = [
                            'no_acak' => Yii::$app->user->identity->no_acak,
                            'id_data_agen' => Yii::$app->user->identity->id_agen,
                            'id_ref_agen' => Yii::$app->user->identity->id_ref_agen,
                            'level' => 99, //artinya direkut sesama BP langsung
                            'itemPasok' => 'N',
                            'ket_sumber' => $ket_sumber,
                                //      'ket_agen' => "99" //BP
                        ];
                          $dataAnggotaAgen[] = [
                            'no_acak' => Yii::$app->user->identity->no_acak,
                            'id_data_agen' => Yii::$app->user->identity->id_agen,
                            'id_ref_agen' => 6,
                            'level' => 99, //artinya direkut sesama BP langsung
                            'itemPasok' => 'N',
                            'ket_sumber' => $ket_sumber,
                                //      'ket_agen' => "99" //BP
                        ];
                        break;

                    case in_array($kondisi, ['99,2']): //promo, rekrot promo
                        $kali2bp = true;
                        $kali2promobp = true;
                        $dataAnggotaAgen[] = [
                            'no_acak' => Yii::$app->user->identity->no_acak,
                            'id_data_agen' => Yii::$app->user->identity->id_agen,
                            'id_ref_agen' => 3,
                            'level' => 99, //artinya direkut sesama BP langsung
                            'itemPasok' => 'N',
                            'ket_sumber' => $ket_sumber,
                                //      'ket_agen' => "99" //BP
                        ];
                        $dataAnggotaAgen[] = [
                            'no_acak' => Yii::$app->user->identity->no_acak,
                            'id_data_agen' => Yii::$app->user->identity->id_agen,
                            'id_ref_agen' => 6,
                            'level' => 99, //artinya direkut sesama BP langsung
                            'itemPasok' => 'N',
                            'ket_sumber' => $ket_sumber,
                                //      'ket_agen' => "99" //BP
                        ];
                        $dataAnggotaAgen[] = [
                            'no_acak' => Yii::$app->user->identity->no_acak,
                            'id_data_agen' => Yii::$app->user->identity->id_agen,
                            'id_ref_agen' => Yii::$app->user->identity->id_ref_agen,
                            'level' => 99, //artinya direkut sesama BP langsung
                            'itemPasok' => 'N',
                            'ket_sumber' => $ket_sumber,
                                //      'ket_agen' => "99" //BP
                        ];
                        break;
                    case in_array($kondisi, ['99,2,12']): //promo, item ada pemilik pasok
                        $kali2bp = true;
                        $kali2promobp = true;
                        //agen bp
                        $dataAnggotaAgen[] = [
                            'no_acak' => Yii::$app->user->identity->no_acak,
                            'id_data_agen' => Yii::$app->user->identity->id_agen,
                            'id_ref_agen' => Yii::$app->user->identity->id_ref_agen,
                            'level' => 99, //artinya direkut sesama BP langsung
                            'itemPasok' => 'N',
                            'ket_sumber' => $ket_sumber,
                                //      'ket_agen' => "99" //BP
                        ];
                        break;
                    
                }
                
                foreach ($dataAnggotaAgen as $valAnggota) {
                    //        echo '<script> console.log(' . $valAnggota['id_ref_agen'] . ')</script>';
                    $atur_bagi_hasil_jual_agen = \backend\models\AturBagiHasilJual::find()->where(['id_ref_agen' => $valAnggota['id_ref_agen']])->orderBy('id_ref_agen')->all();
                    foreach ($atur_bagi_hasil_jual_agen as $valAturPromo) {

                        $transaksiKomisi = new \backend\models\TransaksiKomisi();
                        $transaksiKomisi->no_acak_pemberi = $no_acak_pembeli; //$valAnggota['no_acak'];
                        $transaksiKomisi->no_acak = $no_acak_tutup_buku;
                        $transaksiKomisi->no_acak_penerima = $valAnggota['no_acak'];
                        $transaksiKomisi->tgl_masuk = date('Y-m-d');
                        $transaksiKomisi->id_data_agen = $valAnggota['id_data_agen'];
                        $transaksiKomisi->id_data_barang = $valJual['id_data_barang'];
                        $transaksiKomisi->id_ref_barang = $valJual['id_ref_barang'];

                        $transaksiKomisi->jumlah = $valJual['margin_item'] * $valJual['qty_out'];
                        $harga_jual = $valJual['margin_item'] + $valJual['harga_satuan'];

                        $total_jual = $valJual['qty_out'] * $harga_jual;
                        $hasil = ($valJual['margin_item'] * $valJual['qty_out']) * ($valAturPromo['nilai'] / 100);
                        $transaksiKomisi->nilai_bagi = $valAturPromo['nilai'] / 100;

                        $transaksiKomisi->nominal = $hasil;
                        $transaksiKomisi->ket = $ket_sumber;
                        $transaksiKomisi->tahun = date('Y');

                        $transaksiKomisi->save(false);
                        ///insert data komisi
                        $modelKomisiAgen = \backend\models\DataKomisi::find()->where(['no_acak' => $valAnggota['no_acak']]);
                        $nominalOld = 0;
                        if ($modelKomisiAgen->exists()) {
                            $modelKomisi = $modelKomisiAgen->one();
                            $nominalOld = $modelKomisi['nominal'];
                        } else {
                            $modelKomisi = new \backend\models\DataKomisi();
                        }
                        $modelKomisi->nominal = $hasil + $nominalOld;
                        $modelKomisi->no_acak = $valAnggota['no_acak'];
                        $modelKomisi->id_data_agen = $valAnggota['id_data_agen'];
                        $modelKomisi->ket = $ket_sumber;
                        $modelKomisi->tgl_transaksi = date('Y-m-d');
                        $modelKomisi->save(false);

                        $no_acak = \backend\models\QueryModel::noacak();
                        $modelBagiHasil = new DataBagiHasil();
                        $modelBagiHasil->isNewRecord = true;
                        $modelBagiHasil->id = null;
                        $modelBagiHasil->no_acak = $no_acak;
                        $modelBagiHasil->no_acak_user = $valAnggota['no_acak'];
                        $modelBagiHasil->no_acak_tutup_buku = $no_acak_tutup_buku;
                        $modelBagiHasil->id_data_barang = $valJual['id_data_barang'];
                        $modelBagiHasil->id_ref_barang = $valJual['id_ref_barang'];
                        $modelBagiHasil->tgl_masuk = date('Y-m-d');
                        $modelBagiHasil->id_ref_agen = $valAnggota['id_ref_agen'];
                        $nilai = $valAturPromo['nilai'] / 100;
                        $modelBagiHasil->persen = $valAturPromo['nilai'];
                        $hasil = $valJual['margin_item'] * $valJual['qty_out'] * $nilai;
                        $modelBagiHasil->jumlah = $valJual['margin_item'] * $valJual['qty_out'];
                        $modelBagiHasil->hasil = $hasil;
                        //   if ($hasil != 0) {
                        $modelBagiHasil->save(false);
                    }
                }
            }
            $model->save();
            Yii::$app->session->setFlash('success', 'Data berhasil');
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderAjax('_form', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing DataBagiHasil model.
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

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DataBagiHasil model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteNoTutupBuku($no_acak_tutup_buku) {
        DataBagiHasil::deleteAll(['no_acak_tutup_buku' => $no_acak_tutup_buku]);
        \backend\models\TransaksiKomisi::deleteAll(['no_acak' => $no_acak_tutup_buku]);
        Yii::$app->session->setFlash('success', 'Data Terhapus');
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDeleteLaporan($no_acak_tutup_buku) {
        \backend\models\TutupBuku::find()->where(['no_acak' => $no_acak_tutup_buku])->one()->delete();
        Yii::$app->session->setFlash('success', 'Data Terhapus');
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the DataBagiHasil model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DataBagiHasil the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = DataBagiHasil::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPreviewLapBagiHasil($no_acak) {
        //$query = DataBagiHasil::find()->where(['no_acak'=>$no_acak])->all();
        $sql = "SELECT b.id,a.id_ref_agen,
max(if(a.id_ref_agen='1',a.hasil,0)) hasil1,
max(if(a.id_ref_agen='2',a.hasil,0)) hasil2,
max(if(a.id_ref_agen='3',a.hasil,0)) hasil3,
max(if(a.id_ref_agen='4',a.hasil,0)) hasil4,
max(if(a.id_ref_agen='5',a.hasil,0)) hasil5,
max(if(a.id_ref_agen='6',a.hasil,0)) hasil6
 FROM data_bagi_hasil a 
 INNER JOIN ref_barang b ON a.id_ref_barang=b.id
 WHERE a.no_acak_tutup_buku=:no_acak GROUP BY a.id_ref_barang";
        $params = [
            ':no_acak' => $no_acak
        ];
        $query = Yii::$app->db->createCommand($sql, $params)->queryAll();

        $sql = "SELECT a.id_ref_agen,
max(if(a.id_ref_agen='1',a.nilai,0)) nilai1,
max(if(a.id_ref_agen='2',a.nilai,0)) nilai2,
max(if(a.id_ref_agen='3',a.nilai,0)) nilai3,
max(if(a.id_ref_agen='4',a.nilai,0)) nilai4,
max(if(a.id_ref_agen='5',a.nilai,0)) nilai5,
max(if(a.id_ref_agen='6',a.nilai,0)) nilai6
 FROM atur_bagi_hasil_jual a ";
        $queryAtur = Yii::$app->db->createCommand($sql)->queryAll();

        return $this->render('preview-lap-bagi-hasil', [
                    'query' => $query,
                    'queryAtur' => $queryAtur,
                    'no_acak' => $no_acak
        ]);
    }

    public function actionPrintLapBagiHasil($no_acak, $export) {
        //$query = DataBagiHasil::find()->where(['no_acak'=>$no_acak])->all();
        $sql = "SELECT b.id,a.id_ref_agen,
max(if(a.id_ref_agen='1',a.hasil,0)) hasil1,
max(if(a.id_ref_agen='2',a.hasil,0)) hasil2,
max(if(a.id_ref_agen='3',a.hasil,0)) hasil3,
max(if(a.id_ref_agen='4',a.hasil,0)) hasil4,
max(if(a.id_ref_agen='5',a.hasil,0)) hasil5,
max(if(a.id_ref_agen='6',a.hasil,0)) hasil6
 FROM data_bagi_hasil a 
 INNER JOIN ref_barang b ON a.id_ref_barang=b.id
 WHERE a.no_acak_tutup_buku=:no_acak GROUP BY a.id_ref_barang";
        $params = [
            ':no_acak' => $no_acak
        ];
        $query = Yii::$app->db->createCommand($sql, $params)->queryAll();

        $sql = "SELECT a.id_ref_agen,
max(if(a.id_ref_agen='1',a.nilai,0)) nilai1,
max(if(a.id_ref_agen='2',a.nilai,0)) nilai2,
max(if(a.id_ref_agen='3',a.nilai,0)) nilai3,
max(if(a.id_ref_agen='4',a.nilai,0)) nilai4,
max(if(a.id_ref_agen='5',a.nilai,0)) nilai5,
max(if(a.id_ref_agen='6',a.nilai,0)) nilai6
 FROM atur_bagi_hasil_jual a ";
        $queryAtur = Yii::$app->db->createCommand($sql)->queryAll();

        $content = $this->renderPartial('print-lap-bagi-hasil', [
            'query' => $query,
            'queryAtur' => $queryAtur,
            'no_acak' => $no_acak
        ]);
        $filename = $no_acak;
        if ($export == 'pdf') {
            $pdf = new Pdf();
            $mpdf = $pdf->api;
            $mpdf->SetHeader(date("Y-m-d"));
            $mpdf->WriteHtml($content);
            return $mpdf->Output($filename . '.pdf', 'I');
        } elseif ($export == 'xls') {
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=$filename.xls");
            return $content;
        }
    }

}
