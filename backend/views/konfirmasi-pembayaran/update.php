<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\KonfirmasiPembayaran */

$this->title = 'Update Konfirmasi Pembayaran: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Konfirmasi Pembayarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="konfirmasi-pembayaran-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
