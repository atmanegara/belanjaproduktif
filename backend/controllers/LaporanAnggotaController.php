<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\DataAgen;
use backend\models\ArsipRegistrasiAgen;

/**
 * Description of LaporanAnggotaController
 *
 * @author Administrator
 */
class LaporanAnggotaController extends Controller{
    //put your code here
    
    public function actionIndex(){
        $modelDynamic = new \yii\base\DynamicModel(['tgl_awal','tgl_akhir','id_ref_agen']);
        $modelDynamic->addRule(['tgl_awal','tgl_akhir','id_ref_agen'], 'string');
        
        $items = \backend\models\RefAgen::getDropdownlistByAktif();
        return $this->render('index',[
            'modelDynamic'=>$modelDynamic,
            'items'=>$items
        ]);
    }
    
    public function actionPreviewLaporanAgen($no_acak=null){
        $modelTentangKami = \backend\models\TentangKami::find()->where(['id'=>1])->one();
        $modelFotoProfil = \backend\models\FotoProfil::find()->one();
        $tgl_awal = Yii::$app->request->post('tgl_awal');
        $tgl_akhir = Yii::$app->request->post('tgl_akhir');
        $id_ref_agen = Yii::$app->request->post('refagen');
        $query = (new \yii\db\Query())
                ->select('a.id_agen,a.nama_agen,a.alamat,a.rt,a.rw,a.alamat_domisili,a.rt_domisili,a.rw_domisili,b.nama as namakab,c.nama as namakec,d.nama as namakel,'
                        . 'bb.nama as namakabdomisili,cc.nama as namakecdomisili,dd.nama as namakeldomisili,a.no_wa,a.email,e.nama_toko,e.alamat  as alamat_toko')
                ->from('data_agen a')
                ->leftJoin('registrasi_agen aa','a.no_acak=aa.no_acak')
                ->leftJoin('kabupaten b','a.id_kab=b.id_kab')
                ->leftJoin('kecamatan c','a.id_kecamatan=c.id_kec')
                ->leftJoin('kelurahan d','a.id_kelurahan=d.id_kel')
                ->leftJoin('kabupaten bb','a.id_kab_domisili=bb.id_kab')
                ->leftJoin('kecamatan cc','a.id_kecamatan_domisili=cc.id_kec')
                ->leftJoin('kelurahan dd','a.id_kelurahan_domisili=dd.id_kel')
                ->leftJoin('data_toko e','a.id=e.id_data_agen')
                            ->where(["IN",'a.id_ref_agen',$id_ref_agen])
            ->andFilterWhere(['BETWEEN','aa.tgl_registrasi',$tgl_awal,$tgl_akhir])
                        ->all();
        return $this->renderPartial('preview-laporan-agen',[
            'query'=>$query,
            'no_acak'=>$no_acak,
             'tgl_awal'=>$tgl_awal,
            'tgl_akhir'=>$tgl_akhir,
            'id_ref_agen'=> implode(',',$id_ref_agen),
            'modelTentangKami'=>$modelTentangKami,
            'modelFotoProfil'=>$modelFotoProfil
        ]);
    }
     public function actionPrintLaporanAgen(){
        $modelTentangKami = \backend\models\TentangKami::find()->where(['id'=>1])->one();
        $modelFotoProfil = \backend\models\FotoProfil::find()->one();
        $tgl_awal = Yii::$app->request->post('tgl_awal');
        $tgl_akhir = Yii::$app->request->post('tgl_akhir');
        $id_ref_agen =explode(',',Yii::$app->request->post('refagen'));
        $export = Yii::$app->request->post('export');
        
       // return var_dump($id_ref_agen);
        $query = (new \yii\db\Query())
                ->select('a.id_agen,a.nama_agen,a.alamat,a.rt,a.rw,a.alamat_domisili,a.rt_domisili,a.rw_domisili,b.nama as namakab,c.nama as namakec,d.nama as namakel,'
                        . 'bb.nama as namakabdomisili,cc.nama as namakecdomisili,dd.nama as namakeldomisili,a.no_wa,a.email,e.nama_toko,e.alamat  as alamat_toko')
                ->from('data_agen a')
                ->leftJoin('registrasi_agen aa','a.no_acak=aa.no_acak')
                ->leftJoin('kabupaten b','a.id_kab=b.id_kab')
                ->leftJoin('kecamatan c','a.id_kecamatan=c.id_kec')
                ->leftJoin('kelurahan d','a.id_kelurahan=d.id_kel')
                ->leftJoin('kabupaten bb','a.id_kab_domisili=bb.id_kab')
                ->leftJoin('kecamatan cc','a.id_kecamatan_domisili=cc.id_kec')
                ->leftJoin('kelurahan dd','a.id_kelurahan_domisili=dd.id_kel')
                ->leftJoin('data_toko e','a.id=e.id_data_agen')
                                  ->where(["IN",'a.id_ref_agen',$id_ref_agen])
    ->andWhere(['BETWEEN','aa.tgl_registrasi',$tgl_awal,$tgl_akhir])
                
                ->all();
        $content= $this->renderPartial('print-laporan-agen',[
            'query'=>$query,
            'modelTentangKami'=>$modelTentangKami,
            'modelFotoProfil'=>$modelFotoProfil
        ]);
        $filename='rekap_agen_bp'.date('YmdHis');
         if($export=='pdf'){
             $pdf = new \kartik\mpdf\Pdf();
            $mpdf = $pdf->api;
            $mpdf->WriteHtml($content);
            return   $mpdf->Output($filename, 'I');
        }elseif($export=='xls'){
            
            header("Content-type: application/vnd.ms-excel");
            header('Content-Disposition: attachment; filename="' . $filename . '.xls"');
            return $content;
        }
    }
    
