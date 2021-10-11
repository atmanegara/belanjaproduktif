<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Addcarts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="addcart-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Addcart', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'no_invoice',
            'no_acak',
            'id_data_barang',
            'id_data_agen',
            //'qty',
            //'tgl_masuk',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
