<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DataToko */

$this->title = 'Update Data Toko: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Data Tokos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="data-toko-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
