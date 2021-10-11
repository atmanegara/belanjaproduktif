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
<div class="note note-danger note-with-left-icon m-b-15">
								<div class="note-icon"><i class="fa fa-lightbulb"></i></div>
								<div class="note-content text-left">
									<h4><b>WARNING!</b></h4>
									<p>
										PASTIKAN ITEM YANG DIHAPUS SUDAH BENAR DAN YAKIN, KARENA DATA TIDAK BISA DIKEMBALIKAN LAGI, HAPUS PERMANEN 
									</p>
								</div>
							</div>
    <?php $form = ActiveForm::begin([
    'id' => 'data-barang-form',
        'enableAjaxValidation'=>false
    ]); ?>
    <?= $form->field($model, 'id_data_agen')->label(false)->hiddenInput() ?>
<div class='row row-space-10'>
	<div class='col-md-4'>
    <?= $form->field($model, 'kode_barcode')->textInput(['readOnly'=>true]) ?>
	</div>
    <div class="col-md-8">
        <div class="form-group">
                <?= $form->field($model, 'item_barang')->textInput(['readOnly'=>true]) ?>

        </div>
    </div>
	
</div>
    <div class="row row-space-10">
          <div class="col-md-12">
        <?= $form->field($model,'alasan')->textarea(['rows'=>'6',
            'placeholder'=>'Max : 160 Karekter'
        ]) ?>
          </div>
    </div>
    

    <div class="form-group">
        <?= Html::submitButton('HAPUS', ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
buatgenerate =()=>{
    var uid = (new Date().getTime())
    
    $("#databarang-barkode").val(uid);
}
</script>