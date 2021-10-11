<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transaksi Komisis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaksi-komisi-index">

    <p>
           <?= Html::a('Kembali', ['/data-komisi/index-agen'], ['class' => 'btn btn-default']) ?>
     
    </p>
    
    <?= GridView::widget([
        'panel'=>[
            'heading'=>'Riwayat Komisi',
            'type'=> \kartik\grid\GridView::TYPE_INFO
        ],
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

       //     'id',
            [
                'header'=>'Pemberian Orang',
              'attribute'=>'no_acak_pemberi','width'=>'10%',
                'format'=>'raw',
                'value'=>function($data){
                    $dataAgen = \backend\models\DataAgen::find()->where(['no_acak'=>$data['no_acak_pemberi']]);
                    if(!$dataAgen->exists()){
                          $html = '-';
                           $dataAgenReg= \backend\models\RegistrasiAgen::find()->where(['no_acak'=>$data['no_acak_pemberi']]);
                            if($dataAgenReg->exists()){
                                     $dataAgenReg=$dataAgenReg->one();
                                 $html = $dataAgenReg['no_reg'].', '.$dataAgenReg['nama_agen'];
                            }
              }else{
                        $dataAgen=$dataAgen->one();
                            $html = $dataAgen['nik'].', '.$dataAgen['nama_agen'];
                 
                    }
                      if(in_array($data['ket'], ['6','7'])){
            $html='BP';
        }
                    return $html;
                }
            ],
     'no_acak:text:No Tutup Buku',
            'tgl_masuk',
        //    'id_data_agen',
    //     'jumlah:integer:Jumlah',
    [
        'header'=>'Persen',
        'value'=>function($data){
                return $data['nilai_bagi']*100 .' %';
        }
    ],
   [
       'format'=>'raw',
    'attribute'=>'nominal',
       'format'=>'decimal',
    'value'=>function($data){
                    return $data['nominal'];
    }
],
[
    'attribute'=>'ket',
    'value'=>function($data){
                    return \backend\models\RefSumberKomisi::findOne([$data['ket']])->ket_sumber;
    }
],
            //'tahun',

        ],
    ]); ?>


</div>
