<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BookingBarang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="booking-barang-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kd_booking')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_stok_barang')->textInput() ?>

    <?= $form->field($model, 'qty_keluar')->textInput() ?>

    <?= $form->field($model, 'no_invoice')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_acak')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_batas_book')->textInput() ?>

    <?= $form->field($model, 'jam_batas_book')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_booking')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
