<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DetailPembayaranKurir */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detail-pembayaran-kurir-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($modelDynamic, 'no_invoice')->textInput(['disabled' => true]) ?>

     <?= $form->field($modelDynamic, 'nominal')->textInput() ?>
   <?= $form->field($modelDynamic, 'filedok')->textInput() ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
