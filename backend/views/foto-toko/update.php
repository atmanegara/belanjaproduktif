<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\FotoToko */

$this->title = 'Update Foto Toko: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Foto Tokos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="foto-toko-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
