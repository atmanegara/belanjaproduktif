<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use dosamigos\ckeditor\CKEditor;
/* @var $this yii\web\View */
/* @var $model backend\models\RefSyaratAgen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-syarat-agen-form">

    <?php $form = ActiveForm::begin([
        'id'=>'ref-syarat-agen-form',

    ]); ?>

    <?= $form->field($model, 'id_ref_agen',['enableAjaxValidation' => true])->dropDownList($modelRefAgen,[
        'prompt'=>"Pilih salah satu..."
    ]) ?>
  <?= $form->field($model, 'hak_wajib')->widget(CKEditor::class,
          ['options' =>['rows'=>6]]) ?>
 <?= $form->field($model, 'syarat_komisi')->widget(CKEditor::class,
          ['options' =>['rows'=>6]]) ?>
    <?= $form->field($model, 'syarat_daftar')->widget(CKEditor::class,
       ['options' =>['rows'=>6]]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
