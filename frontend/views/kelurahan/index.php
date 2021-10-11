<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kelurahans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kelurahan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Kelurahan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_kel',
            'id_kec',
            'nama:ntext',
            'id_jenis',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
