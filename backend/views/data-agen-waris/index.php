<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataAgenWarisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Agen Waris';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-agen-waris-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Data Agen Waris', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_data_agen',
            'nama_waris',
            'nope_waris',
            'jns_bank',
            //'atas_nama_bank',
            //'norek_bank',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
