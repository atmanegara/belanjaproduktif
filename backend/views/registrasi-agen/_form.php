<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\widgets\MaskedInput;
/* @var $this yii\web\View */
/* @var $model backend\models\RegistrasiAgen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registrasi-agen-form">

    <?php $form = ActiveForm::begin([
        'id'=>'registrasi-agen-form',
        'type'=> ActiveForm::TYPE_HORIZONTAL
    ]); ?>



     <?= $form->field($model, 'id_ref_agen')->label('Agen')->dropDownList($modelRefAgen,[
         'prompt'=>'Pilih Salah Satu..'
     ]) ?>
    <<?= $form->field($model, 'nik',['enableAjaxValidation' => true])->widget(MaskedInput::class,[
        'mask'=>'9999999999999999'
    ]) ?>
    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'nope')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username',['enableAjaxValidation' => true])->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
