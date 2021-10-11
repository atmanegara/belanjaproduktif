<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RefKurir */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-kurir-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_kurir')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
