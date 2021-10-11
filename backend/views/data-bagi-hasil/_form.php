<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DataBagiHasil */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-bagi-hasil-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'tgl_masuk')->textInput(['type' => 'date']) ?>

   

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
