<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BookingBarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Booking Barangs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-barang-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Booking Barang', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'kd_booking',
            'id_stok_barang',
            'qty_keluar',
            'no_invoice',
            //'no_acak',
            //'tgl_batas_book',
            //'jam_batas_book',
            //'status_booking',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
