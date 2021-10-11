<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\KonfirmasiPembayaran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="konfirmasi-pembayaran-form">

    <?php $form = ActiveForm::begin([
        'id'=>'konfirmasipembayaranform',
        'enableAjaxValidation'=>true,
    ]); ?>

    <?= $form->field($model, 'no_acak')->label(false)->hiddenInput(['maxlength' => true]) ?>
   <?= $form->field($model, 'no_invoice')->textInput(['disabled' => true]) ?>
 <div class="row row-space-10">
      <div class="col-md-2 m-b-15">
      
    <?= $form->field($model, 'from_bank')->dropDownList($modelRefBank,[
        'prompt'=>'Pilih Bank'
    ]) ?>
      </div>
       <div class="col-md-3 m-b-15">
    <?= $form->field($model, 'nominal_sisa')->label('Sisa Pembayaran')->textInput(['disabled'=>'disabled    ']) ?>
       </div>
       <div class="col-md-3 m-b-15">
    <?= $form->field($model, 'nominal')->widget(kartik\number\NumberControl::class,[
        'maskedInputOptions' => [
        'prefix' => 'Rp ',
        'groupSeparator' => '.',
        'radixPoint' => ',',
              'rightAlign' => false
    ],
    ]) ?>
       </div>
          <div class="col-md-4 m-b-15">
    <?= $form->field($model, 'tgl_transfer')->textInput(['type'=>'date','format'=>'yyyy/mm/dd']) ?>
       </div>
      </div>
    
<?= $form->field($model,'filebukti',[
    'enableAjaxValidation'=>false])->widget(FileInput::className(),[
        'pluginOptions' => [
            'showCaption' => true,
            'showRemove' => false,
            'showUpload' => false,
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
