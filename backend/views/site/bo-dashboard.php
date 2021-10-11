<!-- begin page-header -->
<h1 class="page-header">Dashboard <small>header small text goes here...</small></h1>
<!-- end page-header -->

<!-- begin row -->
<div class="row">
	<!-- begin col-3 -->
	<div class="col-lg-3 col-md-6">
		<div class="widget widget-stats bg-red">
			<div class="stats-icon"><i class="fa fa-desktop"></i></div>
			<div class="stats-info">
				<h4>PERMOHONAN IZIN BARU</h4>
				<p><?= $dataPermohonanPusat ?></p>	
			</div>
			<div class="stats-link">
				<a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-lg-3 col-md-6">
		<div class="widget widget-stats bg-orange">
			<div class="stats-icon"><i class="fa fa-link"></i></div>
			<div class="stats-info">
				<h4>PERMOHONAN IZIN BARU (ONLINE)</h4>
				<p><?= $dataPermohonanOnline ?></p>	
			</div>
			<div class="stats-link">
				<a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-lg-3 col-md-6">
		<div class="widget widget-stats bg-grey-darker">
			<div class="stats-icon"><i class="fa fa-users"></i></div>
			<div class="stats-info">
				<h4>PERMOHONAN SELESAI (No SK Terbit)</h4>
			<p><?= $dataPermohonanSelesai ?></p>	
			</div>
			<div class="stats-link">
				<a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
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
			<p><?= $dataPermohonanTolak ?></p>	
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
				
				<h4 class="panel-title">Data Perizinan</h4>
			</div>
			<div class="panel-body p-t-0">
				<div class="table-responsive">
					<table class="table table-valign-middle">
						<thead>
							<tr>	
								<th>Source</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><label class="label label-danger">Perizinan Yang Masih Berlaku</label></td>
								<td><?= $skBerlaku ?><span class="text-success"><i class="fa fa-arrow-up"></i></span></td>
							</tr>
							<tr>
								<td><label class="label label-warning">Perizinan Yang Habis Berlaku</label></td>
								<td><?= $skHabis ?></td>
							</tr>
							<tr>
								<td><label class="label label-success">Perizinan Yang Sudah Dicabut</label></td>
								<td><?= $skCabut ?></td>
							</tr>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- end panel -->
		
		<!-- begin panel -->
		
		<!-- end panel -->
		
		<!-- begin panel -->
		
		<!-- end panel -->
		
		<!-- begin panel -->
		
		<!-- end panel -->
		
		<!-- begin panel -->
		
		<!-- end panel -->
	</div>
	<!-- end col-4 -->
</div>
