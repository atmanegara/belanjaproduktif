<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TransaksiBarang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaksi-barang-form">
<h1 class="page-header">Halaman Input   </h1>
      <div class="note note-primary m-b-15">
					<div class="note-icon"><i class="fas fa-info"></i></div>
					<div class="note-content">
						<h4><b>Informasi!</b></h4>
						<p>
							Halaman informasi daftar transaksi item barang per produk barang
                                               

                                                </p>
					</div>
				</div>
<div class="panel panel-inverse">
    <div class="panel-heading">
        FORM INPUT BY BARCODE
    </div>
    <div class="panel-body">
          <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'id_data_agen')->label(false)->hiddenInput() ?>

    <?= $form->field($model, 'id_data_barang')->label(false)->hiddenInput() ?>
    <div class='row row-space-10'>
    	<div class='col-md-4'>
    <?= $form->field($model, 'nama_item')->textInput(['disabled'=>true]) ?>
    	
    	</div>
  <div class='col-md-4'>
    	
    <?= $form->field($model, 'barkode')->textInput(['disabled'=>true]) ?>
    	</div>
    	<div class='col-md-4'>
    	
    <?= $form->field($model, 'tgl_transaksi')->textInput(['type'=>'date']) ?>
    </div>
    </div>
    <div class='row row-space-10'>
    	<div class='col-md-6'>
    <?= $form->field($model, 'qty')->label('Jumlah Item Keluar')->textInput(['type'=>'number','onChange'=>'hitung(this.value)']) ?>
  </div>
<div class='col-md-6'>
    <?= $form->field($model, 'harga_jual')->label('Total NIlai Pengeluaran')->textInput(['maxlength' => true]) ?>

</div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
    </div>
</div>
</div>
<script>
    const hitung=(qty_keluar)=>{
     //   console.log(qty_keluar*<?=$harga_jual?>);
        $("#transaksibarang-harga_jual").val(qty_keluar*<?=$harga_jual?>)
    }
    </script>