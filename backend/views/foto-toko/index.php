<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FotoTokoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Foto Tokos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="foto-toko-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Foto Toko', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_data_toko',
            'filename',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
