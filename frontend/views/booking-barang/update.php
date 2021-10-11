<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BookingBarang */

$this->title = 'Update Booking Barang: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Booking Barangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="booking-barang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
