<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StokGudangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stok Gudangs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stok-gudang-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Stok Gudang', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_ref_gudang',
            'id_ref_barang',
            'qty',
            'harga_satuan',
            //'harga_jual',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
