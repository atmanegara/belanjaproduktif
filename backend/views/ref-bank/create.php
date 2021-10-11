<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RefBank */

$this->title = 'Create Ref Bank';
$this->params['breadcrumbs'][] = ['label' => 'Ref Banks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-bank-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
