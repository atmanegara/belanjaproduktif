<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\KonfirmasiPencairanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="konfirmasi-pencairan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'no_acak') ?>

    <?= $form->field($model, 'no_invoice') ?>

    <?= $form->field($model, 'id_metode_transfer') ?>

    <?= $form->field($model, 'from_bank') ?>

    <?php // echo $form->field($model, 'tgl_ajukan') ?>

    <?php // echo $form->field($model, 'id_data_agen') ?>

    <?php // echo $form->field($model, 'nominal') ?>

    <?php // echo $form->field($model, 'id_status_pembayaran') ?>

    <?php // echo $form->field($model, 'jamtgl') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
