<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\KonfirmasiPembayaranSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="konfirmasi-pembayaran-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'type'=> ActiveForm::TYPE_INLINE,  'fieldConfig' => ['options' => ['class' => 'form-group mr-2']] 
    ]); ?>

    <?= $form->field($model, 'id_status_pembayaran')->label('Pilih Status Pembayaran')->dropDownList($modelStatusPembayaran,[
        'prompt'=>'Pilih Salah Satu..'
    ]) ?>

        <?= Html::submitButton('Search', ['class' => 'btn btn-primary mr-1']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>


    <?php ActiveForm::end(); ?>

</div>
