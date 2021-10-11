<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TransaksiSaldoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaksi-saldo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tgl_transaksi') ?>

    <?= $form->field($model, 'no_acak') ?>

    <?= $form->field($model, 'nominal_masuk') ?>

    <?= $form->field($model, 'id_metode_transfer') ?>

    <?php // echo $form->field($model, 'id_ref_bank') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
