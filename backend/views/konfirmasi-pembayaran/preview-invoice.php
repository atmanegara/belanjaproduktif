
<?php 
use yii\helpers\Html;
use kartik\detail\DetailView;
?>
<div class="panel panel-primary space-row-10">
    <div class="panel-heading">
       Preview Laporan
    </div>
    <div class="panel-body">
        <?= $this->render('print-invoice',[
            'query'=>$query,
               'no_acak'=>$no_acak,
            'modelTentangKami'=>$modelTentangKami,
               'modelFotoProfil'=>$modelFotoProfil,
               'dataAgen'=>$dataAgen,
            'modelTandaTangan'=>$modelTandaTangan,
            'namaAgen'=>$namaAgen
         ]) ?>
    </div>
    <div class="panel-footer">
         <?= Html::a('PDF',['print-invoice','id'=>$id] , ['class' => "btn btn-md btn-warning"]) ?>
    
    </div>
</div>