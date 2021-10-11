    <div class="widget-header">
        <h4 class="widget-header-title">Metode Pembayaran</h4><!-- ` -->
    </div>

 
 

<div class="widget-list widget-list-rounded m-b-30  widget-chart-content" data-id="widget">
       <div class='panel panel-inverse'>
        <div class="panel-body">
            <dl class="dl-horizontal">
  <dt class="text-inverse">APLIKASI  </dt>
  <dd>Pembayaran menggunakan metode <b>APLIKASI</b>, maka pembayaran akan dilakukan pemotongan di komisi</dd>
  <dt class="text-inverse">COD</dt>
  <dd>Pembayaran menggunakan metode <b>COD</b>, akan menggunakan Jasa Ojek yang tergabung dengan mintra CV. Belanja Produktif</dd>
  <dt class="text-inverse">DI TOKO</dt>
  <dd>Pembayaran menggunakan metode <b>DI TOKO</b>, item belanja akan menggunakan sistem booking, pembayaran akan dilakukan di TOKO Mitra</dd>
</dl>
   
        </div>
    </div>
    
<?php foreach($model as $modelMetode){ 
       $url = \yii\helpers\Url::to(['/produk/checkout','id_metode_pembayaran'=>$modelMetode['id']]);
    ?>
						<a href="<?= $url?>" class="widget-list-item">
							<div class="widget-list-media icon">
								<i class="fa <?=$modelMetode['icon']?> bg-inverse text-white"></i>
							</div>
							<div class="widget-list-content">
								<h4 class="widget-list-title"><?=$modelMetode['ket']?></h4>
							</div>
							<div class="widget-list-action text-right">
								<i class="fa fa-angle-right fa-lg text-muted"></i>
							</div>
						</a>
<?php } ?>	
					</div>