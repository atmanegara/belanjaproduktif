<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DataAgenWarisSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-agen-waris-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_data_agen') ?>

    <?= $form->field($model, 'nama_waris') ?>

    <?= $form->field($model, 'nope_waris') ?>

    <?= $form->field($model, 'jns_bank') ?>

    <?php // echo $form->field($model, 'atas_nama_bank') ?>

    <?php // echo $form->field($model, 'norek_bank') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
