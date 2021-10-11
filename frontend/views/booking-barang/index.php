<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Booking Barangs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-barang-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Booking Barang', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_stok_barang',
            'qty_keluar',
            'no_invoice',
            'no_acak',
            //'status_booking',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
