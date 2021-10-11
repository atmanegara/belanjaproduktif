<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RefProgramAgen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-program-agen-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_program')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'biaya')->textInput(['type' =>'number']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
