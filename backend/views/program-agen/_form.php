<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model backend\models\ProgramAgen */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="program-agen-form">

    <?php $form = ActiveForm::begin(['id'=>'program-agen-form']); ?>

    <?= $form->field($model,'id_data_agen', ['enableAjaxValidation' => true])->widget(Select2::className(),[
        'data'=>$listAgen,
        'options'=>[
            'placeholder'=>'Pilih Salah Agen...'
        ],
        'pluginOptions'=>[
            'allowClear'=>true
        ]
    ]) ?>
    <?= $form->field($model, 'id_ref_program_agen')->dropDownList($modelRefProgram,[
        'prompt'=>'PIlih Salah Satu..'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<style>
.select2-container--open{
z-index:9999999
}
    </style>