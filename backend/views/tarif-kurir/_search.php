<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TarifKurirSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tarif-kurir-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_ref_kurir') ?>

    <?= $form->field($model, 'hari') ?>

    <?= $form->field($model, 'jam_awal') ?>

    <?= $form->field($model, 'jam_akhir') ?>

    <?php // echo $form->field($model, 'tarif') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