    //laporan anggota detail
       public function actionIndexAnggota(){
          $modelDynamic = new \yii\base\DynamicModel(['tgl_awal','tgl_akhir','id_ref_agen']);
        $modelDynamic->addRule(['tgl_awal','tgl_akhir','id_ref_agen'], 'string');
        
        $items = \backend\models\RefAgen::getDropdownlistByAktif();
        
        return $this->render('index-anggota',[
            'modelDynamic'=>$modelDynamic,
            'items'=>$items
        ]);
    }
    
     public function actionPreviewLaporanAgenDetail($no_acak=null){
        $modelTentangKami = \backend\models\TentangKami::find()->where(['id'=>1])->one();
        $modelFotoProfil = \backend\models\FotoProfil::find()->one();
        $tgl_awal = Yii::$app->request->post('tgl_awal');
        $tgl_akhir = Yii::$app->request->post('tgl_akhir');
        $id_ref_agen =Yii::$app->request->post('refagen');
        $query = (new \yii\db\Query())
                ->select('a.no_acak,a.id_agen,a.nama_agen,f.nama_agen as ket_nama,a.alamat,a.rt,a.rw,a.alamat_domisili,a.rt_domisili,a.rw_domisili,b.nama as namakab,c.nama as namakec,d.nama as namakel,'
                        . 'bb.nama as namakabdomisili,cc.nama as namakecdomisili,dd.nama as namakeldomisili,a.no_wa,a.email,e.nama_toko,e.alamat  as alamat_toko')
                ->from('data_agen a')
                ->leftJoin('registrasi_agen aa','a.no_acak=aa.no_acak')
                ->leftJoin('kabupaten b','a.id_kab=b.id_kab')
                ->leftJoin('kecamatan c','a.id_kecamatan=c.id_kec')
                ->leftJoin('kelurahan d','a.id_kelurahan=d.id_kel')
                ->leftJoin('kabupaten bb','a.id_kab_domisili=bb.id_kab')
                ->leftJoin('kecamatan cc','a.id_kecamatan_domisili=cc.id_kec')
                ->leftJoin('kelurahan dd','a.id_kelurahan_domisili=dd.id_kel')
                ->leftJoin('data_toko e','a.id=e.id_data_agen')
                ->leftJoin('ref_agen f','f.id=a.id_ref_agen')
                        ->where(["IN",'a.id_ref_agen',$id_ref_agen])
      //    ->andWhere(['BETWEEN','aa.tgl_registrasi',$tgl_awal,$tgl_akhir])
                        ->all();
        return $this->renderPartial('preview-laporan-agen-detail',[
            'query'=>$query,
            'no_acak'=>$no_acak,
            'tgl_awal'=>$tgl_awal,
            'tgl_akhir'=>$tgl_akhir,
            'id_ref_agen'=> implode(',',$id_ref_agen),
            'modelTentangKami'=>$modelTentangKami,
            'modelFotoProfil'=>$modelFotoProfil
        ]);
    }
     public function actionPrintLaporanAgenDetail(){
        $modelTentangKami = \backend\models\TentangKami::find()->where(['id'=>1])->one();
        $modelFotoProfil = \backend\models\FotoProfil::find()->one();
        $tgl_awal = Yii::$app->request->post('tgl_awal');
        $tgl_akhir = Yii::$app->request->post('tgl_akhir');
        $id_ref_agen = explode(',', Yii::$app->request->post('refagen'));
        $export = Yii::$app->request->post('export');
        $query = (new \yii\db\Query())
                ->select('a.no_acak,a.id_agen,a.nama_agen,f.nama_agen as ket_nama,a.alamat,a.rt,a.rw,a.alamat_domisili,a.rt_domisili,a.rw_domisili,b.nama as namakab,c.nama as namakec,d.nama as namakel,'
                        . 'bb.nama as namakabdomisili,cc.nama as namakecdomisili,dd.nama as namakeldomisili,a.no_wa,a.email,e.nama_toko,e.alamat  as alamat_toko')
                ->from('data_agen a')
                ->leftJoin('registrasi_agen aa','a.no_acak=aa.no_acak')
                ->leftJoin('kabupaten b','a.id_kab=b.id_kab')
                ->leftJoin('kecamatan c','a.id_kecamatan=c.id_kec')
                ->leftJoin('kelurahan d','a.id_kelurahan=d.id_kel')
                ->leftJoin('kabupaten bb','a.id_kab_domisili=bb.id_kab')
                ->leftJoin('kecamatan cc','a.id_kecamatan_domisili=cc.id_kec')
                ->leftJoin('kelurahan dd','a.id_kelurahan_domisili=dd.id_kel')
                ->leftJoin('data_toko e','a.id=e.id_data_agen')
                ->leftJoin('ref_agen f','f.id=a.id_ref_agen')
                                  ->where(["IN",'a.id_ref_agen',$id_ref_agen])
   //   ->andWhere(['BETWEEN','aa.tgl_registrasi',$tgl_awal,$tgl_akhir])
                
                ->all();
        $content= $this->renderPartial('print-laporan-agen-detail',[
            'query'=>$query,
            'modelTentangKami'=>$modelTentangKami,
            'modelFotoProfil'=>$modelFotoProfil
        ]);
        $filename='rekap_agen_anggota_bp'.date('YmdHis');
         if($export=='pdf'){
             $pdf = new \kartik\mpdf\Pdf();
            $mpdf = $pdf->api;
            $mpdf->WriteHtml($content);
            return   $mpdf->Output($filename, 'I');
        }elseif($export=='xls'){
            
            header("Content-type: application/vnd.ms-excel");
            header('Content-Disposition: attachment; filename="' . $filename . '.xls"');
            return $content;
        }
    }
}
