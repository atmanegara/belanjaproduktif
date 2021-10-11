<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataBarangKeluarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Barang Keluars';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-barang-keluar-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Data Barang Keluar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_data_barang',
            'qty',
            'harga',
            'tgl_keluar',
            //'tgl_input',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
