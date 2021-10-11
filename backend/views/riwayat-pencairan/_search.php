<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RiwayatPencairanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="riwayat-pencairan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'no_acak_arsip') ?>

    <?= $form->field($model, 'tgl_pencairan') ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'no_acak') ?>

    <?= $form->field($model, 'no_invoice') ?>

    <?php // echo $form->field($model, 'id_metode_transfer') ?>

    <?php // echo $form->field($model, 'from_bank') ?>

    <?php // echo $form->field($model, 'tgl_ajukan') ?>

    <?php // echo $form->field($model, 'tgl_verifikasi') ?>

    <?php // echo $form->field($model, 'id_data_agen') ?>

    <?php // echo $form->field($model, 'nominal') ?>

    <?php // echo $form->field($model, 'id_status_pembayaran') ?>

    <?php // echo $form->field($model, 'id_ket') ?>

    <?php // echo $form->field($model, 'status_pencarian') ?>

    <?php // echo $form->field($model, 'pencarian_sbg') ?>

    <?php // echo $form->field($model, 'jamtgl') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
