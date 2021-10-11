<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DataAgenDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-agen-detail-form">

    <?php $form = ActiveForm::begin([
        'id'=>'data-agen-detail-form'
    ]); ?>

   <?= $form->field($model, 'id_ref_bank')->dropDownList($modelRefBank,[
        'prompt'=>'Pilih Salah Satu..'
    ]) ?>
    <?= $form->field($model, 'no_rek')->textInput() ?>
    <?= $form->field($model, 'atas_nama')->textInput() ?>
 <?= $form->field($model, 'aktif')->dropDownList(['Y'=>'AKTIF','N'=>'TIDAK AKTIF'],[
        'prompt'=>'Pilih Salah Satu..'
    ]) ?>
    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
