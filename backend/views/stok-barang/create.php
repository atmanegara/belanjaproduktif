<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\StokBarang */

$this->title = 'Create Stok Barang';
$this->params['breadcrumbs'][] = ['label' => 'Stok Barangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stok-barang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
