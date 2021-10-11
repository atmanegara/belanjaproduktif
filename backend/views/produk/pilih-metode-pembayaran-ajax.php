    <div class="widget-header">
        <h4 class="widget-header-title">Metode Pembayaran</h4><!-- ` -->
    </div>

 
<div class="widget-list widget-chart-content" data-id="widget">

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