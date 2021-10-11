<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\db\Query;
use backend\models\CheckoutItem;
use backend\models\DetailPembayaran;
/**
 * Description of BelanjaController
 *
 * @author Administrator
 */
class BelanjaController extends Controller {
    //put your code here
    
    
    public function actionIndex(){
        $this->layout="main-belanja";
        return $this->render('index');
    }
    public function actionCod(){
           $no_acak = Yii::$app->user->identity->no_acak;
      $modelToko = (new Query())
              ->select('a.id id_data_toko')
              ->from('data_toko a')
              ->innerJoin('data_agen b','a.id_data_agen=b.id')
              ->where(['b.no_acak'=>$no_acak])->one();
      
         $dataCheckOutItem = (new Query())
                ->select(['b.no_invoice,sum(b.total) sum_total,b.no_acak,b.tgl_masuk,a.id_status_pembayaran,d.id_metode_pembayaran,c.status_pembayaran,e.status_pesanan_kurir,e.id_data_kurir,e.id as id_detail_kurir'])
                ->from('pembayaran_jualbeli a')
                ->rightJoin('checkout_item b', 'a.no_invoice=b.no_invoice')
              ->innerJoin('data_barang bb','b.id_data_barang=bb.id')
                ->leftJoin('status_pembayaran c', 'a.id_status_pembayaran=c.id')
                ->leftJoin('detail_pembayaran d','b.no_invoice=d.no_invoice')
                ->leftJoin('detail_pembayaran_kurir e','d.no_invoice=e.no_invoice')
                ->groupBy('b.no_invoice')
                ->where(['d.id_metode_pembayaran' => 2,'a.id_status_pembayaran'=>'3','b.id_data_toko'=>$modelToko['id_data_toko']])->orderBy('b.no_invoice,b.tgl_masuk');
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $dataCheckOutItem
        ]);
        
        return $this->render('cod',[
            'dataProvider'=>$dataProvider
        ]);
    }
    
  public function actionPembayaranCod(){
      $no_acak = Yii::$app->user->identity->no_acak;
      $modelToko = (new Query())
              ->select('a.id id_data_toko')
              ->from('data_toko a')
              ->innerJoin('data_agen b','a.id_data_agen=b.id')
              ->where(['b.no_acak'=>$no_acak])->one();
      
        $dataCheckOutItem = (new Query())
                ->select(['b.no_invoice,sum(b.total) sum_total,b.no_acak,b.tgl_masuk,a.id_status_pembayaran,d.id_metode_pembayaran,c.status_pembayaran,e.status_pesanan_kurir,e.id_data_kurir,e.id as id_detail_kurir'])
                ->from('pembayaran_jualbeli a')
                ->rightJoin('checkout_item b', 'a.no_invoice=b.no_invoice')
              ->innerJoin('data_barang bb','b.id_data_barang=bb.id')
                ->leftJoin('status_pembayaran c', 'a.id_status_pembayaran=c.id')
                ->leftJoin('detail_pembayaran d','b.no_invoice=d.no_invoice')
                ->leftJoin('detail_pembayaran_kurir e','d.no_invoice=e.no_invoice')
                ->groupBy('b.no_invoice')
                ->where(['d.id_metode_pembayaran' => 2,'c.id'=>'3','e.status_pesanan_kurir'=>'0','b.id_data_toko'=>$modelToko['id_data_toko']])->orderBy('b.no_invoice,b.tgl_masuk');
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $dataCheckOutItem
        ]);
        
        return $this->render('pembayaran-cod',[
            'dataProvider'=>$dataProvider
        ]);
  }
  
  public function actionListPesanan($id_metode_pembayaran=null){
      $this->layout="main-belanja";
        $no_acak = Yii::$app->user->identity->no_acak;
        $dataCheckOutItem = (new Query())
                ->select(['b.no_invoice,sum(b.total) sum_total,b.tgl_masuk,a.id_status_pembayaran,d.id_metode_pembayaran,c.status_pembayaran'])
                ->from('pembayaran_jualbeli a')
                ->rightJoin('checkout_item b', 'a.no_invoice=b.no_invoice')
              ->innerJoin('data_barang bb','b.id_data_barang=bb.id')
                ->leftJoin('status_pembayaran c', 'a.id_status_pembayaran=c.id')
                ->leftJoin('detail_pembayaran d','b.no_invoice=d.no_invoice')
                ->groupBy('b.no_invoice')
                ->where(['b.no_acak' => $no_acak,'c.id'=>'2']);
        if($id_metode_pembayaran){
        $dataCheckOutItem->andWhere(['d.id_metode_pembayaran'=>$id_metode_pembayaran]);
        }
                $dataCheckOutItem->orderBy('b.no_invoice,b.tgl_masuk');
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $dataCheckOutItem
        ]);
       
        return $this->render('list-pesanan', [
                    'dataProvider' => $dataProvider
        ]);
  }
    public function actionListPesananCod($id_metode_pembayaran=null){
      $this->layout="main-belanja";
        $no_acak = Yii::$app->user->identity->no_acak;
        $dataCheckOutItem = (new Query())
                ->select(['b.no_invoice,sum(b.total) sum_total,b.tgl_masuk,a.id_status_pembayaran,d.id_metode_pembayaran,c.status_pembayaran'])
                ->from('pembayaran_jualbeli a')
                ->rightJoin('checkout_item b', 'a.no_invoice=b.no_invoice')
              ->innerJoin('data_barang bb','b.id_data_barang=bb.id')
                ->leftJoin('status_pembayaran c', 'a.id_status_pembayaran=c.id')
                ->leftJoin('detail_pembayaran d','b.no_invoice=d.no_invoice')
                ->groupBy('b.no_invoice')
                ->where(['b.no_acak' => $no_acak]);
        if($id_metode_pembayaran){
        $dataCheckOutItem->andWhere(['d.id_metode_pembayaran'=>$id_metode_pembayaran]);
        }
                $dataCheckOutItem->orderBy('b.no_invoice,b.tgl_masuk');
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $dataCheckOutItem
        ]);
       
        return $this->render('list-pesanan', [
                    'dataProvider' => $dataProvider
        ]);
  }
  public function actionSearchInvoice($no_invoice){
$modelHistoryBelanja = (new Query())
        ->select('a.no_invoice,a.tgl_masuk tgl_transaksi,b.status_belanja,b.tgljam,d.nama_kurir,d.telp_kurir')
        ->from('checkout_item a')
              ->innerJoin('data_barang bb','a.id_data_barang=bb.id')
        ->leftJoin('history_belanja b','a.no_invoice=b.no_invoice')
        ->leftJoin('detail_pembayaran_kurir c','c.no_invoice=b.no_invoice')
        ->leftJoin('data_kurir d','c.id_data_kurir=d.id')->where(['a.no_invoice'=>$no_invoice])->all();

//      $dataKurir = \backend\models\DetailPembayaranKurir::find()->where(['no_invoice'=>$no_invoice]);
//      if($dataKurir->exists()){
//          $keterangan = "Barang sudah dikemas";
//      }else{
//          $keterangan = "On Proses Pengemasan Barang";
//      }
//      $modelCheckOutItem = \backend\models\CheckoutItem::find()->where(['no_invoice'=>$no_invoice])->all();
      $this->layout='main-belanja';
      return $this->render('search-invoice',[
       //   'keterangan'=>$keterangan,
          'modelHistoryBelanja'=>$modelHistoryBelanja
      ]);
  }
