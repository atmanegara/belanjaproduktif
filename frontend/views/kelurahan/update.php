<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Kelurahan */

$this->title = 'Update Kelurahan: ' . $model->id_kel;
$this->params['breadcrumbs'][] = ['label' => 'Kelurahans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_kel, 'url' => ['view', 'id' => $model->id_kel]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kelurahan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
