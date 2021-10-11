<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RefBank */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-bank-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nm_bank')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
