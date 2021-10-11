<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

use dosamigos\ckeditor\CKEditor;
/* @var $this yii\web\View */
/* @var $model backend\models\VisiMisiPerusahaan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="visi-misi-perusahaan-form">

    <?php $form = ActiveForm::begin([
        'id'=>'visi-misi-perusahaan-form'
    ]); ?>

      <?= $form->field($model, 'visi')->label('VISI')->widget(
 CKEditor::class,[
      'options' => ['rows' => 6,'id'=>'visi'],
        'preset' => 'full'
 ]
            ) ?>
   
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
