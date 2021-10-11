<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\KonfirmasiTopup */

$this->title = 'Update Konfirmasi Topup: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Konfirmasi Topups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="konfirmasi-topup-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
