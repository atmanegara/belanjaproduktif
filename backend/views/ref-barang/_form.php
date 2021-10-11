<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model backend\models\RefBarang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-barang-form">

    <?php $form = ActiveForm::begin(['id'=>'ref-barang-form',     'enableClientValidation' => true,]); ?>

    <?= $form->field($model, 'kode_barcode')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'kode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_barang')->textInput(['maxlength' => true]) ?>
    
 
    <?= $form->field($model, 'tampil')->dropDownList([
        'Y'=>'Tampilkan',
        'N'=>'Tidak ditampilkan'
    ],['prompt'=>'Pilih Salah Satu...'
    ]) ?>
    <p>
        <small>* Jika Item ini ingin ditampilkan dihalaman depan daftar produk konstumer pilih [Tampilkan]</small>
    </p>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
