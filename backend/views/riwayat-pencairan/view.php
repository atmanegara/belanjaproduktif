<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\RiwayatPencairan */

$this->title = $model->no_acak_arsip;
$this->params['breadcrumbs'][] = ['label' => 'Riwayat Pencairans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="riwayat-pencairan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->no_acak_arsip], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->no_acak_arsip], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'no_acak_arsip',
            'tgl_pencairan',
            'id',
            'no_acak',
            'no_invoice',
            'id_metode_transfer',
            'from_bank',
            'tgl_ajukan',
            'tgl_verifikasi',
            'id_data_agen',
            'nominal',
            'id_status_pembayaran',
            'id_ket',
            'status_pencarian',
            'pencarian_sbg',
            'jamtgl',
        ],
    ]) ?>

</div>
