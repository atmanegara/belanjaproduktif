<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\controllers;
use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use kartik\mpdf\Pdf;
use backend\models\TransaksiBarang;
use yii\base\DynamicModel;

/**
 * Description of LaporanTransaksiController
 *
 * @author Administrator
 */
class LaporanTransaksiController extends Controller {
    
    
    public function actionTransaksiBarang(){
        $role_id = Yii::$app->user->identity->role_id;
                $no_acak = Yii::$app->user->identity->no_acak;
        $dataTransaksiBarang=false;
        $modelDynamic = new DynamicModel(['tgl_awal','tgl_akhir']);
        $modelDynamic->addRule(['tgl_awal','tgl_akhir'], 'safe');
         if(in_array($role_id,['1'])){
             $dataAgen = \backend\models\DataAgen::find()->innerJoin('data_barang','data_barang.id_data_agen=data_agen.id')->all();
         }else{
             $dataAgen = \backend\models\DataAgen::find()->innerJoin('data_barang','data_barang.id_data_agen=data_agen.id')->where(['no_acak'=>$no_acak])->all();
         }
        if($modelDynamic->load(Yii::$app->request->post())){
            $tgl_awal = $modelDynamic->tgl_awal;
            $tgl_akhir = $modelDynamic->tgl_akhir;
            if(in_array($role_id,['1'])){
            $dataTransaksiBarang = TransaksiBarang::getTransaksiBarang($tgl_awal, $tgl_akhir);
            }else{
            $dataTransaksiBarang = TransaksiBarang::getTransaksiBarangAgen($tgl_awal, $tgl_akhir,$no_acak);
                
            }
        }
        return $this->render('transaksi-barang',[
            'modelDynamic'=>$modelDynamic,
            'dataTransaksiBarang'=>$dataTransaksiBarang,
            'dataAgen'=>$dataAgen
        ]);
    }
    
    public function actionPrintLapTransaksi($tgl_awal,$tgl_akhir,$export){
           $role_id = Yii::$app->user->identity->role_id;
                $no_acak = Yii::$app->user->identity->no_acak;
      if(in_array($role_id,['1'])){
             $dataAgen = \backend\models\DataAgen::find()->innerJoin('data_barang','data_barang.id_data_agen=data_agen.id')->all();
             $dataTransaksiBarang = TransaksiBarang::getTransaksiBarang($tgl_awal, $tgl_akhir);
     }else{
                $no_acak = Yii::$app->user->identity->no_acak;
            $dataTransaksiBarang = TransaksiBarang::getTransaksiBarangAgen($tgl_awal, $tgl_akhir,$no_acak);
             $dataAgen = \backend\models\DataAgen::find()->innerJoin('data_barang','data_barang.id_data_agen=data_agen.id')->where(['no_acak'=>$no_acak])->all();
                
            }
            $content = $this->renderPartial('print-lap-transaksi',[
                        'dataTransaksiBarang'=>$dataTransaksiBarang,'tgl_awal'=>$tgl_awal,'tgl_akhir'=>$tgl_akhir,
            'dataAgen'=>$dataAgen
          ]);
          $filename = 'lap_transaksi_'.date('YmdHis');
          if($export=='pdf'){
          $pdf = new Pdf();
            $mpdf = $pdf->api;
          $mpdf->SetHeader(date("Y-m-d"));
          $mpdf->WriteHtml($content);
          return $mpdf->Output($filename.'.pdf', 'I');
    } elseif ($export == 'xls') {
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=$filename.xls");
            return $content;
        }
    }
    
      
    public function actionStokHarian(){
        $role_id = Yii::$app->user->identity->role_id;
                $no_acak = Yii::$app->user->identity->no_acak;
  
            $dataAgen = \backend\models\DataAgen::find()->where(['no_acak'=>$no_acak])->one();
     
//            if(in_array($role_id,['1'])){
//            $dataTransaksiBarang = TransaksiBarang::getTransaksiBarang($tgl_awal, $tgl_akhir);
//            }else{
            $dataStokBarang = TransaksiBarang::getStokAkhir($no_acak);
                
//            }
       
        return $this->render('stok-harian',[
            'dataStokBarang'=>$dataStokBarang,'dataAgen'=>$dataAgen
        ]);
    }
    
    public function actionPrintLapStokHarian($export){
           $role_id = Yii::$app->user->identity->role_id;
                $no_acak = Yii::$app->user->identity->no_acak;
//      if(in_array($role_id,['1'])){
            $dataAgen = \backend\models\DataAgen::find()->where(['no_acak'=>$no_acak])->one();
//             $dataTransaksiBarang = TransaksiBarang::getTransaksiBarang($tgl_awal, $tgl_akhir);
//     }else{
                $no_acak = Yii::$app->user->identity->no_acak;
            $dataStokBarang = TransaksiBarang::getStokAkhir($no_acak);
//             $dataAgen = \backend\models\DataAgen::find()->innerJoin('data_barang','data_barang.id_data_agen=data_agen.id')->where(['no_acak'=>$no_acak])->all();
                
//            }
            $content = $this->renderPartial('print-lap-stok-harian',[
                          'dataStokBarang'=>$dataStokBarang,'dataAgen'=>$dataAgen
          ]);
          $filename = 'lap_stok_harian_'.date('YmdHis');
          if($export=='pdf'){
          $pdf = new Pdf();
            $mpdf = $pdf->api;
          $mpdf->SetHeader(date("Y-m-d"));
          $mpdf->WriteHtml($content);
          return $mpdf->Output($filename.'.pdf', 'I');
    } elseif ($export == 'xls') {
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=$filename.xls");
            return $content;
        }
    }
}
