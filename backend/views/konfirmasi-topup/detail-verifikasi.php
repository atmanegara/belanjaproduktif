<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\KonfirmasiTopupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Konfirmasi Topups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="konfirmasi-topup-index">

       <div class="note note-primary m-b-15">
        <div class="note-icon"><i class="fas fa-success"></i></div>
        <div class="note-content">
            <h4><b>Informasi!</b></h4>
            <p>
             Halaman daftar agen pengajuan topup saldo yang berhasil di verifiikasi 
            </p>
        </div>
       </div>
   
    <p>
    <?php
    if(in_array(Yii::$app->user->identity->role_id, [1])){
        $url = ['/data-saldo'];
    }else{
        $url=['/data-saldo/index-agen'];
    }
echo Html::a('<i class="fa fa-home"> </i>Kembali',$url,['class'=>"btn btn-md btn-default"]);
?>
    </p>

    <?= GridView::widget([
        'pjax'=>true,
        'panel'=>[
            'type'=> \kartik\grid\GridView::TYPE_INFO,
            'heading'=>'Daftar Riwayat Topup Saldo'
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'header'=>'Dari Agen',
                'format'=>'raw',
                'value'=>function($data){
                    $dataAgen = \backend\models\DataAgen::findOne(['no_acak'=>$data['no_acak']]);
                    return $dataAgen['id_agen'] .' - '.$dataAgen['nama_agen'];
                }
            ],
      //      'id',
     //       'no_acak',
            'no_invoice',
         //   'id_metode_transfer',
            'nominal',
         ['attribute'=>'from_bank',
             'header'=>'Bank',
                'value'=>function($data){
        $meto = \backend\models\RefBank::findOne($data['from_bank']);
        return $meto ? $meto['nm_bank'] : '-';
                }
                ],
           'tgl_transfer',
            //'filename',
            ['attribute'=>'id_status_pembayaran','header'=>'Status Pembayaran',
                'value'=>function($data){
                return $data->statusPembayaran->status_pembayaran;
                }
            ],
// [
//                      'attribute'=>"id_ket_saldo",
//                        'value'=>function($data){
//                $ketsaldo = \backend\models\KetSaldo::findOne($data['id_ket_saldo']);
//                return $ketsaldo ? $ketsaldo['ket_saldo'] : '-';
//                        }
//                    ],
            ['class' => 'kartik\grid\ActionColumn','width'=>'30%',
                'template'=>'{view} {batal}',
                'buttons'=>[
                    'view'=>function($url,$data,$key){
              
                        return Html::a('Tampil',Url::to(['detail-invoice','id'=>$key]),['class'=>'btn btn-md btn-info']);
                  
                    },
                     'batal'=>function($url,$data,$key){
              
                        return \yii\bootstrap4\Html::button('Konfirmasi Ulang',['class'=>'btn btn-md btn-danger showModalButton',
                            'value'=>Url::to(['update-re','id'=>$data['id']])
                        ]);
                  
                    }
                ]
            ],
        ],
    ]); ?>


</div>
