<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RefJenisDok */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-jenis-dok-form">

    <?php $form = ActiveForm::begin(['id'=>'ref-jenis-dok-form']); ?>

    <?= $form->field($model, 'id_ref_agen')->dropDownList($modelRefAgen,['prompt'=>'Pilih salah satu..']) ?>

    <?= $form->field($model, 'nama_dok')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
