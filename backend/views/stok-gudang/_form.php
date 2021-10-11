<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\StokGudang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stok-gudang-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_ref_gudang')->textInput() ?>

    <?= $form->field($model, 'id_ref_barang')->textInput() ?>

    <?= $form->field($model, 'qty')->textInput() ?>

    <?= $form->field($model, 'harga_satuan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'harga_jual')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
