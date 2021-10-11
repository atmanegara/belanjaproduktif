<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RiwayatPencairan */

$this->title = 'Update Riwayat Pencairan: ' . $model->no_acak_arsip;
$this->params['breadcrumbs'][] = ['label' => 'Riwayat Pencairans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->no_acak_arsip, 'url' => ['view', 'id' => $model->no_acak_arsip]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="riwayat-pencairan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
