<?php

use yii\helpers\Html;
use kartik\file\FileInput;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\DataAgen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-agen-form">

    <?php $form = ActiveForm::begin([
        'id'=>'data-agen-form',
    ]); ?>
	<div class='row row-space-10'>
		<div class='col-md-6'>
    <?= $form->field($model, 'id_agen')->textInput(['disabled' => true]) ?>
		</div>
		<div class='col-md-6'>
                    
		    <?= $form->field($model, 'id_ref_agen')->dropDownList($modelRefAgen,[
		        'prompt'=>'Pilih Agen..','class'=>'form-control btn-default','disabled'=>true
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
<div class='col-md-1'>
    <?= $form->field($model, 'rt')->textInput(['maxlength' => true]) ?>
</div>
<div class='col-md-1'>
    <?= $form->field($model, 'rw')->textInput(['maxlength' => true]) ?>
</div>
    <div class="col-md-2">
        <?= $form->field($model, 'id_kab')->dropDownList($modelKabupaten,[
          'prompt'=>'Pilih Salah Satu...',
          'onChange'=>'tampilkankecamatan(this.value)'
      ]) ?>
    </div>
<div class='col-md-3'>
  <?= $form->field($model, 'id_kecamatan')->dropDownList([],[
        'prompt'=>'Pilih Kecamatan..',
       'onChange'=>'tampilkankelurahan(this.value)'
    ]) ?>  
</div>
<div class='col-md-3'>
    <?= $form->field($model, 'id_kelurahan')->dropDownList([],[
        'prompt'=>'Pilih Kelurahan..'
    ]) ?>
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
<div class='col-md-1'>
    <?= $form->field($model, 'rt_domisili')->textInput(['maxlength' => true]) ?>
</div>
<div class='col-md-1'>
    <?= $form->field($model, 'rw_domisili')->textInput(['maxlength' => true]) ?>
</div>
    <div class="col-md-4">
        <?= $form->field($model, 'id_kab_domisili')->dropDownList($modelKabupaten,[
          'prompt'=>'Pilih Salah Satu...',
          'onChange'=>'tampilkankecamatandomisili(this.value)'
      ]) ?>
    </div>
<div class='col-md-3'>
  <?= $form->field($model, 'id_kecamatan_domisili')->dropDownList([],[
        'prompt'=>'Pilih Kecamatan..',
       'onChange'=>'tampilkankelurahandomisili(this.value)'
    ]) ?>  
</div>
<div class='col-md-3'>
    <?= $form->field($model, 'id_kelurahan_domisili')->dropDownList([],[
        'prompt'=>'Pilih Kelurahan..'
    ]) ?>
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
<script>
    function tampilkankecamatan(id_kab){
$.get({
    url : "<?= Url::to(['/kecamatan/tampilkan-kecamatan-by-id-kab']) ?>",
    //type : 'get',
    data :{
        id_kab : id_kab
    },
            success:function(addhtml){
                $("#dataagen-id_kecamatan").html(addhtml)
            }
})
    }
    
        function tampilkankelurahan(id_kec){
$.get({
    url : "<?= Url::to(['/kelurahan/tampilkan-kelurahan-by-id-kec']) ?>",
    //type : 'get',
    data :{
        id_kec : id_kec
    },
            success:function(addhtml){
                $("#dataagen-id_kelurahan").html(addhtml)
            }
})
    }
       function tampilkankecamatandomisili(id_kab){
$.get({
    url : "<?= Url::to(['/kecamatan/tampilkan-kecamatan-by-id-kab']) ?>",
    //type : 'get',
    data :{
        id_kab : id_kab
    },
            success:function(addhtml){
                $("#dataagen-id_kecamatan_domisili").html(addhtml)
            }
})
    }
    
        function tampilkankelurahandomisili(id_kec){
$.get({
    url : "<?= Url::to(['/kelurahan/tampilkan-kelurahan-by-id-kec']) ?>",
    //type : 'get',
    data :{
        id_kec : id_kec
    },
            success:function(addhtml){
                $("#dataagen-id_kelurahan_domisili").html(addhtml)
            }
})
    }
</script>