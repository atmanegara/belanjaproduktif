<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\DataPembayaran */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Data Pembayarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="data-pembayaran-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'no_acak',
            'no_invoice',
            'id_metode_transfer',
            'nominal',
            'from_bank',
            'tgl_transfer',
            'tgl_konfirmasi',
            'filename',
            'id_status_pembayaran',
            'id_status_dp',
        ],
    ]) ?>

</div>
