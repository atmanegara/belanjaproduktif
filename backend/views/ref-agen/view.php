<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\RefAgen */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Agens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ref-agen-view">

  


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
     //       'id',
            'kd_agen',
            'nama_agen',
        ],
    ]) ?>

</div>
