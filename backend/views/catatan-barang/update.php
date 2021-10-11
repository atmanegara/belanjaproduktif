<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\CatatanBarang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="catatan-barang-form">

    <?php $form = ActiveForm::begin(['id'=>'form-data-catatan']); ?>

          <?= Html::textInput('nama_barang',$querbarang['nama_barang'],['class'=>'form-control','disabled'=>'disabled']) ?>
    <div class='row row-space-12'>
        <div class="col-md-3">
               <?= $form->field($model, 'id_ref_suplier')->label('Suplier / Penyalur')->dropDownList($modelSuplier,['prompt'=>'Pilih Salah Satu..']) ?>
 
        </div>
        <div class="col-md-3">
    <?= $form->field($model, 'id_ref_satuan')->label('Jenis Satuan')->dropDownList($modelSatuan,['prompt'=>'Pilih Salah Satu..']) ?>
            
        </div>
        <div class="col-md-3">
    <?= $form->field($model, 'qty')->textInput(['type'=>'number']) ?>
            
        </div>
          <div class="col-md-3">
    <?= $form->field($model, 'harga_satuan')->label('Harga Modal')->widget(kartik\number\NumberControl::class,[
         'disabled' => true,
        'maskedInputOptions' => [
        'prefix' => 'Rp ',
        'groupSeparator' => '.',
        'radixPoint' => ',',
              'rightAlign' => false
    ],
    ]) ?>
          </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
