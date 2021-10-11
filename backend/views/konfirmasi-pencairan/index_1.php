<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\KonfirmasiPencairanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Konfirmasi Pencairans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="konfirmasi-pencairan-index">

  


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
            'from_bank',
            //'tgl_ajukan',
            //'id_data_agen',
            //'nominal',
            //'id_status_pembayaran',
            //'jamtgl',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
