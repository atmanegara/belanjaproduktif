<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detail Program Agens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-program-agen-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Detail Program Agen', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_program_agen',
            'tgl_awal',
            'tgl_akhir',
            'ket',
            //'aktif',
            //'tahunke',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
