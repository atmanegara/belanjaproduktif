<?php

use yii\helpers\Html;
use kartik\file\FileInput;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\DataAgen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="foto-toko-form">

    <?php $form = ActiveForm::begin([
        'id'=>'foto-toko-form',
    ]); ?>


    <?= $form->field($model, 'filedok',['enableAjaxValidation'=>false])->widget(FileInput::className(),[
        'pluginOptions' => [
            'showPreview' => true,
            'showCaption' => true,
            'showRemove' => true,
            'showUpload' => false
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
