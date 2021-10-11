<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAssetKasir;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\bootstrap4\Modal;

AppAssetKasir::register($this);
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

<div class="wrap">
  

    <div style="margin-left: 10px;margin-right: 10px;">
        <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
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