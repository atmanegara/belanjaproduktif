<?php
use yii\bootstrap4\Html;
use yii\helpers\Url;
use backend\models\QueryModel;
      $no_acak=Yii::$app->user->identity->no_acak; 
?>

<h1 class="page-header">Dashboard </h1>
<!-- end page-header -->

<!-- begin row -->
<div class="row">
	<!-- begin col-3 -->
	<div class="col-lg-3 col-md-6">
		<div class="widget widget-stats bg-success">
			<div class="stats-icon"><i class="fa fa-chart-area"></i></div>
			<div class="stats-info">
				<h4>Belanja</h4>
                                <p>.</p>	
			</div>
			<div class="stats-link">
				<a href="<?= Url::to(['/produk/search-produk'])?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>

	<div class="col-lg-3 col-md-6">
		<div class="widget widget-stats bg-grey-darker">
			<div class="stats-icon"><i class="fa fa-users"></i></div>
			<div class="stats-info">
				<h4>SALDO</h4>
                                <p><?php $saldo= QueryModel::saldoAgen($no_acak);
                                      echo  $saldo['nominal_awal'] ? number_format($saldo['nominal_awal'], 2, ',','.') : 0;
                                ?></p>		
			</div>
			<div class="stats-link">
				<a href="<?= Url::to(['/data-saldo/index-agen'])?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>
        
	<!-- end col-3 -->
	<!-- begin col-3 -->
	
	<!-- end col-3 -->
</div>
