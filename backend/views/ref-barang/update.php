<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RefBarang */

$this->title = 'Update Ref Barang: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Barangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-barang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
