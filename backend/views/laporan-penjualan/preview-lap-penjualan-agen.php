<?php

use yii\bootstrap4\Html;

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
        <div class=" text-right">
            <p>
                <?= Html::a('PDF',['print-lap-penjualan-agen','no_acak'=>$no_acak,  'no_acak_user'=>false,'export'=>'pdf'] , ['class' => "btn btn-md btn-info"]) ?>
                
<?= Html::a('Excel', ['print-lap-penjualan-agen','no_acak'=>$no_acak,'no_acak_user'=>false,'export'=>'xls'], ['class' => "btn btn-md btn-warning"]) ?>
            </p>

        </div>
        <div style="overflow: auto">
        <?=
        $this->render('print-lap-penjualan-agen', [
            'query' => $query,
            'no_acak' => $no_acak,
            'no_acak_user'=>false,
            'dataAgen'=>$dataAgen,
            'dataToko'=>$dataToko
        ])  
        ?>
            
        </div>
    </div>
    <div class="panel-footer">
        <p>
           
        </p>
    </div>
</div>
