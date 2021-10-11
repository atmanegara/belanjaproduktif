<?php
use yii\bootstrap4\Html;
?>

<div class="panel panel-primary">
    <div class="panel-heading">
          <?= Html::a('Cetak PDF',\yii\helpers\Url::to(['print-list-barang','no_invoice'=>$no_invoice,'export'=>'pdf']), ['class' => 'btn btn-md btn-info','target'=>'_blank']) ?>
                <?= Html::a('Cetak Excel',\yii\helpers\Url::to(['print-list-barang','no_invoice'=>$no_invoice,'export'=>'xls']), 
                        ['class' => 'btn btn-md btn-warning']) ?>
    </div>
    <div class="panel-body">
        <?=$this->render('print-list-barang',[
            
             'model'=>$model,
            'dataAgen'=>$dataAgen,
            'modelCheckOut'=>$modelCheckOut,
            'modelAgen'=>$modelAgen,
            'no_invoice'=>$no_invoice,
            'detailPembayaran'=>$detailPembayaran
            ])?>
    </div>
    <div class="panel-footer">        
        <?= Html::a('BATAL',\yii\helpers\Url::to(['konfirmasi-cod-batal','no_invoice'=>$no_invoice]), 
            ['class' => 'btn btn-md btn-danger',
                'data'=>[
                    'confirm'=>'Yakin pesanan ini di batalkan, Hati-hati pesanan tidak bisa di kembalikan?',
                    'method'=>"POST"
                ]
                ]) ?>
  
    </div>
</div>