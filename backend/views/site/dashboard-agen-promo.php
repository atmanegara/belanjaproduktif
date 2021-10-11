<?php
use yii\bootstrap4\Html;
use yii\helpers\Url;
use backend\models\QueryModel;

        $no_acak = Yii::$app->user->identity->no_acak;
?>

<!-- begin page-header -->
<h1 class="page-header">Dashboard</h1>
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
}
$no_acak=Yii::$app->user->identity->no_acak;
           
if($id_status_dp=='1'){
    ?>
<div class="panel panel-inverse" data-sortable-id="ui-general-3">
                    	<!-- begin panel-heading -->
                        <div class="panel-heading ui-sortable-handle">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Notes</h4>
                        </div>
                    	<!-- end panel-heading -->
                    	<!-- begin panel-body -->
                        <div class="panel-body">
							<div class="note note-warning m-b-15">
								<div class="note-icon"><i class="fa fa-bullhorn"></i></div>
								<div class="note-content">
									<h4><b>INFORMASI</b></h4>
									<p>
										AKUN ANDA SEMENTARA DI TUTUP UNTUK AKSES BUKA TOKO, SALDO, KOMISI DAN POGRAM UMROH, HARAP LAKUKAN PELUSANAN PEMBAYARAN PENDAFTARAN MITRA
									</p>
                                                                        <p>
                                                                            *<i>Informasi lebih lanjut bisa hubungi pihak admin BP</i>
                                                                        </p>
								</div>

							</div>
							
                        </div>
                        <div class="panel-footer">
                     <?= Html::button("<i class='fa fa-print t-plus-1 fa-fw fa-lg'></i> Konfirmasi Pembayaran",['class'=>'btn btn-sm btn-success m-b-10 p-l-5 showModalButton',
			    'value'=>Url::to(['konfirmasi-pembayaran/konfirmasi-dp','no_acak'=>$no_acak]),
			    
			]) ?>   </div>
                    	<!-- end hljs-wrapper -->
                    </div>
<?php
}else{
?>
<!-- begin row -->
<div class="row">
	<!-- begin col-3 -->
	<div class="col-lg-3 col-md-6">
		<div class="widget widget-stats bg-red">
			<div class="stats-icon"><i class="fa fa-desktop"></i></div>
			<div class="stats-info">
				<h4>ITEM BARANG</h4>
                                <p><?= \backend\models\DataBarang::getCountItem($no_acak)?></p>	
			</div>
			<div class="stats-link">
                            <a href="<?= Url::to(['/data-barang/list-barang'])?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-lg-3 col-md-6">
		<div class="widget widget-stats bg-orange">
			<div class="stats-icon"><i class="fa fa-link"></i></div>
			<div class="stats-info">
				<h4>ANGGOTA</h4>
				<p><?=$jumanggotaAgen?></p>	
			</div>
			<div class="stats-link">
				<a href="<?= Url::to(['/data-anggota'])?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-lg-3 col-md-6">
		<div class="widget widget-stats bg-grey-darker">
			<div class="stats-icon"><i class="fa fa-users"></i></div>
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
		<div class="widget widget-stats bg-black-lighter">
			<div class="stats-icon"><i class="fa fa-clock"></i></div>
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
</div>
   <div class="row row-space-10">
        <div class="col-lg-4 col-sm-4">
            <div class="widget widget-stats bg-yellow">
			<div class="stats-icon"><i class="fa fa-chart-area"></i></div>
			<div class="stats-info">
				<h4>PESANAN BARANG</h4>
                              
			</div>
			<div class="stats-link">
				<a href="<?= Url::to(['/booking-barang'])?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
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
        </div>
<?php }?>