<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TutupBuku */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tutup-buku-form">
  <div class="note note-primary m-b-15">
					<div class="note-icon"><i class="fas fa-info"></i></div>
					<div class="note-content">
						<h4><b>Informasi!</b></h4>
						<p>
							PENGAJUAN LAPORAN HANYA PERHARI, DISARANKAN LAKUKAN SETELAH SELESAI TRANSAKSI DALAM 1 HARI (TUTUP TOKO) 
                                                </p>
                                                <p>
                                                    *<i>Pastikan di laporkan pada bulan dan tahun transaksi cukup 1x, bagaimana jika ada kesalahan laporan / laporan, hapus terlebih dulu</i>
                                                </p>
					</div>
				</div>
    <?php $form = ActiveForm::begin([
        'id'=>'tutup-buku-form'
       //  'layout' => ActiveForm::LAYOUT_HORIZONTAL,
    ]); ?>

    <?= $form->field($model, 'no_acak_user')->label(false)->hiddenInput() ?>
    <div class="row row-space-12">

         <div class="col-md-6">
     <?php
     $bulan = date('m');
     $tahun = date('Y');
     if($bulan=='12'){
      $bulanmax='12';   
     }else{
     $bulanmax=$bulan+1;
     }
     $hari = cal_days_in_month(CAL_GREGORIAN, $bulanmax, $tahun);
     echo $form->field($model, 'tgl_lapor',['enableAjaxValidation'=>true])->label('Tanggal Awal Laporan Transaksi')->textInput([
         'value'=>date('Y-m-d'),
         'type'=>'date','min'=>"2020-$bulan-01",'max'=>"$tahun-$bulanmax-$hari",
            
                 'onChange'=>'sama(this.value)'
             ])
             ?>
      
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'tgl_lapor_akhir')->label('Tanggal Akhir Laporan Transaksi')->textInput([
         'value'=>date('Y-m-d'),
                'readOnly'=>true,
         'type'=>'date','min'=>"2020-$bulan-01",'max'=>"$tahun-$bulanmax-$hari"])?>
        </div>
    </div>
 


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
sama=(tgllapor)=>{
    console.log(tgllapor);
    $("#tutupbuku-tgl_lapor_akhir").val(tgllapor);
}
</script>