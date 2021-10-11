<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model backend\models\RiwayatBagiKomisi */
/* @var $form yii\widgets\ActiveForm */
$url = \yii\helpers\Url::to(['/data-agen/agen-list']);
?>

<div class="riwayat-bagi-komisi-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'id_data_agen')->widget(Select2::class, [
    'options' => ['multiple'=>false, 'placeholder' => 'Pilih Salah Satu Agen ...'],
    'pluginOptions' => [
        'allowClear' => true,
        'minimumInputLength' => 3,
        'language' => [
            'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
        ],
        'ajax' => [
            'url' => $url,
            'dataType' => 'json',
            'data' => new JsExpression('function(params) { return {q:params.term}; }')
        ],
        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
        'templateResult' => new JsExpression('function(city) { return city.text; }'),
        'templateSelection' => new JsExpression('function (city) { return city.text; }'),
    ],
]); ?>
    
    <div class="row row-space-12">
        <div class="col-md-6">
    <?= $form->field($model, 'nominal')->textInput(['maxlength' => true])->widget(kartik\number\NumberControl::class,[
       'maskedInputOptions' => [
        'prefix' => 'Rp ',
        'groupSeparator' => '.',
        'radixPoint' => ','
    ],
    ]) ?>
            
        </div>
     <div class="col-md-6">
    <?= $form->field($model, 'tgl_dibagi')->textInput(['type'=>'date']) ?>
        
        </div>
    </div>
    

    <?= $form->field($model, 'id_ref_sumber_komisi')->dropDownList([
        '6'=>'CASHBACK',
        '7'=>'BONUS'
    ],
        [    'prompt'=>'Pilih Salah satu...']) ?>
    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>


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