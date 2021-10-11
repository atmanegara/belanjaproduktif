<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\RefJenisDok */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Doks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ref-jenis-dok-view">

  

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
      //      'id',
   [
     'label'=>'Agen',
       'value'=>$model->refAgen->nama_agen
   ],
            'nama_dok',
        ],
    ]) ?>

</div>
