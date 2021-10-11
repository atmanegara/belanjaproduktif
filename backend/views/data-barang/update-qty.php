<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\ActiveField;
?>

<div class="note note-danger note-with-left-icon m-b-15">
    <div class="note-icon"><i class="fa fa-lightbulb"></i></div>
    <div class="note-content text-left">
        <h4><b>PERHAHTIAN!</b></h4>
        <p>
            MENGGANTI STOK (MENURUTKAN SISA STOK) PADA TOKO, AKAN MEMPENGARUHI TAMPILAN PADA HALAMAN PRODUK BELANJA
        </p>
    </div>
</div>
<?php
$form = ActiveForm::begin([
            'id' => 'login-form-inline',
            'layout' => ActiveForm::LAYOUT_INLINE,
            'fieldConfig' => ['options' => ['class' => 'form-group mr-2']] // spacing form field groups
        ])
?>
<?= $form->field($model, 'stok_sisa')->label('Jumlah')->textInput(['type' => 'number', 'min' => 0, 'max' =>'999999999','value'=>$model->stok_sisa]) ?>
<?= Html::submitButton('GANTI', ['class' => 'btn btn-primary']) ?>
<?php
ActiveForm::end()?>