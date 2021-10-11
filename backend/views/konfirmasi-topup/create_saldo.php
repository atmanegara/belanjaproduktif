<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\KonfirmasiTopup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="konfirmasi-topup-form">

    <?php $form = ActiveForm::begin(); ?>

   <?= Html::label('Silakan lakukan pembayaran melalui Rekening BRI '.$modelTentangKami['kontak_lainnya'].' Atas Nama CV. Belanja Produktif')?>

    <?= $form->field($model, 'no_invoice')->textInput(['disabled' => true]) ?>

    <?= $form->field($model,'no_acak')->widget(\kartik\select2\Select2::class,[
        'data'=>$dataAgen,
        'options'=>[
            'placeholder'=>'Pilih Salah Satu...'
        ]
    ])?>

    <?= $form->field($model, 'nominal')->textInput() ?>



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