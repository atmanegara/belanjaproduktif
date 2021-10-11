<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RefSaldoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Saldos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-saldo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ref Saldo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_ref_agen',
            'nominal',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
