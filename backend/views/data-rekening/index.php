<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataRekeningSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Rekenings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-rekening-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Data Rekening', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'no_acak',
            'id_ref_bank',
            'no_rek',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
