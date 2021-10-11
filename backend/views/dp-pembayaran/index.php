<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dp Pembayarans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dp-pembayaran-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Dp Pembayaran', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'no_acak',
            'id_franchice',
            'id_status_dp',
            'tahap_dp',
            //'nominal',
            //'uang_muka',
            //'sisa',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
