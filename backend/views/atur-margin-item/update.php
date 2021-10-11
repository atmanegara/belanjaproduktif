<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\AturMarginItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atur-margin-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_ref_barang')->widget(Select2::class,[
        'data'=>$modelRefBarang,
        'options'=>[
          'placeholder'=>'Pilih barang..'  
        ],
        'pluginOptions' => [
            'multiple'=>false,
'allowClear' => true
],
    ]) ?>

    <?= $form->field($model, 'nilai')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
