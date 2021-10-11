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

  
    <?= $form->field($model,'filedok')->widget(FileInput::className(),[
        'options'=>[
            'showUpload'=>false
        ]
    ])?>
    <div class="form-group">
        <?= Html::submitButton('IMPORT', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
