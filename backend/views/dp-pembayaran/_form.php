<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DpPembayaran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dp-pembayaran-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'no_acak')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_franchice')->textInput() ?>

    <?= $form->field($model, 'id_status_dp')->textInput() ?>

    <?= $form->field($model, 'tahap_dp')->textInput() ?>

    <?= $form->field($model, 'nominal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uang_muka')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sisa')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
