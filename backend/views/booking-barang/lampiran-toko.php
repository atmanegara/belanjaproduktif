<?php

use yii\bootstrap4\Html;
use yii\helpers\Url;
?>
         <p>
                <?= Html::a('Kembali',['index'], ['class' => 'btn btn-md btn-default']) ?>
                <?= Html::a('Cetak PDF',\yii\helpers\Url::to(['print-lampiran-toko','no_invoice'=>$no_invoice,'kd_booking'=>$kd_booking,'export'=>'pdf']), ['class' => 'btn btn-md btn-info']) ?>
                <?= Html::a('Cetak Excel',\yii\helpers\Url::to(['print-lampiran-toko','no_invoice'=>$no_invoice,'kd_booking'=>$kd_booking,'export'=>'xls']), 
                        ['class' => 'btn btn-md btn-warning']) ?>
             <?php 
                  
                            $url= yii\helpers\Url::to(['/belanja/print-thermal-faktur','no_invoice'=>$no_invoice]);
    echo Html::a('<i class="fa fa-file"></i> Print Thermal ',$url,['class'=>'btn btn-default ',
          'onClick'=>
		                        "window.open('".$url."',
                         'newwindow',
                         'width=400,height=250');
              return false;"
        ]);
             ?>

            </p>
 
    <div class="panel panel-primary">
        <div class="panel-heading">
            Daftar Lampiran
        </div>
        <div class="panel-body">
                
                <?=
                $this->render('print-lampiran-toko', [
              'model'=>$model,'no_invoice'=>$no_invoice,'modelBooking'=>$modelBooking,'dataAgenPembeli'=>$dataAgenPembeli
                ])
                ?>
            
        </div>
        <div class="panel-footer">
            <p>
<?php
if($modelBooking['status_booking']=='2' or $modelBooking['status_booking']=='0'){
echo '<div class="alert alert-success fade show">Data pesanan sudah di verifikasi</div>';    
if($modelBooking['status_booking']=='0'){
echo '<div class="alert alert-danger fade show">Data pesanan Status Dibatalkan</div>';    
    
}
}else{
    ?>
                
<?= Html::button('Konfirmasi', ['class' => 'btn btn-md btn-warning showModalButton','value'=> \yii\helpers\Url::to(['konfirmasi-booking','no_invoice'=>$no_invoice,'kd_booking'=>$kd_booking])]);?>

<?= Html::a('Batal',['batal-booking','kd_booking'=>$kd_booking], ['class' => 'btn btn-danger','data'=>[
            'method'=>'post',
            'confirm'=>'Anda Yakin Batalkan Pesanan'
        ]]) ;
}
        ?>
            </p>      
        </div>
    </div>
        