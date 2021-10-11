<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\StokGudang */

$this->title = 'Create Stok Gudang';
$this->params['breadcrumbs'][] = ['label' => 'Stok Gudangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stok-gudang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
