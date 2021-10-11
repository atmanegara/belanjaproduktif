<?php
use yii\bootstrap4\Html;
use yii\helpers\Url;
?>

<!-- begin page-header -->
<h1 class="page-header">Dashboard <small></small></h1>
<!-- end page-header -->

<!-- begin row -->
<div class="row">
	<!-- begin col-3 -->
	<div class="col-lg-3 col-md-6">
		<div class="widget widget-stats bg-red">
			<div class="stats-icon"><i class="fa fa-desktop"></i></div>
			<div class="stats-info">
				<h4>ANGGOTA TERVERIFIKASI</h4>
				<p><?=$jumanggota?></p>	
			</div>
			<div class="stats-link">
                            <a href="<?=Url::to(['/registrasi-agen','id_ref_proses_pendaftaran'=>'2'])?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>
        <div class="col-lg-3 col-md-6">
		<div class="widget widget-stats bg-red">
			<div class="stats-icon"><i class="fa fa-desktop"></i></div>
			<div class="stats-info">
				<h4>ANGGOTA BELUM TERVERIFIKASI</h4>
				<p><?=$jumanggotanon?></p>	
			</div>
			<div class="stats-link">
	      <a href="<?=Url::to(['/registrasi-agen','id_ref_proses_pendaftaran'=>'0'])?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
				</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-lg-3 col-md-6">
		<div class="widget widget-stats bg-orange">
			<div class="stats-icon"><i class="fa fa-link"></i></div>
			<div class="stats-info">
				<h4>TOTAL PENDAPATAN BP</h4>
                                <p> <?= number_format($pendapatan,0,',','.')?></p>	
			</div>
			<div class="stats-link">
				<a href="<?=Url::to(['/transaksi-komisi','no_acak'=>Yii::$app->user->identity->no_acak])?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>
        
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-lg-3 col-md-6">
		<div class="widget widget-stats bg-grey-darker">
			<div class="stats-icon"><i class="fa fa-users"></i></div>
			<div class="stats-info">
				<h4>PROGRAM AGEN</h4>
				<p><?=$bykProgramAgen?></p>	
			</div>
			<div class="stats-link">
				<a href="<?=Url::to(['/program-agen'])?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->

	<!-- end col-3 -->
</div>
<!-- end row -->
