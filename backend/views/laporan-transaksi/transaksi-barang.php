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

        <?php
        Pjax::begin([
            'id' => 'lap-transaksi'
        ]);
        $form = ActiveForm::begin()
        ?>
        <div class="row row-space-12">
            <div class="col-md-3">
         <?= $form->field($modelDynamic, 'tgl_awal')->textInput(['type' => 'date']) ?>
                  
            </div>
            <div class="col-md-3">
               <?= $form->field($modelDynamic, 'tgl_akhir')->textInput(['type' => 'date']) ?>
              
            </div>
            <div class="col-md-3">
                 <div class="form-group">
                     <div style="padding-top: 26px">
<?= Html::submitButton("<i class='fa fa-search'></i> Cari", ['class' => 'btn btn-primary']) ?>
        <?= Html::a("<i class='fa fa-stop'></i> Reset", ['transaksi-barang'], ['class' => 'btn btn-warning']) ?></div>
        </div>
            </div>
        </div>
       
        <div style="border: solid blue;padding: 20px 20px 20px 20px">
           
                  <?php
        if ($dataTransaksiBarang) {
            echo '<p>';
            echo Html::a("<i class='fa fa-pdf'></i> PDF", ['print-lap-transaksi',
                'tgl_awal' => $modelDynamic->tgl_awal,
                'tgl_akhir' => $modelDynamic->tgl_akhir,
                'export'=>'pdf'
                    ], ['class' => 'btn btn-md btn-warning']);
            
            echo Html::a("<i class='fa fa-pdf'></i> Excel", ['print-lap-transaksi',
                'tgl_awal' => $modelDynamic->tgl_awal,
                'tgl_akhir' => $modelDynamic->tgl_akhir,
                'export'=>'xls'
                    ], ['class' => 'btn btn-md btn-info']);
            echo '</p>';
            
            echo $this->render('print-lap-transaksi', [
                'dataTransaksiBarang' => $dataTransaksiBarang,
                'tgl_awal' => $modelDynamic->tgl_awal,
                'tgl_akhir' => $modelDynamic->tgl_akhir,
                'dataAgen' => $dataAgen
            ]);
        }
        ?>
        </div>
      

        <?php
       ActiveForm::end();
        Pjax::end();
        ?>
    </div>
</div>