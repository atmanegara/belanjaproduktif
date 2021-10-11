<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\RefSatuanBarang */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Satuan Barangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ref-satuan-barang-view">

 
  
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nama_satuan',
        ],
    ]) ?>

</div>
