<?php

use yii\bootstrap4\Html;
use yii\helpers\Url;
use kartik\form\ActiveForm;
use yii\widgets\Pjax;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        Transaksi PerAgen
    </div>
    <div class="panel-body">

       
        <div style="border: solid blue;padding: 20px 20px 20px 20px">
           
                  <?php
      
            echo '<p>';
            echo Html::a("<i class='fa fa-pdf'></i> PDF", ['print-lap-stok-harian',
                'export'=>'pdf'
                    ], ['class' => 'btn btn-md btn-warning']);
            
            echo Html::a("<i class='fa fa-pdf'></i> Excel", ['print-lap-stok-harian','export'=>'xls'
                    ], ['class' => 'btn btn-md btn-info']);
            echo '</p>';
            
            echo $this->render('print-lap-stok-harian', [
                'dataStokBarang' => $dataStokBarang,
                 'dataAgen' => $dataAgen
            ]);
     
        ?>
        </div>
      

      
    </div>
</div>