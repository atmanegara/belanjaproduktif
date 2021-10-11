<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DataAgenWaris */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-agen-waris-form">

    <?php $form = ActiveForm::begin(['id'=>'data-agen-waris-form']); ?>


    <?= $form->field($model, 'nama_waris')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nope_waris')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jns_bank')->dropDownList($modelRefBank,[
        'prompt'=>'Pilih Bank'
    ]) ?>

    <?= $form->field($model, 'atas_nama_bank')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'norek_bank')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
