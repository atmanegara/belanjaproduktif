<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TransaksiSaldo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaksi-saldo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tgl_transaksi')->textInput() ?>

    <?= $form->field($model, 'no_acak')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nominal_masuk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_metode_transfer')->textInput() ?>

    <?= $form->field($model, 'id_ref_bank')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
