   <?php
use yii\helpers\Url;
use yii\bootstrap4\Html;
use yii\bootstrap4\LinkPager;
?>
<!-- BEGIN search-results -->
<div id="search-results" class="section-container bg-silver">
	<!-- BEGIN container -->
	<div class="container">
		<!-- BEGIN search-container -->
		<div class="search-container">
			<!-- BEGIN search-content -->
			<div class="search-content">
				<!-- BEGIN search-toolbar -->
				<div class="search-toolbar">
					<!-- BEGIN row -->
					<div class="row">
						<div class="col-md-6">
							<h4>Data Pribadi <?= Yii::$app->user->identity->username ?></h4>
						</div>
						<!-- END col-6 -->
						<!-- BEGIN col-6 -->
						<div class="col-md-6 text-right">
							
						</div>
						<!-- END col-6 -->
					</div>
					<!-- END row -->
				</div>
				<!-- END search-toolbar -->
				<!-- BEGIN search-item-container -->
				<div class="search-item-container">
					<!-- BEGIN item-row -->
                            <div class="item-row">
                                <div class='row'>
                                   <div class="col-md-4" style="
    height: 90px;
">
                                       
                                    </div>
                                    <div class='col-md-8'>
                                        <?php
                                        if($model){
                                        echo kartik\detail\DetailView::widget([
                                            'model'=>$model,
                                            'attributes'=>[
                                                'nama','jkel','no_telp','email'
                                            ]
                                        ]);
                                        }else{
                                         echo Html::button('Isi Data Pribadi',['class' => 'btn btn-success showModalButton',
                                             'value'=> Url::to( ['/data-konsumen/create']),
                                             'style'=>'margin-top:10px'
                                             ]);
                                        }
        ?>
                                        <div style='border: 1px red;width: 30px;height: 50'>
                                            <?php
                                            if($modelAlamat){
                                          echo  $modelAlamat['alamat'];
                                            }
?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END item-row -->
					<!-- BEGIN item-row -->

					<!-- END item-row -->
					<!-- BEGIN item-row -->

					<!-- END item-row -->
				</div>
				<!-- END search-item-container -->
				<!-- BEGIN pagination -->
				<div class="text-center">
					
				</div>
				<!-- END pagination -->
			</div>
			<!-- END search-content -->
			<!-- BEGIN search-sidebar -->
			<div class="search-sidebar">
                            <h4 class="title">DATA PRIBADI</h4>
				<ul class="search-category-list">
                                    <li><a href="<?= Url::to(['/data-konsumen']) ?>">Data Profil</a></li>
                            <li><a href="<?= Url::to(['/alamat-konsumen']) ?>">Alamat</a></li>
                               
                        </ul>
                            

			</div>
                   
                        <div class="search-sidebar">
                      
				<h4 class="title">PESANAN</h4>
				<ul class="search-category-list">
                                    <li><a href="<?= Url::to(['/produk/semua-checkout']) ?>">Checkout<span class="pull-right">(<?=$dataItemSelesaiCheckout?>)</span></a></li>
                                    <li><a href="<?= Url::to(['/produk/semua']) ?>">Semua<span class="pull-right">(<?=$dataItemSelesai?>)</span></a></li>
                            <li><a href="<?= Url::to(['/produk/konfirmasi-bayar']) ?>">Menunggu Konfirmasi Pembayaran <span class="pull-right">(<?=$dataItemSelesaipembayaran?>)</span></a></li>
                            <li><a href="<?= Url::to(['/produk/verifikasi']) ?>">Pesanan Diproses <span class="pull-right">(<?=$dataItemverifikasi?>)</span></a></li>
                            <li><a href="<?= Url::to(['#']) ?>">Pesanaan Dikirim<span class="pull-right"></span></a></li>
                        </ul>

			</div>
			<!-- END search-sidebar -->
		</div>
		<!-- END search-container -->
	</div>
	<!-- END container -->
</div>
<!-- END search-results -->
