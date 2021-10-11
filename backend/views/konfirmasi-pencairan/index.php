<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\KonfirmasiPencairanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Konfirmasi Pencairans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="konfirmasi-pencairan-index">
    <h1 class="page-header">Halaman Konfirmasi Pencarian Dana</h1>
    <div class="note note-primary m-b-15">
        <div class="note-icon"><i class="fas fa-info"></i></div>
        <div class="note-content">
            <h4><b>Informasi!</b></h4>
            <p>
                Halaman ini untuk melakukan konfirmasi/ Verifikasi Pengajuan Pencairan Dana
            </p>
        </div>
    </div>
  <div class='row'>
       <div class="col-lg-3 col-md-6">
			        <div class="widget widget-stats bg-gradient-purple">
			            <div class="stats-icon stats-icon-lg"><i class="fa fa-archive fa-fw"></i></div>
			        	<div class="stats-content">
							<div class="stats-title">SEMUA PENGAJUAN MASUK</div>
							<div class="stats-number"><?=$countAll?></div>
							<div class="stats-progress progress">
								<div class="progress-bar" style="width: 100%;"></div>
							</div>
							<div class="stats-link">
							<a href="<?= Url::to(['index'])?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
						</div>
						</div>
			        </div>
       </div>
   <div class="col-lg-3 col-md-6">
			        <div class="widget widget-stats bg-gradient-blue">
			            <div class="stats-icon stats-icon-lg"><i class="fa fa-archive fa-fw"></i></div>
			        	<div class="stats-content">
							<div class="stats-title">MENUNGGU VERIFIKASI</div>
							<div class="stats-number"><?=$countAll3?></div>
							<div class="stats-progress progress">
								<div class="progress-bar" style="width: 100%;"></div>
							</div>
							<div class="stats-link">
							<a href="<?= Url::to(['index','id_status_pembayaran'=>3])?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
						</div>
						</div>
			        </div>
			    </div>

       <div class="col-lg-3 col-md-6">
			        <div class="widget widget-stats bg-gradient-green">
			            <div class="stats-icon stats-icon-lg"><i class="fa fa-archive fa-fw"></i></div>
			        	<div class="stats-content">
							<div class="stats-title">PENGAJUAN PENCAIRAN TERKONFIRMASI/VERIFIKASI</div>
							<div class="stats-number"><?=$countAll2?></div>
							<div class="stats-progress progress">
								<div class="progress-bar" style="width: 100%;"></div>
							</div>
					<div class="stats-link">
							<a href="<?= Url::to(['index','id_status_pembayaran'=>2])?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
						</div>
						</div>
			        </div>
			    </div>
        
    </div>
  


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

   //         'id',
            'no_invoice',
           [
             'header'=>'Data Agen',
               'value'=>function($data){
        $dataAgen = \backend\models\DataAgen::findOne(['no_acak'=>$data['no_acak']]);      
        return $dataAgen['nama_agen'] .' / '.$dataAgen['id_agen'];
               }
           ],
                   [
                       'header'=>'Metode Transfer',
                       'value'=>function($data){
                       $metodeTransfer = backend\models\MetodeTransfer::findOne($data['id_metode_transfer']);
                       return $metodeTransfer['nm_metode_transfer'];
                       }
                   ],
          //  'id_metode_transfer',
         //   'from_bank',
            //'tgl_ajukan',
            //'id_data_agen',
            'nominal',
             [
                 'format'=>'raw',
                'attribute' => 'id_status_pembayaran', 'width' => '3%',
                  'filter'=>$modelStatusPembayaran,
                'value' => function($data) {
                       $dataStatusPembayaran = \backend\models\StatusPembayaran::findOne($data['id_status_pembayaran']);
                    return "<b>". $dataStatusPembayaran['status_pembayaran']."</b>";
                }
            ],
            //'jamtgl',
                           [
                             'header'=>'Keterangan',
                               'value'=>function($data){
                               $ket = backend\models\KetSaldo::findOne($data['id_ket']);
                               return $ket['ket_saldo'];
                               }
                           ],
            ['class' => 'kartik\grid\ActionColumn','template'=>'{verifikasi}',
                'buttons'=>[
                    'verifikasi'=>function($url,$data,$key){
                        $url = ['verifikasi','id'=>$key];
                        if($data['id_status_pembayaran']==2){
                         return 'Waktu Konfirmasi: '.$data['jamtgl'];   
                        }else{
                        return Html::button('Verifikasi',['class'=>'btn btn-warning showModalButton','value'=>Url::to($url)]);
                        }
                    }
                ]
                ],
        ],
    ]); ?>


</div>
