<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RiwayatPencairan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="riwayat-pencairan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'no_acak_arsip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_pencairan')->textInput() ?>

    <?= $form->field($model, 'no_acak')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_invoice')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_metode_transfer')->textInput() ?>

    <?= $form->field($model, 'from_bank')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_ajukan')->textInput() ?>

    <?= $form->field($model, 'tgl_verifikasi')->textInput() ?>

    <?= $form->field($model, 'id_data_agen')->textInput() ?>

    <?= $form->field($model, 'nominal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_status_pembayaran')->textInput() ?>

    <?= $form->field($model, 'id_ket')->textInput() ?>

    <?= $form->field($model, 'status_pencarian')->textInput() ?>

    <?= $form->field($model, 'pencarian_sbg')->textInput() ?>

    <?= $form->field($model, 'jamtgl')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
