<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\Url;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $model frontend\models\RegistrasiAgen */
/* @var $form yii\widgets\ActiveForm */

?>

 <div class="register-content">

    <?php $form = ActiveForm::begin([
    ]); ?>
<div class='row row-space-10'>
<div class='col-md-6'>
<div class="product-warranty">
.:. Data Pribadi (<i>*sesuai KTP</i>)
                            </div>
        
   
    	    <?= $form->field($model, 'id_ref_agen')->widget(kartik\select2\Select2::class,[
                'data'=>$modelRefAgen,
                  'bsVersion' => '4.x',
                 'theme' => Select2::THEME_KRAJEE, 
                'options'=>[
        'placeholder'=>'Pilih Agen..',
                    ],
                'pluginOptions'=>[
                    'allowClear'=>true
                ]
    ]) ?>
	    

 <?= $form->field($model, 'nik')->textInput(['type' => 'number','placeholder' => 'Isi NIK, Maks 16 Karakter']) ?>

 <?= $form->field($model, 'nama')->label('Nama Lengkap (Sesuai KTP)')->textInput(['placeholder' => 'Isi Nama Lengkap']) ?>

     

   
 
</div>
<div class='col-md-6'>
<div class="product-warranty">
.:. Akun Agen 
                            </div>
  <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
     <?= $form->field($model, 'password')->passwordInput([
            'placeholder'=>"Isi Password, Maks 6 Karakter",
            'class'=>'form-control form-control-lg','data'=>[
                'toggle'=>'password',
                'placement'=>'after',
                'message'=>"Show/hide password"
            ]]) ?>
 <?= $form->field($model, 'nope')->label('No WA (AKTIF)')->textInput(['placeholder' => 'Isi No WA']) ?>
</div>
</div>



   
      <div class="register-buttons">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary btn-block btn-lg']) ?>
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
                $("#registrasiagen-id_kecamatan").html(addhtml)
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
                $("#registrasiagen-id_kelurahan").html(addhtml)
            }
})
    }
    
  const getAgen=(id_ref_agen)=>{
  var url = "<?= Url::to(['data-agen']) ?>"+'?id_ref_agen='+id_ref_agen;
  $.get({
      url : url,
      success:function(html){
          $("select#registrasiagen-id_referensi_agen").html(html)
      }
  })
  }
</script>