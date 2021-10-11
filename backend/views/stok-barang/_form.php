<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\StokBarang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stok-barang-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'tgl_masuk')->textInput() ?>

    <?= $form->field($model, 'id_data_agen')->textInput() ?>

    <?= $form->field($model, 'id_data_barang')->textInput() ?>

    <?= $form->field($model, 'stok_awal')->textInput() ?>

    <?= $form->field($model, 'stok_masuk')->textInput() ?>

    <?= $form->field($model, 'stok_keluar')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
