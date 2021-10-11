<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap4\Modal;
use common\component\TentangKamiComponent;

$dataTentangKami =  Yii::$app->tentangkami->getDataTentangKami();
$detailTentangKami =  Yii::$app->tentangkami->getDetailTentangKami();
$this->title = '.:. Belanja Produktif';
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
<?php $this->beginBody() ?>

 
<?= $this->render( '@app/views/layouts'.'/menu.php') ?>
        <?= $content ?>


 <!-- BEGIN #footer -->
        <div id="footer" class="footer">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN row -->
                <div class="row">
                    <!-- BEGIN col-3 -->
                    <div class="col-md-3">
                        <h4 class="footer-header">Tentang Kami</h4>
                        <p>
 <?=$detailTentangKami['header']?></p>           </div>
                    <!-- END col-3 -->
                   <div class='col-md-3'>
                   </div>
                   <div class='col-md-3'>
                   </div>
                    <!-- BEGIN col-3 -->
                    <div class="col-md-3">
                        <h4 class="footer-header">Hubungi Kami</h4>
                        <address>
                            <strong><?=$dataTentangKami['nama_cv'] ?></strong><br />
                          <?= $dataTentangKami['alamat_cv'] ?>
                            <br />
                            NO. SIUP  : <?= $dataTentangKami['no_siup'] ?>
                            <br />
                            Telp. Kantor    <?= $dataTentangKami['telp_cv'] ?> <br />
                            <abbr title="Phone">Admin:</abbr> <?= $dataTentangKami['telp_admin'] ?><br />
                            <abbr title="Fax">Customer Service:</abbr> <?= $dataTentangKami['telp_marketting'] ?><br />
                            <abbr title="Email">Email:</abbr> <a href="mailto:<?= $dataTentangKami['email'] ?>"><?= $dataTentangKami['email'] ?></a><br />
                            No. Rekening <br />
                            <?=$dataTentangKami['kontak_lainnya']?>
                        </address>
                    </div>
                    <!-- END col-3 -->
                </div>
                <!-- END row -->
            </div>
            <!-- END container -->
        </div>
        <!-- END #footer -->
    
        <!-- BEGIN #footer-copyright -->
        <div id="footer-copyright" class="footer-copyright">
            <!-- BEGIN container -->
            <div class="container">
                
                <div class="copyright">
                    Copyright &copy; 2017 SeanTheme. All rights reserved.
                </div>
            </div>
            <!-- END container -->
        </div>
        <!-- END #footer-copyright -->
 
<?php $this->endBody() ?>
      <?php
Modal::begin([
    'size' => 'modal-md','title' => '<h4>Form</h4>',
    'id' => 'model',
'clientOptions' => ['backdrop' => 'static', 'keyboard' => false]
]);
echo "<div id='modelContent'></div>";
Modal::end();
?> 
</body>
</html>

<?php $this->endPage() ?>
