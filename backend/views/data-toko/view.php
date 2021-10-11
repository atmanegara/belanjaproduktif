<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\DataToko */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Data Tokos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="data-toko-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
         //   'id',
         //   'id_data_agen',
            'no_toko',
            'alamat:ntext',
            'kab.nama:text:Kabupaten',
            'kecamatan.nama:text:Kecamatan',
            'kelurahan.nama:text:Kelurahan',
            'telp',
            'aktif',
        ],
    ]) ?>

</div>
