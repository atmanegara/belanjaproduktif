<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
/* @var $this yii\web\View */
/* @var $model backend\models\DataBarangMasuk */
/* @var $form yii\widgets\ActiveForm */
$url = \yii\helpers\Url::to(['/ref-barang/barang-list']);
?>

<div class="data-barang-masuk-form">

<?php yii\widgets\Pjax::begin(['id' => 'new_country']) ?>
   <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true ]]); ?>
    <div class="row row-space-10">
        <div class="col-md-2">
            
    <?= $form->field($model, 'id_ref_gudang')->textInput(['value'=>1])->widget(Select2::class,[
        'data'=>$refGudang,
        'options'=>[
            'placeholder'=>'Pilih Salah Satu Gudang..'
        ]
    ]) ?>
        </div>
        <div class="col-md-6">
    <?= $form->field($model, 'id_ref_barang')->widget(Select2::class, [
    'options' => ['multiple'=>false, 'placeholder' => 'Pilih Barang ...'],
    'pluginOptions' => [
        'allowClear' => true,
        'minimumInputLength' => 3,
        'language' => [
            'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
        ],
        'ajax' => [
            'url' => $url,
            'dataType' => 'json',
            'data' => new JsExpression('function(params) { return {q:params.term}; }')
        ],
        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
        'templateResult' => new JsExpression('function(city) { return city.text; }'),
        'templateSelection' => new JsExpression('function (city) { return city.text; }'),
    ],
]); ?>
            
        </div>
        <div class="col-md-4">
    <?= $form->field($model, 'id_ref_suplier')->widget(Select2::class,[
        'data'=>$refSuplier,
        'options'=>[
            'placeholder'=>'Pilih Salah Satu Suplier..'
        ]
    ]) ?>
            
        </div>
    </div>

<div class="row row-space-10">
<div class="col-md-4">
    <?= $form->field($model, 'qty')->label('Qty Masuk')->textInput() ?>
   
</div>
    <div class="col-md-6">
    <?= $form->field($model, 'harga_satuan')->textInput(['maxlength' => true]) ?>
    
    </div> 
    <div class="col-md-2">
    <?= $form->field($model, 'tgl_masuk')->textInput(['type'=>'date']) ?>
        
    </div>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>

<?php yii\widgets\Pjax::end() ?>
</div>
<?php

$this->registerJs(
   '$("document").ready(function(){ 
		$("#new_country").on("pjax:end", function() {
			 $.pjax.reload("#pjax-gudang-masuk" , {timeout : false});  //Reload GridView
		});
    });'
);
?>