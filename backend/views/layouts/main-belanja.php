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

        <title>Belanja Produktif,  <?= date("D, F j, Y") ?></title>
        
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
            	<div class="widget widget-rounded m-b-30" data-id="widget">
						<!-- begin widget-header -->
						<div class="widget-header">
							<h4 class="widget-header-title">Halaman Belanja Produk</h4>
							
						</div>
						<!-- end widget-header -->
						<!-- begin vertical-box -->
						<div class="vertical-box with-grid with-border-top">
							
							<!-- end vertical-box-column -->
							<!-- begin vertical-box-column -->
							<div class="vertical-box-column p-15" style="width: 20%;">
								<div class="widget-chart-info">
									<h4 class="widget-chart-info-title">Menu Belanja</h4>
										<ul class="nav nav-inbox">
                                                                                            <li class="active"><a href="<?=Url::to(['/produk/search-produk'])?>" ><i class="fa fa-th-large fa-fw m-r-5"></i>Produk Item Belanja<span class="badge pull-right"></span></a></li>
												<li><a href="<?=Url::to(['/produk/list-keranjang'])?>"><i class="fa fa-shopping-cart fa-fw m-r-5"></i>Keranjang</a></li>
												<li><a href="<?=Url::to(['/produk/list-keranjang-terpilih'])?>"><i class="fa fa-shopping-bag fa-fw m-r-5"></i>Checkout</a></li>
											
											</ul>
								</div>
								<hr />
								<div class="widget-chart-info">
									<h4 class="widget-chart-info-title">Riwayat Belanja</h4>
									<p class="widget-chart-info-desc">Riwayat Transaksi Belanja</p>
									<ul class="nav nav-inbox">
												<li><a href="<?=Url::to(['/produk/list-checkout-payment'])?>"><i class="fa fa-fw f-s-10 m-r-5 fa-circle text-inverse"></i> Semua</a></li>
												<!--<li><a href="<?=Url::to(['/produk/list-checkout-payment?status_pembayaran=1'])?>"><i class="fa fa-fw f-s-10 m-r-5 fa-circle text-primary"></i> Menunggu Konfirmasi</a></li>-->
												<li><a href="<?=Url::to(['/belanja/list-pesanan-cod','id_metode_pembayaran'=>'2'])?>"><i class="fa fa-fw f-s-10 m-r-5 fa-circle text-success"></i> Lacak Pesanan</a></li>
												<li><a href="<?=Url::to(['/belanja/list-pesanan'])?>"><i class="fa fa-fw f-s-10 m-r-5 fa-circle text-danger"></i>Pesanan Selesai</a></li>
											</ul>
								</div>
							</div>
                                                        <!-- begin vertical-box-column -->
							<div class="vertical-box-column widget-chart-content">
								                                                           <?= Alert::widget() ?>
                   <?= $content ?>
							</div>
							<!-- end vertical-box-column -->
						</div>
						<!-- end vertical-box -->
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
		//	Dashboard.init();
		});
	</script>
