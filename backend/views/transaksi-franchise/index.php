<?php
use kartik\grid\GridView;
use yii\bootstrap4\Html;
use yii\helpers\Url;
use backend\models\RegistrasiAgen;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="note note-primary">
  <div class="note-icon"><i class="fa fa-info-circle"></i></div>
  <div class="note-content">
    <h4><b>Informasi!</b></h4>
    <p> Halaman ini berisi daftar Transaksi Franchise</p>
  </div>
</div>
<?=
GridView::widget([
    'panel'=>[
        'heading'=>'Daftar Transaksi Franchise yang terkonfirmasi',
        'type'=>GridView::TYPE_INFO
    ],
    'dataProvider'=>$dataProvider,
    'columns'=>[
          ['attribute' => 'no_invoice', 'width' => '2%'],
       
           [
                'header' => 'Data Calon Agen', 'width' => '5%',
                'value' => function($data) {
                     $nik = '';
                    $nama = '';
                    $dataRegistrasiAgen = RegistrasiAgen::find()->where(['no_acak' => $data['no_acak']]);
                    if($dataRegistrasiAgen->exists()){
                        $dataReg = $dataRegistrasiAgen->one();
                         $nik = $dataReg['nik'];
                    $nama = $dataReg['nama'];
                    }
                   
                    return $nik .' - '.$nama;
                }
            ],
                     
           [
                'header' => 'Agen', 'width' => '5%',
                'value' => function($data) {
                     $agen = '';
                    $dataRegistrasiAgen = RegistrasiAgen::find()->where(['no_acak' => $data['no_acak']]);
                    if($dataRegistrasiAgen->exists()){
                        $dataReg = $dataRegistrasiAgen->one();
                         $refagen= backend\models\RefAgen::findOne($dataReg['id_ref_agen']);
                    $agen = $refagen['nama_agen'];
                    }
                   
                    return $agen;
                }
            ],
        'tgl_transfer','nominal'
    ]
])
?>
