<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProgramAgen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="program-agen-form">

    <?php $form = ActiveForm::begin(); ?>

 
    <?= $form->field($model, 'id_ref_program_agen')->dropDownList($modelRefProgram,[
        'prompt'=>'PIlih Salah Satu..'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
