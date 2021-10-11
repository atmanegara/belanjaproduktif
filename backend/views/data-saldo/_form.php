<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DataSaldo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-saldo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'no_acak')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'nominal_awal')->widget(kartik\number\NumberControl::class,[
        'maskedInputOptions' => [
        'prefix' => '€ ',
        'groupSeparator' => '.',
        'radixPoint' => ','
    ],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
