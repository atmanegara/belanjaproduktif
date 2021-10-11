<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RefProgramAgen */

$this->title = 'Update Ref Program Agen: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Program Agens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-program-agen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
