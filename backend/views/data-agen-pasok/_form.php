<?php

use yii\helpers\Html;
use kartik\file\FileInput;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DataAgen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-agen-form">

    <?php $form = ActiveForm::begin([
        'id'=>'data-agen-form',
        'enableAjaxValidation'=>true
    ]); ?>
	<div class='row row-space-10'>
		<div class='col-md-6'>
    <?= $form->field($model, 'id_agen')->textInput(['maxlength' => true]) ?>
		</div>
		<div class='col-md-6'>
		    <?= $form->field($model, 'id_ref_agen')->dropDownList($modelRefAgen,[
		        'prompt'=>'Pilih Agen..','class'=>'form-control btn-default'
		    ]) ?>
		
		</div>
	</div>
<div class='row row-space-10'>
		<div class='col-md-6'>
    <?= $form->field($model, 'nik')->textInput(['maxlength' => true]) ?>
		</div>
		<div class='col-md-6'>
		    <?= $form->field($model, 'nama_agen')->textInput(['maxlength' => true]) ?>
		</div>
</div>
<div class='row row-space-10'>
		<div class='col-md-6'>
		    <?= $form->field($model, 'tmpt_lahir')->textInput(['maxlength' => true]) ?>
		
</div><div class='col-md-6'>

    <?= $form->field($model, 'tgl_lahir')->textInput(['type'=>'date']) ?>
		
</div>
</div>

    <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>
<div class='row row-space-10'>
<div class='col-md-2'>
    <?= $form->field($model, 'rt')->textInput(['maxlength' => true]) ?>
</div>
<div class='col-md-2'>
    <?= $form->field($model, 'rw')->textInput(['maxlength' => true]) ?>
</div>
<div class='col-md-3'>
    <?= $form->field($model, 'id_ref_kelurahan')->textInput() ?>
</div>
<div class='col-md-3'>
    <?= $form->field($model, 'id_ref_kecamatan')->textInput() ?>
</div>
<div class='col-md-2'>

    <?= $form->field($model, 'kode_post')->textInput(['maxlength' => true]) ?></div>
</div>
<div class='row row-space-10'>
	<div class='col-md-4'>
	<?= $form->field($model, 'id_ref_status_sipil')->dropDownList($modelStatusSipil,[
        'prompt'=>'Pilih Status Sipil...',
	    
    ]) ?></div>
    <div class='col-md-4'>
    <?= $form->field($model, 'pekerjaan')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-4'>
    <?= $form->field($model, 'no_wa')->textInput(['maxlength' => true]) ?>
    </div>
</div>
  
<hr>
    
    
    <?= $form->field($model, 'alamat_domisili')->textarea(['rows' => 6]) ?>
<div class='row row-space-10'>
	<div class='col-md-4'>
	    <?= $form->field($model, 'rt_domisili')->textInput(['maxlength' => true]) ?>
	</div>
	<div class='col-md-4'>
    <?= $form->field($model, 'rw_domisili')->textInput(['maxlength' => true]) ?>
	</div>
	<div class='col-md-4'>
		    <?= $form->field($model, 'id_ref_kecamatan_domisili')->dropDownList($modelRefKecamatan,
		        ['prompt'=>'Pilih Kecamatan']
		        ) ?>
	</div>
</div>


    <?= $form->field($model, 'filedok',['enableAjaxValidation'=>false])->widget(FileInput::className(),[
        'pluginOptions' => [
            'showPreview' => true,
            'showCaption' => true,
            'showRemove' => true,
            'showUpload' => false
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
