<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\DataToko */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-toko-form">

    <?php $form = ActiveForm::begin(['id'=>'data-toko-form']); ?>

    <div class="row row-space-10">
        <div class="col-md-4">
    <?= $form->field($model, 'no_toko')->textInput(['maxlength' => true]) ?>
            
        </div>
        <div class="col-md-8">
    <?= $form->field($model, 'nama_toko')->textInput(['maxlength' => true]) ?>
            
        </div>
    </div>

    <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>
<div class="row row-space-10">
    <div class="col-md-4">
     <?= $form->field($model, 'id_kabupaten')->dropDownList($modelKabupaten,[
          'prompt'=>'Pilih Salah Satu...',
          'onChange'=>'tampilkankecamatan(this.value)'
      ]) ?>    
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'id_kecamatan')->dropDownList([],[
        'prompt'=>'Pilih Kecamatan..',
       'onChange'=>'tampilkankelurahan(this.value)'
    ]) ?> 
    </div>
    <div class="col-md-4">
     
     <?= $form->field($model, 'id_kelurahan')->dropDownList([],[
        'prompt'=>'Pilih Kelurahan..'
    ]) ?>    
    </div>
</div>


   
    <?= $form->field($model, 'telp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aktif')->dropDownList([ 'Y' => 'Aktif', 'N' => 'Tidak Aktif', ], ['prompt' => 'Pilih Salah Satu Status TOKO..']) ?>

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
                $("#datatoko-id_kecamatan").html(addhtml)
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
                $("#datatoko-id_kelurahan").html(addhtml)
            }
})
    }
    
</script>