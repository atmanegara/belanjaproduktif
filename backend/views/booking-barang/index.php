<?php

use yii\bootstrap4\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BookingBarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Booking Barangs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-barang-index">

   <div class="note note-primary">
  <div class="note-icon"><i class="fab fa-info-circle"></i></div>
  <div class="note-content">
    <h4><b>INFORMASI!</b></h4>
    <p> HANYA MENAMPILKAN INVOICE DARI PESANAN (BOOKING) </p>
  </div>
</div>
    <p>
        <?= Html::a('Total Booking Status Prosess [ '.$totalBookingProsess.' ]',['index'],['class'=>'btn btn-flat btn-info']); ?>
   
        <?= Html::a('Total Booking Status Selesai [ '.$totalBookingSelesai.' ]',['index?status_booking=2'],['class'=>'btn btn-flat btn-success']); ?>
        
        <?= Html::a('Total Booking Status Dibatalkan [ '.$totalBookingBatal.' ]',['index?status_booking=0'],['class'=>'btn btn-flat btn-danger']); ?>
    </p>
    <?= GridView::widget([
        'panel'=>[
            'heading'=>'Daftar Pesanan / Booking',
            'type'=> kartik\grid\GridView::TYPE_INFO
        ],
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
              [
                'header'=>'Agen',
              'attribute'=>'no_acak_pemberi','width'=>'10%',
                'format'=>'raw',
                'value'=>function($data){
                    $dataAgen = \backend\models\DataAgen::find()->where(['no_acak'=>$data['no_acak']]);
                    if(!$dataAgen->exists()){
                          $html = '-';
              }else{
                        $dataAgen=$dataAgen->one();
                            $html = $dataAgen['nik'].', '.$dataAgen['nama_agen'];
                 
                    }
                    return $html;
                }
            ],
            'kd_booking:text:No Booking',
            'no_invoice:text:No Invoice',
                    'ket:text:Metode Pembayaran',
                    'tgl_batas_book:text:Tanggal Booking',
               [
                 'attribute'=>'status_booking','width'=>'10%',
                   'format'=>'raw',
                   'value'=>function($data){
                       switch ($data['status_booking']){
                           case 1:
                           $status_booking='<span class="label label-info">Booking</span>';
                               break;
                           case 2:
                                   $status_booking='<span class="label label-success">Pesanan Selesai</span>';
                               break;
                           case 0:
                               $status_booking='<span class="label label-danger">Booking Dibatalkan</span>';
                               break;
                           
                       }
                       return $status_booking;
                   }
               ],
            ['class' => 'kartik\grid\ActionColumn','template'=>'{list} {delete} {print} {thermal}','width'=>'30%',
                'buttons'=>[
                    'list'=>function($url,$data,$key){
                        $no_invoice = $data['no_invoice'];
                        $kd_booking = $data['kd_booking'];
                        $url = ['lampiran-toko','no_invoice'=>$no_invoice,'kd_booking'=>$kd_booking];
                        return Html::a('LIST BOOKING', $url,['class'=>'btn btn-md btn-warning']);
                    },
                    'delete'=>function($url,$data){
                        if($data['status_booking']=='0'){
                        $kd_booking = $data['kd_booking'];
                        return Html::a('Hapus',['delete-all','kd_booking'=>$kd_booking],['class'=>'btn btn-md btn-danger',
                            'data'=>[
                                'confirm'=>'Anda Yakin ingin dihapus?',
                                'method'=>'post'
                            ]
                        ]);
                        }
                    },
                             'print'=>function($url,$data){
                        if($data['status_booking']==2){
    return Html::a('Print Invoice',['/belanja/print-faktur','no_invoice'=>$data['no_invoice']],['class'=>'btn btn-success ',
        'target'=>'_blank'
        ]);
                        }
                },
                'thermal'=>function($url,$data){
                        if($data['status_booking']==2){
                            $url= yii\helpers\Url::to(['/belanja/print-thermal-faktur','no_invoice'=>$data['no_invoice']]);
    return Html::a('Print Thermal ',$url,['class'=>'btn btn-default ',
          'onClick'=>
		                        "window.open('".$url."',
                         'newwindow',
                         'width=400,height=250');
              return false;"
        ]);
                        }
                }
                ]],
        ],
    ]); ?>


</div>
