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
        <div class="note-icon"><i class="fas fa-info"></i></div>
        <div class="note-content">
            <h4><b>Informasi!</b></h4>
            <p>
              Halaman Konfirmasi TopUp saldo, pastikan nominal yanng di transfer sesuai dengan tertulis dalam daftar ini
            </p>
        </div>
       </div>
   
    <p>
    <?=
Html::a('<i class="fa fa-home"> </i>Kembali',['index'],['class'=>"btn btn-md btn-default"]);
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
            ['class' => 'yii\grid\SerialColumn'],

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
            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{update}',
                'buttons'=>[
                    'update'=>function($url,$data,$key){
                    if($data['id_status_pembayaran']=='3'){  //belum bayar
                        return \yii\bootstrap4\Html::button('Konfirmasi Pembayaran',['class'=>'btn btn-md btn-warning showModalButton',
                            'value'=>Url::to(['update-pembayaran','id'=>$data['id']])
                        ]);
                    }elseif($data['id_status_pembayaran']=='1'){ //sudah bayar tp belum diverifikasi admin
                        $role_id = Yii::$app->user->identity->role_id;
                        if(in_array($role_id, ['1'])){
                        return \yii\bootstrap4\Html::button('Verifikasi Pembayaran',['class'=>'btn btn-md btn-warning showModalButton',
                            'value'=>Url::to(['update','id'=>$data['id']])
                        ]);
                        }
                    }else{
                        return '';// Html::a('Tampil',Url::to(['detail-invoice','id'=>$key]),['class'=>'btn btn-md btn-info']);
                    }
                    }
                ]
            ],
        ],
    ]); ?>


</div>
