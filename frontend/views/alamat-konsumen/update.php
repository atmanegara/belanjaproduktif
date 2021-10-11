<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AlamatKonsumen */

$this->title = 'Update Alamat Konsumen: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Alamat Konsumens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="alamat-konsumen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
