<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\db\Query;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap4\Modal;

$no_acak=Yii::$app->user->identity->no_acak;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ;
                //$jumlah semua selesai
      $dataItemSelesai =(new Query())
                ->select('a.id_data_barang,a.no_acak,b.item_barang,a.id,b.filename')
                ->from('checkout_item a')
                ->innerJoin('data_barang b','a.id_data_barang=b.id')
                ->innerJoin('pembayaran_jualbeli c','c.no_invoice=a.no_invoice and c.id_status_pembayaran=2')
              ->groupBy('a.no_invoice,a.no_acak')->where(['a.no_acak'=>$no_acak])->count();
      
                      //$jumlah barang belum isi data pengiriman
      $dataItemSelesaiCheckout =(new Query())
                ->select('a.id_data_barang,a.no_acak,b.item_barang,a.id,b.filename')
                ->from('checkout_item a')
                ->innerJoin('data_barang b','a.id_data_barang=b.id')
              ->groupBy('a.no_invoice,a.no_acak')->where(['a.no_acak'=>$no_acak])->count();
//jumlah item menunggu pembayaran
       $dataItemSelesaipembayaran =(new Query())
                ->select('a.id_data_barang,a.no_acak,b.item_barang,a.id,b.filename')
                ->from('checkout_item a')
                ->innerJoin('data_barang b','a.id_data_barang=b.id')
                ->innerJoin('pembayaran_jualbeli c','c.no_invoice=a.no_invoice and c.id_status_pembayaran=3')
              ->groupBy('a.no_invoice,a.no_acak')->where(['a.no_acak'=>$no_acak])->count();
    ///item terverifikasi
        $dataItemverifikasi =(new Query())
                ->select('a.id_data_barang,a.no_acak,b.item_barang,a.id,b.filename')
                ->from('checkout_item a')
                ->innerJoin('data_barang b','a.id_data_barang=b.id')
                ->innerJoin('pembayaran_jualbeli c','c.no_invoice=a.no_invoice and c.id_status_pembayaran=1')
              ->groupBy('a.no_invoice,a.no_acak')->where(['a.no_acak'=>$no_acak])->count();
        
        ?>

		<?= $this->renderAjax( '@app/views/layouts'.'/menu.php') ?>


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
                               <?= $content ?>
                                      <?php
Modal::begin([
    'size' => 'modal-md','title' => '<h4>Form</h4>',
    'id' => 'model',
'clientOptions' => ['backdrop' => 'static', 'keyboard' => false]
]);
echo "<div id='modelContent'></div>";
Modal::end();
?> 
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
                                    <li><a href="<?= Url::to(['/produk/semua']) ?>">Semua Selesai<span class="pull-right">(<?=$dataItemSelesai?>)</span></a></li>
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
</body>
</html>

<?php $this->endPage() ?>