<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataAgenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Agens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-agen-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::button('Create Data Agen',[
            'class' => 'btn btn-success showModalButton',
            'value'=>Url::to(['create','no_acak'=>$no_acak])
            
        ]) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_agen',
            'id_ref_agen',
            'nama_agen',
            'nik',
            //'alamat:ntext',
            //'rt',
            //'rw',
            //'id_ref_kelurahan',
            //'id_ref_kecamatan',
            //'kode_post',
            //'tmpt_lahir',
            //'tgl_lahir',
            //'id_ref_status_sipil',
            //'pekerjaan',
            //'no_wa',
            //'alamat_domisili:ntext',
            //'rt_domisili',
            //'rw_domisili',
            //'id_ref_kecamatan_domisili',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
