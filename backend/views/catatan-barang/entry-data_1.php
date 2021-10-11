<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CatatanBarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Catatan Barangs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catatan-barang-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Catatan Barang', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_ref_barang',
            'id_ref_satuan',
            'qty',
            'id_data_agen',
            //'id_ref_suplier',
            //'tgl_pemesanan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
