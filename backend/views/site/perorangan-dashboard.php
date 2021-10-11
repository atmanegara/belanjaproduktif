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
				<h4>PENGAJUAN BARU</h4>
				<p><?=$pengajuanbaru ?></p>	
			</div>
			<div class="stats-link">
				<a href="#dashboard/index?detail=baru">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-lg-3 col-md-6">
		<div class="widget widget-stats bg-orange">
			<div class="stats-icon"><i class="fa fa-link"></i></div>
			<div class="stats-info">
				<h4>VERIFIKASI Berkas</h4>
				<p><?=$verifikasi ?></p>	
			</div>
			<div class="stats-link">
				<a href="#dashboard/index?detail=verifikasi">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
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
				<p><?=$selesai ?></p>	
			</div>
			<div class="stats-link">
				<a href="#dashboard/index?detail=selesai">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
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
				<p><?=$tolak?></p>	
			</div>
			<div class="stats-link">
				<a href="#dashboard/index?detail=tolak">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
       
</div>
<div class="row">
    <div class="col-md-12">
     <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">Kotak Dialog Informasi Proses Perizinan</h4>
            </div>
            <div class="panel-body">
                <?= \yii\bootstrap\Html::textInput('no_reg', null,[
                    'id'=>'no_reg',
                    'placeholder'=>'Masukkan No Register dengan Benar',
                    'class'=>'form-control'
                ]) ?>
                <br>
                <?= \yii\bootstrap\Html::button('Lacak',[
                    'class'=>'btn btn-primary',
                    'onClick'=>"cari()"
                ])?>
                <div id="lacak">
                    
                </div>
            </div>
        </div>
        
    </div>
</div>
<!-- end row -->
<script>
    function cari(){ 
        var no_reg = $("#no_reg").val();
        
        var posting = $.post("<?= yii\helpers\Url::to(['cari-noreg']) ?>",{
    no_reg : no_reg        
    })
    posting.fail(function(){
        console.log('error')
    })
    posting.done(function(){
        console.log('done')
    })
      posting.always(function(ohtml){
   $("#lacak").html(ohtml)
    })
    
    }
    </script>