<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TentangKamiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tentang Kamis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tentang-kami-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tentang Kami', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nama_cv',
            'no_siup',
            'telp_cv',
            'alamat_cv',
            //'kontak_lainnya',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
