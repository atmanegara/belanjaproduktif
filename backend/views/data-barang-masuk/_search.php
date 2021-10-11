<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DataBarangMasukSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-barang-masuk-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_ref_barang') ?>

    <?= $form->field($model, 'id_ref_suplier') ?>

    <?= $form->field($model, 'qty') ?>

    <?= $form->field($model, 'harga_satuan') ?>

    <?php // echo $form->field($model, 'id_ref_gudang') ?>

    <?php // echo $form->field($model, 'tgl_masuk') ?>

    <?php // echo $form->field($model, 'tgl_input') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
