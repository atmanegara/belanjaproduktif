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

   <h1 class="page-header">Halaman Konfirmasi Pembayaran Top Up</h1>
      <div class="note note-primary m-b-15">
					<div class="note-icon"><i class="fas fa-info"></i></div>
					<div class="note-content">
						<h4><b>Informasi!</b></h4>
						<p>
							Halaman ini untuk melakukan verifikasi pembayaran top up 
                                                </p>
					</div>
				</div>

<div class="row">
	<!-- begin col-3 -->
	<div class="col-lg-3 col-md-6">
		<div class="widget widget-stats bg-red">
			<div class="stats-icon"><i class="fa fa-desktop"></i></div>
			<div class="stats-info">
				<h4>MENUGGU KONFIRMASI</h4>
				<p><?php echo $totalBelumKOnfirmasi?></p>	
			</div>
			<div class="stats-link">
				<a href="<?php echo Url::to(['/konfirmasi-topup/konfirmasi?id_status_pembayaran=3'])?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-lg-3 col-md-6">
		<div class="widget widget-stats bg-orange">
			<div class="stats-icon"><i class="fa fa-link"></i></div>
			<div class="stats-info">
				<h4>MENUNGGU VERIFIKASI</h4>
				<p><?php echo $totalBelumVerifikasi?></p>	
			</div>
			<div class="stats-link">
				<a href="<?php echo Url::to(['/konfirmasi-topup/konfirmasi?id_status_pembayaran=1'])?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-lg-3 col-md-6">
		<div class="widget widget-stats bg-grey-darker">
			<div class="stats-icon"><i class="fa fa-users"></i></div>
			<div class="stats-info">
				<h4>SELESAI</h4>
				<p><?php echo $totalterkonfirmasi?></p>	
			</div>
			<div class="stats-link">
				<a href="<?php echo Url::to(['/konfirmasi-topup/konfirmasi?id_status_pembayaran=2'])?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-lg-3 col-md-6">
		<div class="widget widget-stats bg-black-lighter">
			<div class="stats-icon"><i class="fa fa-clock"></i></div>
			<div class="stats-info">
				<h4>TOLAK</h4>
			<p><?php echo $totaltolak?></p>	
			</div>
			<div class="stats-link">
				<a href="<?php echo Url::to(['/konfirmasi-topup/konfirmasi?id_status_pembayaran=4'])?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
</div>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel'=>[
          'type'=> \kartik\grid\GridView::TYPE_INFO  
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

      //      'id',
           // 'no_acak',
               [
                'header'=>'Data Agen',
                 'format'=>'raw',
                'value'=>function($data){
                $dataAgen = \backend\models\DataAgen::find()->where(['no_acak'=> $data['no_acak']]);
                if($dataAgen->exists()){
                    $dataAgen = $dataAgen->one();
                return  '['.$dataAgen->refAgen->nama_agen.'] '. $dataAgen->nik .' / '.$dataAgen->nama_agen;
                }else{
                    return "<span class='label label-warning'>Data Agen tidak ditemukan, cek di daftar agen</span>";
                }
                }
            ],
                    
            'no_invoice',
      //      'id_metode_transfer',
            ['attribute'=>'nominal',
                'value'=>function($data){
                return number_format($data['nominal'],0,',','.');
                }
                ],
                    [
                      'attribute'=>"id_ket_saldo",
                        'header'=>'Keterangan',
                        'filter'=> backend\models\KetSaldo::dropDownlist(),
                        'value'=>function($data){
                $ketsaldo = \backend\models\KetSaldo::findOne($data['id_ket_saldo']);
                return $ketsaldo ? $ketsaldo['ket_saldo'] : '-';
                        }
                    ],
            //'from_bank',
            //'tgl_transfer',
            //'filename',
            ['attribute'=>'id_status_pembayaran',
                'value'=>function($data){
                return $data->statusPembayaran->status_pembayaran;
                }
                ],
                
                ['class' => 'yii\grid\ActionColumn',
                    'template'=>'{update}',
                    'buttons'=>[
                        'update'=>function($url,$data,$key){
                        if($data['id_status_pembayaran']=='1'){  
                            $role_id = Yii::$app->user->identity->role_id;
                            if(in_array($role_id, ['1'])){
                                if($data['id_ket_saldo']==1){
                            return \yii\bootstrap4\Html::button('Verifikasi Pembayaran',['class'=>'btn btn-md btn-warning showModalButton',
                                'value'=>Url::to(['update','id'=>$data['id']])
                            ]);
                            }else{
                            return \yii\bootstrap4\Html::button('Verifikasi Pencairan',['class'=>'btn btn-md btn-warning showModalButton',
                                'value'=>Url::to(['update-pencairan','id'=>$data['id']])
                            ]);
                                
                            }
                            }
                        }elseif($data['id_status_pembayaran']=='2'){
                            return Html::a('Tampil',Url::to(['detail-saldo','id'=>$key]),['class'=>'btn btn-md btn-info']);
                        }
                        }
                        ]
                        ],
        ],
    ]); ?>


</div>
