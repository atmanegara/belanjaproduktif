<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
/* @var $this yii\web\View */
/* @var $model backend\models\Persetujuan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persetujuan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'persetujuan')->widget(CKEditor::class,[
      'options' => ['rows' => 6],
        'preset' => 'full'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
