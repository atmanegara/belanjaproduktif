<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TarifKurir */

$this->title = 'Update Tarif Kurir: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tarif Kurirs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tarif-kurir-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
