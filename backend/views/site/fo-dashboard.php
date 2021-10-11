<?php
use kartik\grid\GridView;
?>
<!-- begin page-header -->
<h1 class="page-header">Dashboard <small>header small text goes here...</small></h1>
<!-- end page-header -->

<!-- begin row -->
<div class="row">
	<!-- begin col-3 -->
	<div class="col-lg-4 col-md-6">
		<div class="widget widget-stats bg-red">
			<div class="stats-icon"><i class="fa fa-desktop"></i></div>
			<div class="stats-info">
				<h4>PERMOHONAN IZIN BARU</h4>
				<p><?= $pengajuanbaru ?></p>	
			</div>
			<div class="stats-link">
				<a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-lg-4 col-md-6">
		<div class="widget widget-stats bg-grey-darker">
			<div class="stats-icon"><i class="fa fa-users"></i></div>
			<div class="stats-info">
				<h4>PERMOHONAN SELESAI</h4>
				<p><?= $selesai ?></p>	
			</div>
			<div class="stats-link">
				<a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-lg-4 col-md-6">
		<div class="widget widget-stats bg-black-lighter">
			<div class="stats-icon"><i class="fa fa-clock"></i></div>
			<div class="stats-info">
				<h4>TOLAK</h4>
				<p><?= $tolak ?></p>	
			</div>
			<div class="stats-link">
				<a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
</div>
<!-- end row -->
<!-- begin row -->
<div class="row">

	<!-- end col-8 -->
	<!-- begin col-4 -->
	<div class="col-lg-8">
		<!-- begin panel -->
		<div class="panel panel-inverse" data-sortable-id="index-6">
			<div class="panel-heading">
				
								
				<h4 class="panel-title">Data Pemohon Perizinan</h4>
                    
			</div>
			<div class="panel-body">
                            <?=
                            GridView::widget([
                                'dataProvider'=>$dataProvideroff,
                                'columns'=>[
                                    [
                                      'class'=> '\kartik\grid\SerialColumn'  
                                    ],
                                    'no_registrasi',
                                    [
                                        'header'=>'KTP / Nama Pemilik / Nama Perusahaan',
                                        'format'=>'html',
                                        'value'=>function($data){
                                            $ktp = $data['no_ktp'];
                                            $nm_pemohon = $data['nm_pemohon'];
                                            $nm_perusahaan = $data['nm_perusahaan'];
                                            
                                            return $ktp.'<br>'.$nm_pemohon.'<br>'.$nm_perusahaan;
                                        }
                                    ],
                                            [
                                                'class'=> '\kartik\grid\ActionColumn',
                                                'template'=>'{view}',
                                                'buttons'=>[
                                                    'view'=>function($url,$data){
                                        return \yii\helpers\Html::a('Detail', $url, ['class'=>'btn btn-warning']);
                                                    }
                                                ]
                                            ]
                                ]
                            ])
        ?>
			</div>
		</div>
	
	</div>
        <div class="col-lg-4">
		<!-- begin panel -->
		<div class="panel panel-inverse" data-sortable-id="index-6">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title">Data Perizinan Masuk Hari ini (online) </h4>
			</div>
			<div class="panel-body p-t-0">
                            <?=
                            GridView::widget([
                                'dataProvider'=>$dataProvideron,
                                'columns'=>[
                                    [
                                      'class'=> '\kartik\grid\SerialColumn'  
                                    ],
                                    'no_registrasi',
                                    [
                                        'header'=>'KTP / Nama Pemilik / Nama Perusahaan',
                                        'format'=>'html',
                                        'value'=>function($data){
                                            $ktp = $data['no_ktp'];
                                            $nm_pemohon = $data['nm_pemohon'];
                                            $nm_perusahaan = $data['nm_perusahaan'];
                                            
                                            return $ktp.'<br>'.$nm_pemohon.'<br>'.$nm_perusahaan;
                                        }
                                    ],
                                            
                                ]
                            ])
        ?>
			</div>
		</div>
	
	</div>
	<!-- end col-4 -->
</div>
