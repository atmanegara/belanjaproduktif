<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RefStatusSipil */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-status-sipil-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_status_sipil')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
