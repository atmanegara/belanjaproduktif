<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AturBagiHasilProgram */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atur-bagi-hasil-program-form">

    <?php $form = ActiveForm::begin(); ?>
  <?= $form->field($model, 'id_ref_agen',['enableAjaxValidation' => false])->dropDownList($modelRefAgen,[
        'prompt'=>'Pilih Salah Satu..'
    ]) ?>
  <?= $form->field($model, 'id_ref_program_agen',['enableAjaxValidation' => false])->dropDownList($modelRefProgramAgen,[
        'prompt'=>'Pilih Salah Satu..'
    ]) ?>

    <?= $form->field($model, 'nominal')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
