<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RiwayatPencairanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Riwayat Pencairans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="riwayat-pencairan-index">
    <p>
           <?= Html::a('<i class="fa fa-backward"></i> Kembali', ['/data-komisi/index-agen'], ['class' => 'btn btn-default']) ?>
     
    </p>
  
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
         'panel'=>[
          'heading'=>'Daftar Pengajuan'  ,
            'type'=> GridView::TYPE_INFO
        ],
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

        //    'no_acak_arsip',
            'tgl_pencairan',
       //        'id',
        //    'no_acak',
                    'no_invoice',
           [
             'header'=>'Data Agen',
               'value'=>function($data){
        $dataAgen = \backend\models\DataAgen::findOne(['no_acak'=>$data['no_acak']]);      
        return $dataAgen['nama_agen'] .' / '.$dataAgen['id_agen'];
               }
           ],
                 [
                       'header'=>'Pencairan',
                     'format'=>'raw',
                       'value'=>function($data){
               $komisi_sbg = $data['pencarian_sbg']==1 ? "SALDO" : "KOMISI";
               $komisi_status = $data['status_pencarian']==1 ? "Ke Agen" : "Ke Bank";
                      return $komisi_status.' > '.$komisi_sbg;
                       }
                   ],
          //  'from_bank',
            'tgl_ajukan',
        //    'id_data_agen',
                            [
             'header'=>'Ke Agen',
               'value'=>function($data){
        $dataAgen = \backend\models\DataAgen::findOne(['id'=>$data['id_data_agen']]);      
        return $dataAgen['nama_agen'] .' Pribadi '.$dataAgen['id_agen'];
               }
           ],
           [
            'header'=>'Nominal',
               'value'=>function($data){
               return number_format($data['nominal'],0,',','.');
               }
           ]

        ],
    ]); ?>


</div>
