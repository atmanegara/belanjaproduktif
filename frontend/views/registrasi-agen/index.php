<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RegistrasiAgenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registrasi Agens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registrasi-agen-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Registrasi Agen', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'no_reg',
            'nik',
            'nama',
            'alamat:ntext',
            //'rt_rw',
            //'id_ref_kelurahan',
            //'id_ref_kecamatan',
            //'nope',
            //'id_ref_agen',
            //'id_ref_proses_pendaftaran',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
