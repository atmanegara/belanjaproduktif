<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model backend\models\AturMarginItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atur-margin-item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
              'id' => 'atur-margin-item-search', 
        'type' => ActiveForm::TYPE_INLINE,
        'fieldConfig' => ['options' => ['class' => 'form-group mr-2']] // spacing form field groups
    ]); ?>


    <?= $form->field($model, 'id_ref_barang')->label('Nama Barang')->widget(Select2::class,[
        'data'=> backend\models\RefBarang::dropdownlist(),
        'options'=>[
            'placeholder'=>'Pilih Salah Satu...'
        ]
    ]) ?>

 
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary mr-1']) ?>
        <?= Html::a('Reset',['index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
