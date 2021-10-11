<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DataAgenWaris */

$this->title = 'Update Data Agen Waris: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Data Agen Waris', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="data-agen-waris-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
