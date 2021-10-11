<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RefAgen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-agen-form">

    <?php $form = ActiveForm::begin(['id'=>'ref-agen-form']); ?>

    <?= $form->field($model, 'kd_agen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_agen')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
