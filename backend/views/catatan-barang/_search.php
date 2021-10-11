<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CatatanBarangSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="catatan-barang-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_ref_barang') ?>

    <?= $form->field($model, 'id_ref_satuan') ?>

    <?= $form->field($model, 'qty') ?>

    <?= $form->field($model, 'id_data_agen') ?>

    <?php // echo $form->field($model, 'id_ref_suplier') ?>

    <?php // echo $form->field($model, 'tgl_pemesanan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
