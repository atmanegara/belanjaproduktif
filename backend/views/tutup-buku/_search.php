<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TutupBukuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tutup-buku-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'no_acak') ?>

    <?= $form->field($model, 'kd_posting') ?>

    <?= $form->field($model, 'thnbln_posting') ?>

    <?= $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'no_acak_user') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
