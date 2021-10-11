<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataPembayaranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Pembayarans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-pembayaran-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Data Pembayaran', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'no_acak',
            'no_invoice',
            'id_metode_transfer',
            'nominal',
            //'from_bank',
            //'tgl_transfer',
            //'tgl_konfirmasi',
            //'filename',
            //'id_status_pembayaran',
            //'id_status_dp',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
