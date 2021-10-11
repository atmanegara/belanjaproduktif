<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BookingBarangSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="booking-barang-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kd_booking') ?>

    <?= $form->field($model, 'id_stok_barang') ?>

    <?= $form->field($model, 'qty_keluar') ?>

    <?= $form->field($model, 'no_invoice') ?>

    <?php // echo $form->field($model, 'no_acak') ?>

    <?php // echo $form->field($model, 'tgl_batas_book') ?>

    <?php // echo $form->field($model, 'jam_batas_book') ?>

    <?php // echo $form->field($model, 'status_booking') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
