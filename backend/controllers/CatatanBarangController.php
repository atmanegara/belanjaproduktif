<?php

namespace backend\controllers;

use Yii;
use backend\models\CatatanBarang;
use backend\models\CatatanBarangSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\RefBarangSearch;
use backend\models\CatatanBarangAgen;
use backend\models\TransaksiBarang;
use backend\models\DataBarang;
use backend\models\AturMarginItem;
use backend\models\StokBarang;

/**
 * CatatanBarangController implements the CRUD actions for CatatanBarang model.
 */
class CatatanBarangController extends Controller {

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
     * Lists all CatatanBarang models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new CatatanBarangSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);



        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexAgen() {
        $no_acak = Yii::$app->user->identity->no_acak;
        $dataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak])->one();
        $id_data_agen = $dataAgen['id'];
        //cek toko
        $dataToko = \backend\models\DataToko::find()->where(['id_data_agen'=>$id_data_agen])->exists();
        if(!$dataToko){
           return $this->render('cek-toko');
        }
//        $searchModel = new CatatanBarangSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams); 
//$dataProvider->query->where(['id_data_agen'=>$id_data_agen]);

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => CatatanBarang::getDataGridviewCatatanBarang($id_data_agen)
        ]);
   //       return $this->render('cek-toko');
        return $this->render('index-agen', [
//                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CatatanBarang model.
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
     * Creates a new CatatanBarang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $modelAgen = \backend\models\DataAgen::dropdownagenOrder([1,7]);
        $model = new CatatanBarangAgen();

//     $searchModel = new RefBarangSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//        

        if ($model->load(Yii::$app->request->post())) {
            $no_acak = \backend\models\QueryModel::noacak();
            $model->no_acak = $no_acak;
            $model->save(false);
            return $this->redirect(['entry-data', 'no_acak' => $no_acak]);
        }

        return $this->renderAjax('_form', [
                    'model' => $model,
                    'modelAgen' => $modelAgen,
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionEntryData($no_acak) {
        $query = CatatanBarangAgen::find()->where(['no_acak' => $no_acak])->one();
        $searchModel = new RefBarangSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //list pesanan agen promo
           $dterima = CatatanBarangAgen::getStatusTerimaBarang($no_acak);

        $dataProviderListPesanan = new \yii\data\ActiveDataProvider([
            'query' => CatatanBarang::find()->where(['no_acak' => $no_acak])
        ]);
        
        return $this->render('entry-data', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'query' => $query,
            'dataProviderListPesanan'=>$dataProviderListPesanan
//                    'no_acak' => $query['no_acak'],
//                    'id_data_agen' => $query['id_data_agen'],
//                    'tgl_pemesanan' => $query['tgl_pemesanan'],
        ]);
    }

    public function actionAddItems($id, $no_acak) {

        $query = CatatanBarangAgen::find()->where(['no_acak' => $no_acak])->one();
        $dataAgen = \backend\models\DataAgen::find()->where(['id' => $query['id_data_agen']])->one();
        $querbarang = \backend\models\RefBarang::find()->where(['id' => $id])->one();
$marginItem = AturMarginItem::find()->where(['id_ref_barang'=>$id])->one();
        $modelSuplier = \backend\models\RefSuplier::getDropdownlist();
        $modelSatuan = \backend\models\RefSatuanBarang::getdropdownlist();
        $dataCatatanBarang = CatatanBarang::find()->where([
            'no_acak'=>$no_acak,'id_ref_barang'=>$id
        ]);
        $qtyLama=0;
        if($dataCatatanBarang->exists()){
            $model = $dataCatatanBarang->one();
            $qtyLama = $model->qty;
        }else{
        $model = new CatatanBarang();
        }
        $model->harga_satuan = $marginItem['harga_satuan'];
        $model->no_acak = $no_acak;
        $model->id_data_agen = $query['id_data_agen'];
        $model->tgl_pemesanan = $query['tgl_pemesanan'];
        $model->id_ref_barang = $querbarang['id'];

        if ($model->load(Yii::$app->request->post())) {
             $model->qty =  $model->qty+$qtyLama;
            if ($model->save()) {
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return \kartik\form\ActiveForm::validate($model);
            }
        }


        return $this->renderAjax('_form_add_items', [
                    'model' => $model,
                    'querbarang' => $querbarang,
                    'dataAgen' => $dataAgen,
                    'modelSuplier' => $modelSuplier,
                    'modelSatuan' => $modelSatuan,
        ]);
    }

    public function actionListPesananBarang($no_acak) {
        $dterima = CatatanBarangAgen::getStatusTerimaBarang($no_acak);

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => CatatanBarang::find()->where(['no_acak' => $no_acak])
        ]);
        return $this->render('list-pesanan-barang', [
                    'dataProvider' => $dataProvider,
                    'no_acak' => $no_acak,
                    'dterima' => $dterima
        ]);
    }
    public function actionListPesananBarangAgen($no_acak) {
        $dterima = CatatanBarangAgen::getStatusTerimaBarang($no_acak);

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => CatatanBarang::find()->where(['no_acak' => $no_acak])
        ]);
        return $this->renderAjax('list-pesanan-barang-agen', [
                    'dataProvider' => $dataProvider,
                    'no_acak' => $no_acak,
                    'dterima' => $dterima
        ]);
    }
    
    public function actionListBarangAgen($no_acak) {
        $dterima = CatatanBarangAgen::getStatusTerimaBarang($no_acak);

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => CatatanBarang::find()->where(['no_acak' => $no_acak])
        ]);
        return $this->render('list-barang-agen', [
                    'dataProvider' => $dataProvider,
                    'no_acak' => $no_acak,
                    'dterima' => $dterima
        ]);
    }
    
