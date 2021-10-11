<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AturBagiHasilFranchise */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atur-bagi-hasil-franchise-form">

    <?php $form = ActiveForm::begin(['id'=>'atur-bagi-hasil-franchise-form']); ?>

    <?= $form->field($model, 'id_ref_agen',['enableAjaxValidation' => true])->dropDownList($modelRefAgen,[
        'prompt'=>'Pilih Salah Satu..'
    ]) ?>

    <?= $form->field($model, 'nilai')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
