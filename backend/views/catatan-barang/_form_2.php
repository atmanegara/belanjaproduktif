<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\CatatanBarang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="catatan-barang-form">

    <?php $form = ActiveForm::begin(['id'=>'form-data-catatan']); ?>

   <?= $form->field($model, 'id_data_agen')->widget(Select2::class,[
        'data'=>$modelAgen,
        'options' => ['placeholder' => 'Select a state ...','id'=>'ada'],
    'pluginOptions' => [
        'allowClear' => true
    ],
    ]) ?>

    <?= $form->field($model, 'id_data_agen')->dropDownList($modelAgen,[
        'prompt'=>'Pilih Agen...'
    ]) ?>

    <?= $form->field($model, 'tgl_pemesanan')->textInput(['type'=>'date']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
