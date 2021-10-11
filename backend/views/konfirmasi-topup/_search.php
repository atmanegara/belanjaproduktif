<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\KonfirmasiTopupSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="konfirmasi-topup-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'no_acak') ?>

    <?= $form->field($model, 'no_invoice') ?>

    <?= $form->field($model, 'id_metode_transfer') ?>

    <?= $form->field($model, 'nominal') ?>

    <?php // echo $form->field($model, 'from_bank') ?>

    <?php // echo $form->field($model, 'tgl_transfer') ?>

    <?php // echo $form->field($model, 'filename') ?>

    <?php // echo $form->field($model, 'id_status_pembayaran') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
