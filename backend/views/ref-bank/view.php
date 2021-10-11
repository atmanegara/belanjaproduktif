<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\RefBank */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Banks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ref-bank-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
        //    'id',
            'nm_bank',
        ],
    ]) ?>

</div>
