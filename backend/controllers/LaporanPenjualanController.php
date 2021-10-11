<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\controllers;
use Yii;
use yii\web\Controller;
use kartik\mpdf\Pdf;
/**
 * Description of LaporanController
 *
 * @author Administrator
 */
class LaporanPenjualanController extends Controller{
    //put your code here
    
    
    public function actionIndex(){
        $query = \backend\models\TutupBuku::find()->groupBy('no_acak');
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query'=>$query
        ]);
        return $this->render('index',[
            'dataProvider'=>$dataProvider
        ]);
        
    }
     public function actionIndexAgen(){
         $no_acak = Yii::$app->user->identity->no_acak;
         $query = \backend\models\TutupBuku::find()->where(['no_acak_user'=>$no_acak,'verifikasi'=>'1'])->groupBy('no_acak');
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query'=>$query
        ]);
        return $this->render('index-agen',[
            'dataProvider'=>$dataProvider
        ]);
        
    }

    
    public function actionPreviewLapPenjualanAgen($no_acak){
//         $no_acak_agen = Yii::$app->user->identity->no_acak;
//         $dataAgen = \backend\models\DataAgen::find()->where(['no_acak'=>$no_acak_agen])->one();
        $datatutup = \backend\models\TutupBuku::find()->where(['no_acak'=>$no_acak])->one();
        $dataAgen = \backend\models\DataAgen::find()->where(['no_acak'=>$datatutup['no_acak_user']])->one();
        $query = \backend\models\QueryModel::getTransaksiPenjualan($no_acak,$dataAgen['id']);
        $dataToko = \backend\models\DataToko::find()->where(['id_data_agen'=>$dataAgen['id']])->one();
//        $sql = "SELECT a.nama_barang,f.nama_toko,b.tgl_masuk,b.qty_in,c.qty_out,(b.qty_in-c.qty_out) AS sisa_qty,c.tgl_keluar,c.harga_satuan,(c.harga_satuan*b.qty_in) harga_modal,d.nilai,c.margin_item,c.margin_total,c.harga_jual,(c.harga_jual*c.qty_out) total FROM ref_barang a
//INNER JOIN (SELECT aa.no_acak,aa.tgl_transaksi tgl_masuk,sum(aa.qty) AS qty_in,bb.id_ref_barang FROM arsip_transaksi_barang aa 
//INNER JOIN arsip_data_barang bb ON aa.id_data_barang=bb.id
//WHERE aa.keterangan='IN' GROUP BY bb.id_ref_barang) b ON a.id=b.id_ref_barang
//LEFT JOIN (SELECT cc.no_acak, cc.tgl_transaksi tgl_keluar,sum(cc.qty) AS qty_out,dd.id_ref_barang,dd.harga_satuan,cc.margin_item,cc.margin_total,cc.harga_jual FROM arsip_transaksi_barang cc 
//INNER JOIN arsip_data_barang dd ON cc.id_data_barang=dd.id 
//WHERE cc.keterangan='OUT' GROUP BY dd.id_ref_barang) c ON a.id=c.id_ref_barang
//left JOIN atur_margin_item d ON a.id=d.id_ref_barang
//left JOIN arsip_data_barang e ON e.id_ref_barang=a.id 
//LEFT JOIN data_toko f ON e.id_data_agen=f.id_data_agen
//WHERE e.no_acak=:no_acak  and b.no_acak=:no_acak ";
//        $params=[
//            ':no_acak'=>$no_acak
//        ];
//        $query = Yii::$app->db->createCommand($sql, $params)->queryAll();
        return $this->render('preview-lap-penjualan-agen',[
            'query'=>$query,
            'no_acak'=>$no_acak,
            'no_acak_user'=>false,
            'dataAgen'=>$dataAgen,
            'dataToko'=>$dataToko
        ]);
    }
        public function actionVerifikasiLapPenjualanAgen($no_acak,$no_acak_user){
     //    $no_acak_agen = Yii::$app->user->identity->no_acak;
        $datatutup = \backend\models\TutupBuku::find()->where(['no_acak'=>$no_acak])->one();
        $dataAgen = \backend\models\DataAgen::find()->where(['no_acak'=>$datatutup['no_acak_user']])->one();
        $query = \backend\models\QueryModel::getTransaksiPenjualan($no_acak,$dataAgen['id']);
        $dataToko = \backend\models\DataToko::find()->where(['id_data_agen'=>$dataAgen['id']])->one();
     //   $query = \backend\models\QueryModel::getTransaksiPenjualan($no_acak);
//        $sql = "SELECT a.nama_barang,f.nama_toko,b.tgl_masuk,b.qty_in,c.qty_out,(b.qty_in-c.qty_out) AS sisa_qty,c.tgl_keluar,c.harga_satuan,(c.harga_satuan*b.qty_in) harga_modal,d.nilai,c.margin_item,c.margin_total,c.harga_jual,(c.harga_jual*c.qty_out) total FROM ref_barang a
//INNER JOIN (SELECT aa.no_acak,aa.tgl_transaksi tgl_masuk,sum(aa.qty) AS qty_in,bb.id_ref_barang FROM arsip_transaksi_barang aa 
//INNER JOIN arsip_data_barang bb ON aa.id_data_barang=bb.id
//WHERE aa.keterangan='IN' GROUP BY bb.id_ref_barang) b ON a.id=b.id_ref_barang
//LEFT JOIN (SELECT cc.no_acak, cc.tgl_transaksi tgl_keluar,sum(cc.qty) AS qty_out,dd.id_ref_barang,dd.harga_satuan,cc.margin_item,cc.margin_total,cc.harga_jual FROM arsip_transaksi_barang cc 
//INNER JOIN arsip_data_barang dd ON cc.id_data_barang=dd.id 
//WHERE cc.keterangan='OUT' GROUP BY dd.id_ref_barang) c ON a.id=c.id_ref_barang
//left JOIN atur_margin_item d ON a.id=d.id_ref_barang
//left JOIN arsip_data_barang e ON e.id_ref_barang=a.id 
//LEFT JOIN data_toko f ON e.id_data_agen=f.id_data_agen
//WHERE e.no_acak=:no_acak  and b.no_acak=:no_acak ";
//        $params=[
//            ':no_acak'=>$no_acak
//        ];
//        $query = Yii::$app->db->createCommand($sql, $params)->queryAll();
        return $this->render('verifikasi-lap-penjualan-agen',[
            'query'=>$query,
            'no_acak'=>$no_acak,
            'no_acak_user'=>$no_acak_user,
            'dataAgen'=>$dataAgen,
            'datatutup'=>$datatutup,
            'dataToko'=>$dataToko
        ]);
    }
      public function actionPrintLapPenjualanAgen($no_acak,$no_acak_user,$export){
            $datatutup = \backend\models\TutupBuku::find()->where(['no_acak'=>$no_acak])->one();
        $dataAgen = \backend\models\DataAgen::find()->where(['no_acak'=>$datatutup['no_acak_user']])->one();
        
              $query = \backend\models\QueryModel::getTransaksiPenjualan($no_acak,$dataAgen['id']);
     $dataToko = \backend\models\DataToko::find()->where(['id_data_agen'=>$dataAgen['id']])->one();
        $content= $this->renderPartial('print-lap-penjualan-agen',[
                'query'=>$query,
            'no_acak'=>$no_acak,
             'no_acak_user'=>$no_acak_user,
            'dataAgen'=>$dataAgen,
            'datatutup'=>$datatutup,
            'dataToko'=>$dataToko
            ]); 
        $filename=$no_acak;
        if($export=='pdf'){
            $pdf = new Pdf();
            $mpdf = $pdf->api;
          $mpdf->SetHeader(date("Y-m-d"));
          $mpdf->WriteHtml($content);
          return $mpdf->Output($filename.'.pdf', 'I');
        }elseif($export=='xls'){
            header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$filename.xls");
return $content;
        }
    }
}
