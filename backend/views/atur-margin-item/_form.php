<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\select2\Select2;
use kartik\number\NumberControl;

/* @var $this yii\web\View */
/* @var $model backend\models\AturMarginItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atur-margin-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    if ($model->isNewRecord) {
        echo $form->field($model, 'id_ref_barang')->widget(Select2::class, [
            'data' => $modelRefBarang,
            'options' => [
                'placeholder' => 'Pilih barang..'
            ],
            'pluginOptions' => [
                'multiple' => true,
                'allowClear' => true
            ],
        ]);
    } else {
        echo $form->field($model, 'id_ref_barang')->dropDownList($modelRefBarang);
    }
    ?>

    <?= $form->field($model, 'nilai')->textInput(['maxlength' => true]) ?>
    <?=
    $form->field($model, 'harga_satuan')->widget(NumberControl::className(), [
        'maskedInputOptions' => [
            'prefix' => 'Rp ',
            'groupSeparator' => '.',
            'radixPoint' => ','
        ],
    ])
    ?>

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