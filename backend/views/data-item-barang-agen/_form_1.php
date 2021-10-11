<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DataItemBarangAgen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-item-barang-agen-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'no_acak')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_ref_barang')->textInput() ?>

    <?= $form->field($model, 'tgl_masuk')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
