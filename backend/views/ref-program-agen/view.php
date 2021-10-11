<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\RefProgramAgen */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Program Agens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ref-program-agen-view">

   
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
              'nama_program',
        ],
    ]) ?>

</div>
