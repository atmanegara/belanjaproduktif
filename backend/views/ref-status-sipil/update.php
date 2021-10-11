<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RefStatusSipil */

$this->title = 'Update Ref Status Sipil: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Sipils', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-status-sipil-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
