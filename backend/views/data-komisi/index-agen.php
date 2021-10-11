<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataKomisiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Komisis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-komisi-index">

    <h1 class="page-header">Halaman Daftar Komisi</h1>
    <div class="note note-primary m-b-15">
        <div class="note-icon"><i class="fas fa-info"></i></div>
        <div class="note-content">
            <h4><b>Informasi!</b></h4>
            <p>
                Halaman Daftar Komisi
            </p>
        </div>
    </div>

<div class="row">
			 
			    <!-- end col-3 -->
			    <!-- begin col-3 -->
			    <div class="col-lg-3 col-md-6">
			        <div class="widget widget-stats bg-gradient-blue">
			            <div class="stats-icon stats-icon-lg"><i class="fa fa-dollar-sign fa-fw"></i></div>
						<div class="stats-content">
							<div class="stats-title">KOMISI</div>
							<div class="stats-number">Rp <?=number_format($dataKomisi['nominal'],0,',','.')?></div>
							<div class="stats-progress progress">
								<div class="progress-bar" style="width: 100%;"></div>
							</div>
						<div class="stats-link">
							<a href="javascript:;"> <i class="fa fa-money-bill"></i></a>
						</div>
						</div>
			        </div>
			    </div>
			    <!-- end col-3 -->
			    <!-- begin col-3 -->
			    <div class="col-lg-3 col-md-6">
			        <div class="widget widget-stats bg-gradient-purple">
			            <div class="stats-icon stats-icon-lg"><i class="fa fa-archive fa-fw"></i></div>
			        	<div class="stats-content">
							<div class="stats-title">RIWAYAT KOMISI </div>
							<div class="stats-number"><?=$modelTotalTransksi?></div>
							<div class="stats-progress progress">
								<div class="progress-bar" style="width: 100%;"></div>
							</div>
						<div class="stats-link">
                                                    <?=Html::a('Riwayat <i class="fa fa-arrow-alt-circle-right"></i>',['/transaksi-komisi/view-transaksi-komisi', 'no_acak' => $no_acak], ['class' => 'btn btn-md btn-info'
                        ]); ?>
						</div>
						</div>
			        </div>
			    </div>
                            
                               <div class="col-lg-3 col-md-6">
			        <div class="widget widget-stats bg-aqua-transparent-9">
			            <div class="stats-icon stats-icon-lg"><i class="fa fa-archive fa-fw"></i></div>
			        	<div class="stats-content">
							<div class="stats-title">RIWAYAT PENCAIRAN DANA </div>
							<div class="stats-progress progress">
								<div class="progress-bar" style="width: 100%;"></div>
							</div>
						<div class="stats-link">
                                                    <?=Html::a('Riwayat <i class="fa fa-arrow-alt-circle-right"></i>',['/riwayat-pencairan/index', 'no_acak' => $no_acak], ['class' => 'btn btn-md btn-info'
                        ]); ?>
						</div>
						</div>
			        </div>
			    </div>
			    <!-- end col-3 -->
			    <!-- begin col-3 -->
			  
			    <!-- end col-3 -->
			</div>
      <p>
   
        <?php if (in_array(Yii::$app->user->identity->role_id, ['2', '3', '4','6'])) { ?>
         
            <?=
            Html::button('Pencairan Dana Ke Bank', ['class' => 'btn btn-lg btn-primary showModalButton',
                'value' => \yii\helpers\Url::to(['transfer-kebank', 'no_acak' => $no_acak])
            ])
            ?>
           <?php
//            Html::button('Pencairan Dana ke Agen Lainnya', ['class' => 'btn btn-lg btn-warning showModalButton',
//                'value' => \yii\helpers\Url::to(['transfer-keagen', 'no_acak' => $no_acak])
//            ])
            ?>
   <?=
            Html::button('Pencairan Dana Ke Saldo', ['class' => 'btn btn-lg btn-info showModalButton',
                'value' => \yii\helpers\Url::to(['transfer-kesaldo', 'no_acak' => $no_acak])
            ])
            ?><?php } ?>
    </p>
</div>
