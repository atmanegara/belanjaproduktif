<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DetailProgramAgen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detail-program-agen-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row row-space-12">
        <div class="col-md-6">
    <?= $form->field($model, 'tgl_awal')->label('Tanggal Awal Berangakat')->textInput(['type'=>'date']) ?>
            
        </div>
        <div class="col-md-6">
    <?= $form->field($model, 'tgl_akhir')->label('Tanggal Kepulangan')->textInput(['type'=>'date']) ?>
            
        </div>
    </div>

    <div class="row row-space-12">
        <div class="col-md-4">
            
    <?= $form->field($model, 'tahunke')->textInput() ?>
        </div>
        <div class="col-md-4">
    <?= $form->field($model, 'ket')->textInput(['maxlength' => true]) ?>
            
        </div>
        <div class="col-md-4">
                <?= $form->field($model, 'aktif')->dropDownList([ 'Y' => 'YA', 'N' => 'Belum / Tidak', ], ['prompt' => '']) ?>

        </div>
    </div>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
