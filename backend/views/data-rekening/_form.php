<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DataRekening */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-rekening-form">

    <?php $form = ActiveForm::begin([
        
            'id'=>'data-rekening-form'
    ]); ?>

    <?= $form->field($model, 'no_acak')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_ref_bank')->textInput() ?>

    <?= $form->field($model, 'no_rek')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'atas_nama')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
