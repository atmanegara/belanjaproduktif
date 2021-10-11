<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Konsumens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-konsumen-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::button('Create Data Konsumen',  ['class' => 'btn btn-success showModalButton',
            'value'=> \yii\helpers\Url::to(['create'])
            ]) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'no_acak',
            'nama',
            'jkel',
            'no_telp',
            //'email:email',
            //'filename',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
