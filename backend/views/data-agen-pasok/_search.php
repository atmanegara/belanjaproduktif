<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DataAgenSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-agen-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_agen') ?>

    <?= $form->field($model, 'id_ref_agen') ?>

    <?= $form->field($model, 'nama_agen') ?>

    <?= $form->field($model, 'nik') ?>

    <?php // echo $form->field($model, 'alamat') ?>

    <?php // echo $form->field($model, 'rt') ?>

    <?php // echo $form->field($model, 'rw') ?>

    <?php // echo $form->field($model, 'id_ref_kelurahan') ?>

    <?php // echo $form->field($model, 'id_ref_kecamatan') ?>

    <?php // echo $form->field($model, 'kode_post') ?>

    <?php // echo $form->field($model, 'tmpt_lahir') ?>

    <?php // echo $form->field($model, 'tgl_lahir') ?>

    <?php // echo $form->field($model, 'id_ref_status_sipil') ?>

    <?php // echo $form->field($model, 'pekerjaan') ?>

    <?php // echo $form->field($model, 'no_wa') ?>

    <?php // echo $form->field($model, 'alamat_domisili') ?>

    <?php // echo $form->field($model, 'rt_domisili') ?>

    <?php // echo $form->field($model, 'rw_domisili') ?>

    <?php // echo $form->field($model, 'id_ref_kecamatan_domisili') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
