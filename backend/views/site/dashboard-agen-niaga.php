<?php
use yii\bootstrap4\Html;
use yii\helpers\Url;
use backend\models\QueryModel;
      $no_acak=Yii::$app->user->identity->no_acak; 
?>

<h1 class="page-header">Dashboard </h1>
<!-- end page-header -->
<?php if(!$dataAgen){ ?>
<div class="row">
    <div class="col-md-12">
    <div class="note note-danger note-with-right-icon m-b-15">
								<div class="note-icon"><i class="fa fa-lightbulb"></i></div>
								<div class="note-content text-left">
									<h4><b>PETUNJUK AKTIVASI MEMBER / MITRA BELANJA PRODUKTI</b></h4>
                                                                        <ol type="1">
                                                                            <li>Isi biodata Pribadi pada Menu [ Data Agen >  Data Pribadi ]</li>
                                                                            <li>Kirim Data Biodata Pribadi anda ke admin BP untuk dilakukan konfirmasi ulang untuk validasi ke agen</li>
                                                                        </ol>
                                                                        <p>
                                                                            JIKA DATA PRIBADI TIDAK DIKIRIM BEBERAPA MENU TIDAK AKTIF / TIDAK BISA DILAKUKAN
                                                                        </p>
								</div>
							</div>
    </div>
</div>
<?php
} ?>
<!-- begin row -->
<div class="row">
    <div class="col-lg-3 col-md-6">
		<div class="widget widget-stats bg-orange">
			<div class="stats-icon"><i class="fa fa-users"></i></div>
			<div class="stats-info">
				<h4>ANGGOTA</h4>
				<p><?=$jumanggotaAgen?></p>	
			</div>
			<div class="stats-link">
				<a href="<?= Url::to(['/data-anggota'])?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>
    
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
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-lg-3 col-md-6">
		<div class="widget widget-stats bg-orange">
			<div class="stats-icon"><i class="fa fa-money-bill-wave-alt"></i></div>
			<div class="stats-info">
				<h4>KOMISI</h4>
                                <p><?php $komisi = QueryModel::komisiAgen($no_acak);
                                    echo  $komisi['nominal'] ? number_format($komisi['nominal'], 2, ',','.') : 0;
                                ?></p>	
			</div>
			<div class="stats-link">
				<a href="<?= Url::to(['/data-komisi/index-agen'])?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-lg-3 col-md-6">
		<div class="widget widget-stats bg-grey-darker">
			<div class="stats-icon"><i class="fa fa-money-bill-wave-alt"></i></div>
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
          <div class="col-lg-8 col-sm-8">
                <div class="panel panel-black">
                    <div class="panel-body">
                        <div class="widget-chart-info">
						<h4 class="widget-chart-info-title">Program : <?=$progressprogram['nama_program']?></h4>
						<p class="widget-chart-info-desc">Pencapaian Program</p>
						<div class="widget-chart-info-progress">
							<b>Progress Pencapaian</b>
							<span class="pull-right"><?= number_format($progressprogram['persen'])?>%</span>
						</div>
						<div class="progress rounded-corner">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated rounded-corner" style="width:<?= number_format($progressprogram['persen'])?>%;"></div>
						</div>
					</div>       
                    </div>
                </div>
         
         
            </div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	
	<!-- end col-3 -->
</div>
