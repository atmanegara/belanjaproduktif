<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TutupBuku */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tutup-buku-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'no_acak')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'verifikasi')->dropDownList([
        '0'=>'Prosess',
        '1'=>'Diterima',
        
    ],[
        'prompt'=>'Pilih salah satu...'
    ]) ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
