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
        <div class="col-md-2">
    <?= $form->field($model, 'tgl_ajukan')->textInput(['type' =>'date']) ?>
            
        </div>
         <div class="col-md-2">
    <?= $form->field($model, 'pencarian_sbg')->label('Peruntukan')->dropDownList(['1' =>'SALDO','2'=>'KOMISI'],[
        'prompt'=>'Pilih Salah Satu..'
    ]) ?>
            
        </div>
        <div class="col-md-4">
    <?= $form->field($model, 'nominal')->widget(kartik\number\NumberControl::class,[
        'maskedInputOptions' => [
        'prefix' => 'Rp ',
        'groupSeparator' => '.',
        'radixPoint' => ',',
              'rightAlign' => false
    ],
    ]) ?>
            
        </div>
            <div class="col-md-4">
    <?= $form->field($model, 'id_data_agen')->widget(\kartik\select2\Select2::class,[
        'data'=>$dataAgenList,
        'options'=>[
            'placeholder'=>'Pilih Salah Satu Agen Anggota...'
        ]
    ]) ?>
            
        </div>
    </div>
    <small><i>Pastikan sudah memasukkan data rekening</i></small>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<style>
    .select2-container--open{
z-index:9999999
}
    </style>