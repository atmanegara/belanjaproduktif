<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CatatanBarang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="catatan-barang-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_ref_barang')->textInput() ?>

    <?= $form->field($model, 'id_ref_satuan')->textInput() ?>

    <?= $form->field($model, 'qty')->textInput() ?>

    <?= $form->field($model, 'id_data_agen')->textInput() ?>

    <?= $form->field($model, 'id_ref_suplier')->textInput() ?>

    <?= $form->field($model, 'tgl_pemesanan')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
