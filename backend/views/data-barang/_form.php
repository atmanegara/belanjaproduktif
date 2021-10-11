<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\number\NumberControl;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\DataBarang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-barang-form">

    <?php $form = ActiveForm::begin([
    'id' => 'data-barang-form',
        'enableAjaxValidation'=>false
    ]); ?>
    <?= $form->field($model, 'id_data_agen')->label(false)->hiddenInput() ?>
<div class='row row-space-10'>
	<div class='col-md-4'>
    <?= $form->field($model, 'barkode')->textInput() ?>
	</div>
    <div class="col-md-2">
        <div class="form-group">
        <?php  
        echo Html::label('####','generet',['class'=>'control-label']);
        echo Html::button('Generate',['id'=>'generet', 'class'=>'form-control btn btn-warning btn-sm','onClick'=>'buatgenerate()']) ?>
            
        </div>
    </div>
	<div class='col-md-6'>
    <?= $form->field($model, 'filedok')->widget(FileInput::className(),[ 'pluginOptions' => [
        'showPreview' => false,
        'showCaption' => true,
        'showRemove' => true,
        'showUpload' => false
    ]]) ?>
	</div>
</div>
<div class='row row-space-10'>
	<div class='col-md-6'>
    <?= $form->field($model, 'item_barang')->textInput(['maxlength' => true]) ?>
	</div>
<div class='col-md-6'>
    <?= $form->field($model, 'id_ref_satuan_barang')->dropDownlist($modelRefSatuanBarang) ?>
	</div>
</div>
<div class='row row-space-10'>
	<div class='col-md-4'><?= $form->field($model, 'qty')->textInput(['type'=>'number']) ?>
  
	</div>
	<div class='col-md-8'>  <?= $form->field($model, 'harga_satuan')->widget(NumberControl::className(),[
        'maskedInputOptions' => [
            'prefix' => 'Rp ',
            'groupSeparator' => '.',
            'radixPoint' => ','
        ],
    ]) ?>
	</div>
</div>
    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
buatgenerate =()=>{
    var uid = (new Date().getTime())
    
    $("#databarang-barkode").val(uid);
}
</script>