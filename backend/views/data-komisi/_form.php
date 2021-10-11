<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DataKomisi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-komisi-form">

    <?php $form = ActiveForm::begin(); ?>

   
    <?= $form->field($model, 'tgl_transaksi')->textInput() ?>

    <?= $form->field($model, 'nominal')->widget(kartik\number\NumberControl::class,[
        'maskedInputOptions' => [
        'prefix' => 'Rp ',
        'groupSeparator' => '.',
        'radixPoint' => ',',
              'rightAlign' => false
    ],
    ]) ?>

   
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
