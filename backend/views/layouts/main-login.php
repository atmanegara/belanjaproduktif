<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\widgets\Alert;
use yii\helpers\Html;
use backend\assets\AppAsset;

!empty($viewPath) || $viewPath = '@app/views/layouts';
!empty($viewHeader) || $viewHeader = $viewPath . '/_header';
!empty($viewSidebar) || $viewSidebar = $viewPath . '/_sidebar';
//!empty($viewContent) || $viewContent = $viewPath . '/_content';
//AceAsset::register($this);
AppAsset::register($this);
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
    <body class="pace-top bg-brown  pace-done">

            <div id="page-container" class="page-header-fixed">
     
                <?= $content  ?>
        
                
            </div>     <!-- end #content -->

    </body>

    <?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>
<script>
    $(document).ready(function () {
        App.init({
            ajaxMode: true,
            ajaxDefaultUrl: '<?= \yii\helpers\Url::to(['/site/login']) ?>',
            ajaxType: 'GET',
            ajaxDataType: 'html'
        });
    });
</script>