<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\StokBarangSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stok-barang-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tgl_masuk') ?>

    <?= $form->field($model, 'id_data_agen') ?>

    <?= $form->field($model, 'id_data_barang') ?>

    <?= $form->field($model, 'stok_awal') ?>

    <?php // echo $form->field($model, 'stok_masuk') ?>

    <?php // echo $form->field($model, 'stok_keluar') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
