<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model backend\models\TarifKurir */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tarif-kurir-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_ref_kurir')->label(false)->hiddenInput() ?>

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
    <?= $form->field($model, 'tarif')->widget(kartik\number\NumberControl::class, [
                        'options' => [
                            'required' => 'required'
                        ],
                        'maskedInputOptions' => [
                            'prefix' => 'Rp ',
                            'groupSeparator' => '.',
                            'radixPoint' => ',',
                            'rightAlign' => false
                        ],
                    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
