<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RefStatusSipil */

$this->title = 'Create Ref Status Sipil';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Sipils', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-sipil-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
