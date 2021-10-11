<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DataSaldo */

$this->title = 'Update Data Saldo: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Data Saldos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="data-saldo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
