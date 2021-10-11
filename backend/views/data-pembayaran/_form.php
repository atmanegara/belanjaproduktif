<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DataPembayaran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-pembayaran-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'no_acak')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_invoice')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_metode_transfer')->textInput() ?>

    <?= $form->field($model, 'nominal')->textInput() ?>

    <?= $form->field($model, 'from_bank')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_transfer')->textInput() ?>

    <?= $form->field($model, 'tgl_konfirmasi')->textInput() ?>

    <?= $form->field($model, 'filename')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_status_pembayaran')->textInput() ?>

    <?= $form->field($model, 'id_status_dp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
