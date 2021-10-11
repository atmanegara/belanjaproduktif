<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model backend\models\RefBarang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-barang-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode_barcode')->textInput(['readonly' => true]) ?>
    <?= $form->field($model, 'kode')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'nama_barang')->textInput(['readonly' => true]) ?>
    <?php
     if(!$model->isNewRecord){
   
         $filename_path = Yii::getAlias('@sourcePathImg/').$model->filename;
         echo Html::img($filename_path,['width'=>'100px','height'=>'100px']);

    }?>
    <?= $form->field($model,'filedok')->widget(FileInput::className(),[
        'options'=>[
            'showUpload'=>false
        ]
    ])?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
