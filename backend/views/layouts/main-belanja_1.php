<?php
/* @var $this \yii\web\View */
/* @var $content string */

use common\widgets\Alert;
use yii\helpers\Html;
use backend\assets\AppAsset;
use yii\bootstrap4\Modal;
use yii\helpers\Url;
use  backend\models\DataBarang;
!empty($viewPath) || $viewPath = '@app/views/layouts';
!empty($viewHeader) || $viewHeader = $viewPath . '/_header';
!empty($viewSidebar) || $viewSidebar = $viewPath . '/_sidebar';
//!empty($viewContent) || $viewContent = $viewPath . '/_content';
//AceAsset::register($this);
AppAsset::register($this);

$no_acak = Yii::$app->user->identity->no_acak;
$id_data_agen = (new yii\db\Query())
        ->select('a.id')
        ->from('data_agen a')
        ->innerJoin('data_anggota b','b.no_acak_agen=a.no_acak')->where(['b.no_acak'=>$no_acak])->one();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        
        <?php $this->head() ?>
    </head>

    <?php $this->beginBody() ?>
    <body>

        <?php if (Yii::$app->controller->action->id == 'login') { ?>
            <div class="login-content" >    
                <?= $content ?>
            </div>
            <?php
        } else {
            ?>
            <div id="page-loader" class="fade show"><span class="spinner"></span></div>
        <div id="page-container" class="fade page-sidebar-fixed page-header-fixed page-content-full-height">
           
                <?= $this->render($viewHeader) ?>
                <?= $this->render($viewSidebar) ?>
                <!-- begin #content -->
     	<div id="content" class="content content-full-width inbox">  
            <div class="vertical-box with-grid">
		        <!-- begin vertical-box-column -->
		        <div class="vertical-box-column width-200 bg-silver hidden-xs">
		        	<!-- begin vertical-box -->
		        	<div class="vertical-box">
						<!-- begin wrapper -->
						<div class="wrapper bg-silver text-center">
                                                    <a href="<?= Url::to(["produk/search-produk"]) ?>" class="btn btn-inverse p-l-40 p-r-40 btn-sm">
								HALAMAN <br> BELANJA
							</a>
						</div>
						<!-- end wrapper -->
						<!-- begin vertical-box-row -->
						<div class="vertical-box-row">
							<!-- begin vertical-box-cell -->
							<div class="vertical-box-cell">
								<!-- begin vertical-box-inner-cell -->
								<div class="vertical-box-inner-cell">
									<!-- begin scrollbar -->
									<div data-scrollbar="true" data-height="100%">
										<!-- begin wrapper -->
										<div class="wrapper p-0">
											<div class="nav-title"><b>FOLDERS</b></div>
											<ul class="nav nav-inbox">
                                                                                            <li class="active"><a href="<?=Url::to(['/produk/search-produk'])?>" ><i class="fa fa-th-large fa-fw m-r-5"></i>Produk Item Belanja<span class="badge pull-right"></span></a></li>
												<!--<li><a href="<?=Url::to(['/produk/checkout'])?>"><i class="fa fa-flag fa-fw m-r-5"></i>Keranjang</a></li>-->
												<li><a href="<?=Url::to(['/produk/list-checkout-payment?status_pembayaran=3'])?>"><i class="fa fa-shopping-bag fa-fw m-r-5"></i>Keranjang</a></li>
											
											</ul>
											<div class="nav-title"><b>Daftar Transaksi</b></div>
											<ul class="nav nav-inbox">
												<li><a href="<?=Url::to(['/produk/list-checkout-payment'])?>"><i class="fa fa-fw f-s-10 m-r-5 fa-circle text-inverse"></i> Semua</a></li>
												<!--<li><a href="<?=Url::to(['/produk/list-checkout-payment?status_pembayaran=1'])?>"><i class="fa fa-fw f-s-10 m-r-5 fa-circle text-primary"></i> Menunggu Konfirmasi</a></li>-->
												<li><a href="<?=Url::to(['/belanja/list-pesanan-cod','id_metode_pembayaran'=>'2'])?>"><i class="fa fa-fw f-s-10 m-r-5 fa-circle text-success"></i> Lacak Pesanan</a></li>
												<li><a href="<?=Url::to(['/belanja/list-pesanan'])?>"><i class="fa fa-fw f-s-10 m-r-5 fa-circle text-danger"></i>Pesanan Selesai</a></li>
											</ul>
										</div>
										<!-- end wrapper -->
									</div>
									<!-- end scrollbar -->
								</div>
								<!-- end vertical-box-inner-cell -->
							</div>
							<!-- end vertical-box-cell -->
						</div>
						<!-- end vertical-box-row -->
					</div>
					<!-- end vertical-box -->
		        </div>
		        <!-- end vertical-box-column -->
		        <!-- begin vertical-box-column -->
		        <div class="vertical-box-column bg-white">
		        	<!-- begin vertical-box -->
		        	<div class="vertical-box">
						<!-- begin wrapper -->
						<div class="wrapper bg-silver-lighter">
							<!-- begin btn-toolbar -->
						
						</div>
						<!-- end wrapper -->
						<!-- begin vertical-box-row -->
						<div class="vertical-box-row">
							<!-- begin vertical-box-cell -->
							<div class="vertical-box-cell">
								<!-- begin vertical-box-inner-cell -->
								<div class="vertical-box-inner-cell">
                                                                    <div data-scrollbar="true" data-height="100%">
                                                                           <?= Alert::widget() ?>
                   <?= $content ?>
                                                                        
                                                                    </div>
								</div>
								<!-- end vertical-box-inner-cell -->
							</div>
							<!-- end vertical-box-cell -->
						</div>
						<!-- end vertical-box-row -->
						<!-- begin wrapper -->
						<div class="wrapper bg-silver-lighter clearfix">
							<div class="btn-group pull-right">
								<button class="btn btn-white btn-sm">
									<i class="fa fa-chevron-left f-s-14 t-plus-1"></i>
								</button>
								<button class="btn btn-white btn-sm">
									<i class="fa fa-chevron-right f-s-14 t-plus-1"></i>
								</button>
							</div>
							
						</div>
						<!-- end wrapper -->
					</div>
					<!-- end vertical-box -->
		        </div>
		        <!-- end vertical-box-column -->
		    </div>
                </div>
        </div>
        <?php } ?>
    </body>

    <?php $this->endBody() ?>
</html>
<?php 
$this->endPage();

?>
<?php
Modal::begin([
    'options' => [
        'id' => 'modal',
    ],
       'title' => 'Form Dialog',
    'size' => 'modal-lg',
    
]);
echo "<div class='panel panel-inverse'> <div class='panel-heading'>+</div><div class='panel-body  text-white'>"
. "<div id='modelContent'></div></div></div>";
Modal::end();
?>
	<script>
		$(document).ready(function() {
			App.init();
			Dashboard.init();
		});
	</script>