//  public function actionBayar(){
//      $modelDynamic = new \yii\base\DynamicModel(['no_invoce','nominal','filedok']);
//      $modelDynamic->addRule(['no_invoice'],'string');
//      $modelDynamic->addRule(['nominal'],'integer');
//      $modelDynamic->addRule([['filedok'],'file','onSkipEmpty'=>false]);
//      
//      if($modelDynamic->load(Yii::$app->request->post())){
//          $modelTransaksi = new \backend\models\TransaksiBarang();
//          $modelTransaksi
//      }
//  }
  
  public function actionDetailBelanjaSaldo($no_invoice){
      
            $modelTransaksiBarang = \backend\models\TransaksiBarang::find()->where(['no_invoice'=>$no_invoice])->one();
            
      $model = (new Query())
              ->select('c.nama_barang,a.qty,a.harga_jual,a.total_jual')
              ->from('transaksi_barang a')
              ->innerJoin('data_barang b','a.id_data_barang=b.id')
              ->innerJoin('ref_barang c','b.id_ref_barang=c.id')
              ->where(['a.no_invoice'=>$no_invoice]);
      $dataProvider = new \yii\data\ActiveDataProvider([
          'query'=>$model
      ]);
      return $this->renderAjax('detail-belanja-saldo',[
          'dataProvider'=>$dataProvider,
          'modelTransaksiBarang'=>$modelTransaksiBarang
      ]);
  }
  public function actionListBarang($no_invoice){
      $no_acak = Yii::$app->user->identity->no_acak;
      $modelAgen = \backend\models\DataToko::find()->alias('a')
              ->innerJoin('data_agen b','a.id_data_agen=b.id')->where(['b.no_acak'=>$no_acak])->one();
      
      $modelCheckOut = \backend\models\CheckoutItem::find()->where(['no_invoice'=>$no_invoice])->one();
      $dataAgen = \backend\models\DataAgen::find()->where(['no_acak'=>$modelCheckOut['no_acak']])->one();
        $model = (new Query())
              ->select('c.nama_barang,a.qty,a.harga_jual,a.total total_jual')
              ->from('checkout_item a')
              ->innerJoin('data_barang b','a.id_data_barang=b.id')
              ->innerJoin('ref_barang c','b.id_ref_barang=c.id')
              ->where(['a.no_invoice'=>$no_invoice])->all();
        
      $detailPembayaran = DetailPembayaran::find()->where(['no_invoice' => $no_invoice])->one();  
        $content = $this->render('list-barang',[
            'model'=>$model,
            'dataAgen'=>$dataAgen,
            'modelCheckOut'=>$modelCheckOut,
            'modelAgen'=>$modelAgen,
            'no_invoice'=>$no_invoice,
            
            'detailPembayaran'=>$detailPembayaran
        ]);
      return $content;
  }

  public function actionPrintListBarang($no_invoice,$export){
      $no_acak = Yii::$app->user->identity->no_acak;
      $modelAgen = \backend\models\DataToko::find()->alias('a')
              ->innerJoin('data_agen b','a.id_data_agen=b.id')->where(['b.no_acak'=>$no_acak])->one();
      
      $modelCheckOut = \backend\models\CheckoutItem::find()->where(['no_invoice'=>$no_invoice])->one();
      $dataAgen = \backend\models\DataAgen::find()->where(['no_acak'=>$modelCheckOut['no_acak']])->one();
        $model = (new Query())
              ->select('c.nama_barang,a.qty,a.harga_jual,a.total total_jual')
              ->from('checkout_item a')
              ->innerJoin('data_barang b','a.id_data_barang=b.id')
              ->innerJoin('ref_barang c','b.id_ref_barang=c.id')
              ->where(['a.no_invoice'=>$no_invoice])->all();
    
      $detailPembayaran = DetailPembayaran::find()->where(['no_invoice' => $no_invoice])->one();    
        $content = $this->renderPartial('print-list-barang',[
            'model'=>$model,
            'dataAgen'=>$dataAgen,
            'modelCheckOut'=>$modelCheckOut,
            'modelAgen'=>$modelAgen,
            'detailPembayaran'=>$detailPembayaran
        ]);
        $filename = 'daftar-pesanan_'.date('YmdHis');
        if($export=='pdf'){
        $pdf = new \kartik\mpdf\Pdf();
            $mpdf = $pdf->api;
            $mpdf->WriteHtml($content);
            return   $mpdf->Output($filename.'pdf', 'I');
  }else{
       header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$filename.xls");
return $content;
  }
  }
  
  public function actionPrintFaktur($no_invoice){
     ///    $dataItem = CheckoutItem::find()->where(['no_invoice' => $no_invoice])->all();
 $dataItem= (new Query())
              ->select('a.*')
              ->from('checkout_item a')
              ->innerJoin('data_barang b','a.id_data_barang=b.id')
              ->leftJoin('ref_barang c','b.id_ref_barang=c.id')
              ->where(['a.no_invoice'=>$no_invoice])->all();
      $detailPembayaran = DetailPembayaran::find()->where(['no_invoice' => $no_invoice])->one();
         
         $content = $this->renderPartial('faktur',[
             'dataItem'=>$dataItem,
             'detailPembayaran'=>$detailPembayaran
         ]);
       $filename = 'faktur_'.$no_invoice;
        $pdf = new \kartik\mpdf\Pdf();
            $mpdf = $pdf->api;
            $mpdf->WriteHtml($content);
            return   $mpdf->Output($filename, 'I');
  }
  
  public function actionRiwayatCod(){
      $no_acak = Yii::$app->user->identity->no_acak;
 $modelToko = (new Query())
              ->select('a.id id_data_toko')
              ->from('data_toko a')
              ->innerJoin('data_agen b','a.id_data_agen=b.id')
              ->where(['b.no_acak'=>$no_acak])->one();
//          $query = (new Query())
//                  ->select('a.*,b.status_pesanan_kurir')
//                  ->from('detail_pembayaran a')
//                  ->innerJoin('detail_pembayaran_kurir b','a.no_invoice=b.no_invoice')
//                  ->where(['a.no_acak' =>$dataAnggota,'a.id_metode_pembayaran'=>'2','b.status_pesanan_kurir'=>'1
   $query = (new Query())
                ->select(['b.no_invoice,sum(b.total) sum_total,b.no_acak,b.tgl_invoice,b.tgl_masuk,a.id_status_pembayaran,d.id_metode_pembayaran,c.status_pembayaran,e.status_pesanan_kurir,e.id_data_kurir,e.id as id_detail_kurir'])
                ->from('pembayaran_jualbeli a')
                ->rightJoin('checkout_item b', 'a.no_invoice=b.no_invoice')
              ->leftJoin('data_barang bb','b.id_data_barang=bb.id')
                ->leftJoin('status_pembayaran c', 'a.id_status_pembayaran=c.id')
                ->leftJoin('detail_pembayaran d','b.no_invoice=d.no_invoice')
                ->leftJoin('detail_pembayaran_kurir e','d.no_invoice=e.no_invoice')
           ->leftJoin('data_kurir f','e.id_data_kurir=f.id')
                ->groupBy('b.no_invoice')
                ->where(['d.id_metode_pembayaran' => 2,'b.id_data_toko'=>$modelToko['id_data_toko']])->orderBy('b.no_invoice,b.tgl_masuk,e.status_pesanan_kurir');
 
          $dataProvider = new \yii\data\ActiveDataProvider([
              'query'=>$query
          ]);
          return $this->render('riwayat-cod',[
              'dataProvider'=>$dataProvider
          ]);
  }
  
    
  public function actionPrintThermalFaktur($no_invoice){
      $no_acak = Yii::$app->user->identity->no_acak;
      $dataAgen = \backend\models\DataAgen::find()->where(['no_acak'=>$no_acak])->one();
   //      $dataItem =  CheckoutItem::find()->where(['no_invoice' => $no_invoice])->all();
     $dataItem= (new Query())
              ->select('a.*')
              ->from('checkout_item a')
              ->innerJoin('data_barang b','a.id_data_barang=b.id')
              ->leftJoin('ref_barang c','b.id_ref_barang=c.id')
              ->where(['a.no_invoice'=>$no_invoice])->all();
      $detailPembayaran = DetailPembayaran::find()->where(['no_invoice' => $no_invoice])->one();
         $dataTransaksiPembayaran = \backend\models\TransaksiBarang::find()->where(['no_invoice' => $no_invoice])->one();
          $dataToko = \backend\models\DataToko::find()
                 ->innerJoin('data_agen','data_toko.id_data_agen=data_agen.id')
                 ->where(['data_agen.no_acak'=>$no_acak])->one();
         return $this->renderPartial('print-thermal-faktur',[
             'dataItem'=>$dataItem,
             'detailPembayaran'=>$detailPembayaran,
             'dataToko'=>$dataToko,
             'dataTransaksiPembayaran'=>$dataTransaksiPembayaran,
             'kasir'=>$dataAgen['nama_agen']
         ]);
     
  }
  
  public function actionKonfirmasiCodBatal($no_invoice){
      CheckoutItem::deleteAll(['no_invoice'=>$no_invoice]);
      Yii::$app->session->setFlash('success','Pesanan Item sudah dibatalkan');
      return $this->redirect(['cod']);
  }
}
