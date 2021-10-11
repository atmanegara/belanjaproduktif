<?php
use yii\bootstrap4\Html;
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        Daftar Bagi Hasil
    </div>
    <div class="panel-body">
       
        <?= $this->render('print-lap-bagi-hasil',[
            'query'=>$query,
            'queryAtur'=>$queryAtur,
            'no_acak'=>$no_acak
        ]) ?>
    </div>
    <div class="panel-footer">
        <p>
            <?= Html::a('PDF',['print-lap-bagi-hasil','no_acak'=>$no_acak,'export'=>'pdf'],['class'=>'btn btn-md btn-warning']);?>
            <?= Html::a('Excel',['print-lap-bagi-hasil','no_acak'=>$no_acak,'export'=>'xls'],['class'=>'btn btn-md btn-info']);?>
        </p>
    </div>
</div>
