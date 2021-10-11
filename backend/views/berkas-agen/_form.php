<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\BerkasAgen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="berkas-agen-form">

    <?php $form = ActiveForm::begin([
        'id'=>'berkasagenform',
    ]); ?>

   

    <?= $form->field($model, 'id_data_agen')->label(false)->hiddenInput() ?>

    <?= $form->field($model, 'id_ref_jenis_dok')->label(false)->hiddenInput() ?>

    <?php
         $namaDok = backend\models\RefJenisDok::findOne($model->id_ref_jenis_dok);   
echo $form->field($model, 'filebukti',['enableAjaxValidation'=>false])->label('Upload Berkas : '. $namaDok['nama_dok'])->widget(FileInput::className(),[
                        'pluginOptions' => [
        'showPreview' => true,
        'showCaption' => true,
        'showRemove' => true,
        'showUpload' => false,
    ]
                   ]) 
                   ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
