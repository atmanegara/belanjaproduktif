<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\DataKurir */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Data Kurirs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="data-kurir-view">


    <p>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
         //   'id',
         [
               'width'=>'1px',
               'attribute'=> 'id_ref_kurir',
               'value'=>function($data){
                return \backend\models\RefKurir::findOne($data['id_ref_kurir'])->nama_kurir;
               }
           ],
            'nik',
            'nama_kurir',
            'telp_kurir',
        ],
    ]) ?>

</div>
