<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Franchice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="franchice-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_ref_agen')->dropDownList($modelRefAgen,[
        'prompt'=>'Pilih Salah Satu...'
    ]) ?>

    <?= $form->field($model, 'nominal')->textInput() ?>

    <?= $form->field($model, 'diskon')->textInput() ?>

    <?= $form->field($model, 'total')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
