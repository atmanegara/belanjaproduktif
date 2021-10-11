<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\StokGudang */

$this->title = 'Update Stok Gudang: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Stok Gudangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="stok-gudang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
