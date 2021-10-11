<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RefStatusSipilSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Status Sipils';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-sipil-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ref Status Sipil', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nama_status_sipil',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
