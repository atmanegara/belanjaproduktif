<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DataBagiHasilSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Bagi Hasils';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-bagi-hasil-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Data Bagi Hasil', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'no_acak',
            'no_acak_tutup_buku',
            'tgl_masuk',
            'id_ref_agen',
            //'persen',
            //'hasil',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
