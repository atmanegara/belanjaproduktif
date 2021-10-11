<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RefSatuanBarang */

$this->title = 'Update Ref Satuan Barang: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Satuan Barangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-satuan-barang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
