<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AturBagiHasilJual */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atur-bagi-hasil-jual-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_ref_agen',['enableAjaxValidation' => true])->dropDownList($modelRefAgen,[
        'prompt'=>'Pilih Salah Satu..'
    ]) ?>
    <?= $form->field($model, 'nilai')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
