<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TentangKamiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tentang-kami-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nama_cv') ?>

    <?= $form->field($model, 'no_siup') ?>

    <?= $form->field($model, 'telp_cv') ?>

    <?= $form->field($model, 'alamat_cv') ?>

    <?php // echo $form->field($model, 'kontak_lainnya') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
