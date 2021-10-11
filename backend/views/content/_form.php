<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\file\FileInput;
use dosamigos\ckeditor\CKEditor;
/* @var $this yii\web\View */
/* @var $model backend\models\Content */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="content-form">
    <div class="panel panel-inverse">
        <div class="panel-heading">
            Form
        </div>
        <div class="panel-body">
              <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'judul')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'isi_content')->widget(
 CKEditor::class,[
      'options' => ['rows' => 6],
        'preset' => 'standar'
 ]
            ) ?>


    <?= $form->field($model, 'filedok')->widget(FileInput::className()) ?>
    <?= $form->field($model, 'filedok2')->widget(FileInput::className()) ?>

    <?= $form->field($model, 'aktf')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
        </div>
    </div>
  

</div>
