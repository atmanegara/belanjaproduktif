<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model backend\models\DetailToko */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detail-toko-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_data_toko')->label(false)->hiddenInput() ?>

    <?= $form->field($model, 'hari')->dropDownList([
      '1'=>'Senin',
            '2'=>'Selasa',
            '3'=>'Rabu',
            '4'=>'Kamis',
            '5'=>'Jumat',
            '6'=>'Sabtu',
              '7'=>'Minggu'
    ],[
        'prompt'=>'Pilih Salah Satu Hari'
    ]) ?>

    <?= $form->field($model, 'jam_awal')->widget(MaskedInput::class,[
        'mask'=>'99:99'
    ]) ?>

     <?= $form->field($model, 'jam_akhir')->widget(MaskedInput::class,[
        'mask'=>'99:99'
    ]) ?>

    <?= $form->field($model, 'aktif')->dropDownList([ 'Y' => 'BUKA', 'N' => 'TUTUP', ], ['prompt' => 'Pilih Salah Satu']) ?>

    <?= $form->field($model, 'ket')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
