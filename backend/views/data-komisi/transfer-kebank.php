<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DataSaldo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-saldo-form">
<div class="alert alert-success fade show">
  <strong>Perhatian!</strong>
  Pastikan No Rekening Bank anda sudah di input / terdaftar di aplikasi
</div>
  
    <?php $form = ActiveForm::begin(); ?>
    <div class="row row-space-10">
        <div class="col-md-6">
            <?php
            echo \yii\bootstrap4\Html::label('Ke No Rekening');
            echo \yii\bootstrap4\Html::textInput('no_rek', $dataWaris['no_rek'],['class'=>'form-control','readOnly'=>true]);
            ?>
        </div>
         <div class="col-md-6">
            <?php
            echo \yii\bootstrap4\Html::label('Nama Bank');
            echo \yii\bootstrap4\Html::textInput('id_ref_bank', \backend\models\RefBank::findOne($dataWaris['id_ref_bank'])->nm_bank,['class'=>'form-control','readOnly'=>true]);
            ?>
        </div>
    </div>
    <div class="row row-space-10">
        <div class="col-md-6">
    <?= $form->field($model, 'tgl_ajukan')->textInput(['type' =>'date']) ?>
            
        </div>
        <div class="col-md-6">
    <?= $form->field($model, 'nominal')->widget(kartik\number\NumberControl::class,[
        'maskedInputOptions' => [
        'prefix' => 'Rp ',
        'groupSeparator' => '.',
        'radixPoint' => ',',
              'rightAlign' => false
    ],
    ]) ?>
            
        </div>
    </div>
    <small><i>Pastikan sudah memasukkan data rekening</i></small>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php $form->end(); ?>

</div>
