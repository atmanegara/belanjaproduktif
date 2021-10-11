<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DataBagiHasilSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-bagi-hasil-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'no_acak') ?>

    <?= $form->field($model, 'no_acak_tutup_buku') ?>

    <?= $form->field($model, 'tgl_masuk') ?>

    <?= $form->field($model, 'id_ref_agen') ?>

    <?php // echo $form->field($model, 'persen') ?>

    <?php // echo $form->field($model, 'hasil') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
