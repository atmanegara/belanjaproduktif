<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RefAgen */

$this->title = 'Update Ref Agen: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Agens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-agen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
