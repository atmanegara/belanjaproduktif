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
        'onChange'=>'getAgen(this.value)'
                    ],
                'pluginOptions'=>[
                    'allowClear'=>true
                ]
    ]) ?>
  <?php
// Templating example of formatting each list element
$format = <<< SCRIPT
function format(state) {
    if (!state.id) return state.text; // optgroup
     return '<i>' + state.text+'</i>';
}
SCRIPT;
$escape = new yii\web\JsExpression("function(m) { return m; }");
$this->registerJs($format, View::POS_HEAD);
?>
      <?= $form->field($model, 'id_referensi_agen')->widget(kartik\select2\Select2::class,[
           'bsVersion' => '4.x',
                 'theme' => Select2::THEME_KRAJEE, 
          'data'=>[],
          'pluginLoading'=>true,
        'options'=>
          ['placeholder'=>'Pilih Agen..',
              'multiple'=>false,
            
              ],
          'pluginOptions'=>[
               'templateResult' => new JsExpression('format'),
        'templateSelection' => new JsExpression('format'),
        'escapeMarkup' => $escape,
              'allowClear'=>true
          ]
    ]) ?>	    

 <?= $form->field($model, 'nik')->textInput(['type' => 'number']) ?>

 <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
    
  
  <?= $form->field($model, 'nope')->textInput(['maxlength' => true]) ?>
      <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>
      <?= $form->field($model, 'id_kab')->widget(kartik\select2\Select2::class,[
                'data'=>$modelKabupaten,
                  'bsVersion' => '4.x',
                 'theme' => Select2::THEME_KRAJEE, 
                'options'=>[
        'placeholder'=>'Pilih Salah Satu Kabupaten....',
               'onChange'=>'tampilkankecamatan(this.value)'
                    ],
                'pluginOptions'=>[
                    'allowClear'=>true
                ]
    ]) ?>

     

    <div class="row row-space-10">
      <div class="col-md-6 m-b-15">
           <?= $form->field($model, 'id_kecamatan')->widget(kartik\select2\Select2::class,[
                'data'=>$modelKecamatan,
                  'bsVersion' => '4.x',
                 'theme' => Select2::THEME_KRAJEE, 
                'options'=>[
        'placeholder'=>'Pilih Kecamatan..',
               'onChange'=>'tampilkankelurahan(this.value)'
                    ],
                'pluginOptions'=>[
                    'allowClear'=>true
                ]
    ]) ?>
 
      </div>
      <div class="col-md-6 m-b-15">
       <?= $form->field($model, 'id_kelurahan')->widget(kartik\select2\Select2::class,[
        //        'data'=>$modelKecamatan,
                  'bsVersion' => '4.x',
                 'theme' => Select2::THEME_KRAJEE, 
                'options'=>[
        'placeholder'=>'Pilih Kelurahan..',
                     ],
                'pluginOptions'=>[
                    'allowClear'=>true
                ]
    ]) ?>
 
    </div>
 
  </div>    
 
</div>
<div class='col-md-6'>
<div class="product-warranty">
.:. Akun Agen 
                            </div>
  <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
  <?= $form->field($model, 'password')->passwordInput() ?>
 <?= $form->field($model, 'email')->textInput(['type' =>'email']) ?>
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