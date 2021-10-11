<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RefSaldo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-saldo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_ref_agen')->textInput() ?>

    <?= $form->field($model, 'nominal')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
