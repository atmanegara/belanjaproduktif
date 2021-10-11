<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RegistrasiAgenSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registrasi-agen-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'no_reg') ?>

    <?= $form->field($model, 'no_acak') ?>

    <?= $form->field($model, 'nik') ?>

    <?= $form->field($model, 'nama') ?>

    <?php // echo $form->field($model, 'alamat') ?>

    <?php // echo $form->field($model, 'rt_rw') ?>

    <?php // echo $form->field($model, 'id_ref_kelurahan') ?>

    <?php // echo $form->field($model, 'id_ref_kecamatan') ?>

    <?php // echo $form->field($model, 'nope') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'id_ref_agen') ?>

    <?php // echo $form->field($model, 'id_ref_proses_pendaftaran') ?>

    <?php // echo $form->field($model, 'setuju') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
