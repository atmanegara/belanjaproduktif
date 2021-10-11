<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DataKurir */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-kurir-form">

    <?php $form = ActiveForm::begin([
        'type'=> ActiveForm::TYPE_VERTICAL
    ]); ?>

    <?= $form->field($model,'id_ref_kurir')->dropDownList($modelRefKurir,['prompt'=>'Pilih Salah Satu Mitra Ojek...']) ?>
    <?= $form->field($model, 'nik')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_kurir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telp_kurir')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
