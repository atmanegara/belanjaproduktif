<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\FotoProfil */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="foto-profil-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'filedok')->widget(\kartik\file\FileInput::class,[
        
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