//    public function actionPrintData($no_acak) {
//        $dterima = CatatanBarangAgen::getStatusTerimaBarang($no_acak);
//
//        $dataProvider = new \yii\data\ActiveDataProvider([
//            'query' => CatatanBarang::find()->where(['no_acak' => $no_acak])
//        ]);
//        $content = $this->renderPartial('print-data', [
//                    'dataProvider' => $dataProvider,
//                    'no_acak' => $no_acak,
//                    'dterima' => $dterima
//        ]);
//    }
    public function actionPrintListPesanan($no_acak,$export) {
//         $dterima =CatatanBarangAgen::getStatusTerimaBarang($no_acak);
//        
//        $dataProvider = new \yii\data\ActiveDataProvider([
//            'query'=> CatatanBarang::find()->where(['no_acak'=>$no_acak])
//        ]);

        $query = \backend\models\DataAgen::find()
                ->leftJoin('catatan_barang', 'data_agen.id=catatan_barang.id_data_agen')
                ->leftJoin('catatan_barang_agen','catatan_barang_agen.id_data_agen=catatan_barang.id_data_agen and catatan_barang_agen.no_acak=catatan_barang.no_acak')
                ->where(['like', 'catatan_barang.no_acak', $no_acak])->groupBy('data_agen.no_acak')->all();
        $content = $this->renderPartial('print-list-pesanan', [
            'query' => $query,
            'no_acak' => $no_acak,
                //   'dterima'=>$dterima
        ]);
        $filename = $no_acak;
        
        
     if($export=='pdf'){
Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
Yii::$app->response->headers->add('Content-Type', 'application/pdf');        
             $pdf = new \kartik\mpdf\Pdf();
            $mpdf = $pdf->api;
            $mpdf->WriteHtml($content);
            return   $mpdf->Output($filename. '.pdf', 'I');
        }elseif($export=='xls'){
            
            header("Content-type: application/vnd.ms-excel");
            header('Content-Disposition: attachment; filename="' . $filename . '.xls"');
            return $content;
        }
        
//        $pdf = new \kartik\mpdf\Pdf();
//        $mpdf = $pdf->api;
//        $mpdf->WriteHtml($content);
//        return $mpdf->Output($filename, 'I');
    }

    /**
     * Updates an existing CatatanBarang model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        $modelSuplier = \backend\models\RefSuplier::getDropdownlist();
        $querbarang = \backend\models\RefBarang::find()->where(['id' => $model['id_ref_barang']])->one();

        $modelSatuan = \backend\models\RefSatuanBarang::getdropdownlist();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success','Berhasil di update');
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderAjax('update', [
                    'model' => $model,
            'modelSuplier'=>$modelSuplier,
            'modelSatuan'=>$modelSatuan,'querbarang'=>$querbarang
        ]);
    }

    /**
     * Deletes an existing CatatanBarang model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

            Yii::$app->session->setFlash('success','Berhasil di update');
            return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the CatatanBarang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CatatanBarang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = CatatanBarang::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSelesaiBarang($no_acak) {
        $model = CatatanBarangAgen::find()->where(['no_acak' => $no_acak])->one();

        $model->selesai = 'Y';
        $model->save(false);

        return $this->redirect(['index']);
    }

    public function actionDiterima($no_acak) {
        $model = CatatanBarangAgen::find()->where(['no_acak' => $no_acak])->one();

        $model->diterima = 'Y';
        if ($model->save()) {


            $catatanbarang = CatatanBarang::getDatabarangAll($no_acak); //find()->where(['no_acak'=>$no_acak])->all();
            foreach ($catatanbarang as $valbarang) {
                $id_ref_barang = $valbarang['id_ref_barang'];
                $id_ref_satuan = $valbarang['id_ref_satuan'];
                $margin = AturMarginItem::find()->where(['id_ref_barang' => $id_ref_barang])->one();

                $persen_margin = ($margin['nilai'] / 100);
                $qty = $valbarang['qty'];
                $id_data_agen = $valbarang['id_data_agen'];
                $barkode = $valbarang['kode'];
                $nama_item = $valbarang['nama_barang'];
                $harga_satuan = $valbarang['harga_satuan'];
                $margin_item = $harga_satuan * $persen_margin;
                $harga_jual = $margin_item + $harga_satuan;
                $refBarang = \backend\models\RefBarang::findOne($id_ref_barang);
                $cekDataBarang = \backend\models\DataBarang::find()->where(['id_ref_barang' => $id_ref_barang, 'id_data_agen' => $id_data_agen]);
                if ($cekDataBarang->exists()) {
                    
                    $dataBarang = $cekDataBarang->one();
                    $id_data_barang = $dataBarang['id'];
                    if($dataBarang['aktif']=='N'){
                        continue;
                    }
                } else {
                    $modelBarang = new DataBarang();
                    $modelBarang->filename = $refBarang['filename'];
                    $modelBarang->id_data_agen = $id_data_agen;
                    $modelBarang->id_ref_barang = $id_ref_barang;
                    $modelBarang->item_barang = $nama_item;
                    $modelBarang->id_ref_satuan_barang = $id_ref_satuan;
                    $modelBarang->barkode = $barkode;
                    $modelBarang->harga_satuan = $harga_satuan;
                    $modelBarang->save(false);
                    $id_data_barang = $modelBarang->getPrimaryKey();
                }

                $modelTransaksi = new TransaksiBarang();
   //cek barang ditoko siapa
                $dataToko = \backend\models\DataToko::find()->where(['id_data_agen'=>$id_data_agen])->one();
            
         
                $modelTransaksi->tgl_transaksi = date('Y-m-d');
                $modelTransaksi->id_data_agen = $id_data_agen;
                $modelTransaksi->id_data_barang = $id_data_barang;
                $modelTransaksi->qty = $qty;
                $modelTransaksi->harga_satuan = $harga_satuan;
                $modelTransaksi->id_data_toko=$dataToko['id'];
                //    $margin_item = $harga_satuan * $persen_margin;
                $modelTransaksi->margin_item = 0; //$margin_item;
                $margin_total = 0;
                //     $harga_jual = $margin_item + $harga_satuan;
                $modelTransaksi->margin_total = $margin_total;
                $modelTransaksi->harga_jual = $harga_jual;
                $modelTransaksi->barkode = $barkode;
                $modelTransaksi->keterangan = "IN";
                $modelTransaksi->save(false);
                //      $id_data_barang = $model->getPrimaryKey();
                $modelStokBarang = StokBarang::find()->where(['id_data_barang' => $id_data_barang, 'id_data_agen' => $id_data_agen]);
             $stok_awal=0;
             $stok_sisa=0;
             $stok_awalsekali=0;
                if ($modelStokBarang->exists()) {
                    $stokBarang = $modelStokBarang->one();
                    $stokBarang->harga_jual = $harga_jual;
                    if ($stokBarang->barkode == $barkode) {
                        $stok_awalsekali =  $stokBarang->stok_awal;
                        $stok_awal =$stok_awalsekali+$qty;
                        $stokBarang->stok_awal =$stok_awal;
                        $stok_sisasekali = $stokBarang->stok_sisa;
                        $stok_sisa = $stok_sisasekali+$qty; 
                        $stokBarang->stok_sisa = $stok_sisa; //$stokBarang->stok_awal - $stokBarang->stok_akhir;
                    } else {
                        Yii::$app->session->setFlash('danger', 'Kode barcode tidak sama/tidak ditemukan, cek kembali barang / itemnya');
                        return $this->redirect(Yii::$app->request->referrer);
//                       $stokBarang = new StokBarang();
//                       $stokBarang->id_data_barang=$id_data_barang;
//                       $stokBarang->id_data_agen = $id_data_agen;
//                       $stokBarang->barkode = $model->barkode;
//                       $stokBarang->stok_awal+=$model->qty;
//                              $stokBarang->stok_sisa=$stokBarang->stok_awal-$stokBarang->stok_keluar;
                    }
                    $stokBarang->save(false);
                } else {
                    $stokBarang = new StokBarang();
                    $stokBarang->id_data_barang = $id_data_barang;
                    $stokBarang->harga_jual = $harga_jual;
                    $stokBarang->id_data_agen = $id_data_agen;
                    $stokBarang->barkode = $barkode;
                    $stokBarang->stok_awal += $qty;
                    $stok_sisasekali = $stokBarang->stok_sisa;
                    $stok_sisa = $stok_sisasekali+$qty;
                    $stokBarang->stok_sisa = $stok_sisa;//$stokBarang->stok_awal - $stokBarang->stok_akhir;
                    $stokBarang->save(false);
                }
            }
        }

        return $this->redirect(['list-barang-agen', 'no_acak' => $no_acak]);
    }

}
