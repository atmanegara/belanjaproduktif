<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
/* @var $this yii\web\View */
/* @var $model backend\models\DetailAbout */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detail-about-form">

    <?php $form = ActiveForm::begin([
        'id'=>'detail-about-form'
    ]); ?>

 
    <?= $form->field($model, 'tag_line')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'header')->label('Isi')->widget(
 CKEditor::class,[
      'options' => ['rows' => 6],
        'preset' => 'basic'
 ]
            ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
