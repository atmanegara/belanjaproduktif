<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DataSaldo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-saldo-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row row-space-10">
        <div class="col-md-2">
    <?= $form->field($model, 'tgl_ajukan')->textInput(['type' =>'date']) ?>
            
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
          
    </div>
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