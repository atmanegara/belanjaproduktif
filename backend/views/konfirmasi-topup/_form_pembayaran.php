<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\file\FileInput;
use backend\models\RefAgen;

/* @var $this yii\web\View */
/* @var $model backend\models\KonfirmasiTopup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="konfirmasi-topup-form">

    <?php $form = \kartik\form\ActiveForm::begin([ 'type' => ActiveForm::TYPE_VERTICAL]); ?>
<div class='panel panel-inverse'>
	
	<div class='panel-body'>
	<div class='row row-space-10'>
	<div class='col-md-3'>
	
    <?= $form->field($model, 'no_invoice')->textInput(['disabled' => true]) ?>

    	</div>
	<div class='col-md-3'>
<?php
echo Html::label('ID AGEN');
echo Html::textInput('id_agen',$modelDataAgen['id_agen'],['class'=>'form-control','disabled' => true]);
?>
	</div>
	<div class='col-md-3'>
<?php
echo Html::label('NAMA');
echo Html::textInput('id_agen',$modelDataAgen['nama_agen'],['class'=>'form-control','disabled' => true]);
?>	</div>
	<div class='col-md-3'>
<?php
echo Html::label('AGEN');
echo Html::textInput('id_agen',RefAgen::findOne($modelDataAgen['id_ref_agen'])->nama_agen,['class'=>'form-control','disabled' => true]);
?>	</div>
</div>
<div class='row row-space-10'>
	<div class='col-md-4'>
    <?= $form->field($model, 'from_bank')->dropDownList($modelRefBank,[
        'prompt'=>'Pilih Bank..',
    ]) ?>
	</div>
<div class='col-md-4'>
    <?= $form->field($model, 'nominal')->widget(kartik\number\NumberControl::class,[
        'maskedInputOptions' => [
        'prefix' => 'Rp ',
        'groupSeparator' => '.',
        'radixPoint' => ',',
              'rightAlign' => false
    ],
    ]) ?>
	</div>
<div class='col-md-4'>
    <?= $form->field($model, 'tgl_transfer')->textInput(['type'=>'date','value'=>date('Y-m-d')]) ?>

	</div>
</div>
<?= $form->field($model,'filedok',[
    'enableAjaxValidation'=>false])->widget(FileInput::className(),[
        'pluginOptions' => [
            'showCaption' => true,
            'showRemove' => false,
            'showUpload' => false,
        ]
    ]) ?>
	</div>
	
	<div class='panel-footer'>
	<div class='row row-space-10'>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

</div>
	</div>
</div>



    <?php \kartik\form\ActiveForm::end(); ?>

</div>
