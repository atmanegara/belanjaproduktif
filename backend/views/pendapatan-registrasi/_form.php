<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PendapatanRegistrasi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pendapatan-registrasi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_ref_agen')->textInput() ?>

    <?= $form->field($model, 'nominal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_masuk')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
