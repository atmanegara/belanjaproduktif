<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\RefJam */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Jams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ref-jam-view">

   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'jam',
            'aktif',
        ],
    ]) ?>

</div>
