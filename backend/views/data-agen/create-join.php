<?php

use yii\helpers\Html;
use kartik\file\FileInput;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\DataAgen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-agen-formx">

    <?php $form = ActiveForm::begin([
        'id'=>'data-agen-formx',
    ]); ?>
<?= $form->field($model, 'no_acak_ref')->widget(\kartik\select2\Select2::class,[
    'data'=>$dataAgenId,
//    'options'=>[
//        'placeholder'=>'Pilih Salah Satu..'
//    ],
    'pluginOptions'=>[
        'allowClear'=>true
    ]
]) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<style>
    .select2-container--open{
z-index:9999999
}
    </style>