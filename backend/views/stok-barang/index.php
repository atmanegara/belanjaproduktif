<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StokBarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stok Barangs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stok-barang-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Stok Barang', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tgl_masuk',
            'id_data_agen',
            'id_data_barang',
            'stok_awal',
            //'stok_masuk',
            //'stok_keluar',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
