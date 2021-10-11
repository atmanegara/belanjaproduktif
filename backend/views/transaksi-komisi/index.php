<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transaksi Komisis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaksi-komisi-index">
<p>
           <?= Html::a('<i class="fa fa-backward"></i> Kembali', ['/data-komisi/index'], ['class' => 'btn btn-default']) ?>
     
    </p>
  
    <?= GridView::widget([
        'panel'=>[
            'type'=> GridView::TYPE_INFO,
            'heading'=>'Daftar Transaksi Komisi'
        ],
        'dataProvider' => $dataProvider,
        'showPageSummary'=>true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

        //    'id',
          'no_acak:text:No Tutup Buku',
   [
       'format'=>'raw',
       'header'=>'Agen Pemberi Komisi / Pembeli',
       'value'=>function($data){
        $dataAgen = \backend\models\DataAgen::find()->where(['no_acak'=>$data['no_acak_pemberi']]);
        if($dataAgen->exists()){
            $dataAgen = $dataAgen->one();
            $nama_agen = $dataAgen['id_agen'] . ' / '.$dataAgen['nama_agen'];
        }else{
            $nama_agen = '-';
        }
        if(in_array($data['ket'], ['6','7'])){
            $nama_agen='BP';
        }
        return $nama_agen;
       }
       ],
            'tgl_masuk',
       //     'id_data_agen',
            //'jumlah',
           ['attribute'=>'nilai_bagi',
               'value'=>function($data){
           return $data['nilai_bagi']*100 .' %';
               }
               ],
           [
             'header'=>'Nominal',
               'pageSummary'=>true,
               'format'=>'decimal',
               'value'=>function($data){
                return $data['nominal'];
               }
           ],
     [
         'header'=>'Ket Komisi',
         'value'=>function($data){
                return backend\models\RefSumberKomisi::findOne($data['ket'])->ket_sumber;
         }
     ],
            //'tahun',

         ['class' => 'kartik\grid\ActionColumn','template'=>'{delete}',
               'buttons'=>[
     
                                  'delete'=>function($url,$data,$key){
               if(in_array(Yii::$app->user->identity->role_id,[1])){
        return Html::a('<span class="fa fa-trash" aria-hidden="true"></span>',Url::to( ['delete','id'=>$key]), ['class' => 'btn btn-danger btn-md',
            'data'=>[
                'confirm'=>'PERHATIAN PASTIKAN ITEM YANG ANDA PILIH SUDAH BENAR, DATA DIHAPUS TIDAK BISA DIKEMBALIKAN LAGI, ADA YAKIN ITEM INI DIHAPUS?',
                'method'=>'post'
            ]]);
               }
                   }
               ] 
               
            ],
        ],
    ]); ?>


</div>
