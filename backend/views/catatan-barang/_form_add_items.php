<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CatatanBarang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="catatan-barang-form">

    <?php $form = ActiveForm::begin([
        'id'=>'form-catatan-barang-form'
    ]); ?>
    <div class="row row-space-10">
        <div class="col-md-6">
            
            <?php
            echo Html::label('Nama Agen');
            echo Html::textInput('nama_agen',$dataAgen['nama_agen'],['class'=>'form-control','disabled'=>'disabled']);
            ?>
    <?= $form->field($model, 'id_data_agen')->label(false)->hiddenInput() ?>
        </div>
 <div class="col-md-6">
            
    <?= $form->field($model, 'tgl_pemesanan')->textInput() ?>
        </div>

            
    </div>
    
    <?= $form->field($model, 'id_ref_barang')->label(false)->hiddenInput() ?>
            <?= Html::textInput('nama_barang',$querbarang['nama_barang'],['class'=>'form-control','disabled'=>'disabled']) ?>
    <?= $form->field($model, 'id_ref_suplier')->label('Suplier / Penyalur')->dropDownList($modelSuplier,['prompt'=>'Pilih Salah Satu..']) ?>
    <div class='row row-space-12'>
        <div class="col-md-4">
    <?= $form->field($model, 'id_ref_satuan')->label('Jenis Satuan')->dropDownList($modelSatuan,['prompt'=>'Pilih Salah Satu..']) ?>
            
        </div>
        <div class="col-md-4">
    <?= $form->field($model, 'qty')->textInput(['type'=>'number']) ?>
            
        </div>
          <div class="col-md-4">
    <?= $form->field($model, 'harga_satuan')->label('Harga Modal')->widget(kartik\number\NumberControl::class,[
        'disabled' => true,
        'maskedInputOptions' => [
        'prefix' => 'Rp ',
        'groupSeparator' => '.',
        'radixPoint' => ',',
              'rightAlign' => false
    ],
    ])
 ?>
            
        </div>
    </div>




    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
