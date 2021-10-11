<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detail Pembayaran Kurirs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-pembayaran-kurir-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Detail Pembayaran Kurir', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'no_invoice',
            'id_data_kurir',
            'status_pesanan_kurir',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
