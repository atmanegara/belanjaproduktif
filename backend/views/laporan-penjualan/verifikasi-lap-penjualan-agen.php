<?php

use yii\bootstrap4\Html;
use yii\helpers\Url;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        Preview Laporan Penjualan Agen
    </div>
    <div class="panel-body">
       <div style="overflow: auto">
           <?=
        $this->render('print-lap-penjualan-agen', [
            'query' => $query,
            'no_acak' => $no_acak,
            'no_acak_user'=>$no_acak_user,
            'dataAgen'=>$dataAgen,
            'dataToko'=>$dataToko
        ])
        ?>    
</div>
     
    </div>
    <div class="panel-footer text-left">
  <p>
  <?php
   $url = ['/data-bagi-hasil/create', 'no_acak_tutup_buku' => $no_acak, 'no_acak_user' => $no_acak_user];
                            echo Html::button('Input Bagi Hasil', ['class' => "btn btn-md btn-info showModalButton", 'value' => Url::to($url)]);
  ?>
                <?= Html::a('PDF',['print-lap-penjualan-agen','no_acak'=>$no_acak,  'no_acak_user'=>$no_acak_user,'export'=>'pdf'] , ['class' => "btn btn-md btn-info"]) ?>
                
<?= Html::a('Excel', ['print-lap-penjualan-agen','no_acak'=>$no_acak,  'no_acak_user'=>$no_acak_user,'export'=>'xls'], ['class' => "btn btn-md btn-warning"]) ?>
            </p>
<?php
$role_id = Yii::$app->user->identity->role_id;
if(in_array($role_id, ['1'])){
    if($datatutup['verifikasi']=='1'){
      echo  yii\bootstrap4\Alert::widget([
            'options'=>[
                'class'=>'alert-success'
            ],
          'closeButton'=>false,
            'body'=>'Sudah Terverifikasi'
        ]);   
    }else{
echo Html::button('Verifikasi', ['class' => "btn btn-md btn-info showModalButton",
    'value' => yii\helpers\Url::to(['/tutup-buku/verifikasi', 'no_acak' => $no_acak])
]);
    }
}     
?>


    </div>
</div>
