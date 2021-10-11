<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\KonfirmasiTopup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="konfirmasi-topup-form">
   <?= Html::label('Silakan lakukan pembayaran melalui Rekening BRI '.$modelTentangKami['kontak_lainnya'].' Atas Nama CV. Belanja Produktif')?>

    <?php $form = ActiveForm::begin([
        'id'=>'konfirmasi-topup-form'
    ]); ?>
    <div class="row">
        <div class="col-md-6">
         <?= $form->field($model, 'no_invoice')->textInput(['disabled' => true]) ?>
    
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
   




    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
