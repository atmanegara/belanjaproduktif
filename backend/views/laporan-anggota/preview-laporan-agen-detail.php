<?php
use yii\bootstrap4\Html;
use yii\helpers\Url;

?>
<div class="panel panel-primary">
    <div class="panel-heading">
        Daftar Rekap Angen
    </div>
    <div class="panel-body">
        <?=
$this->render('print-laporan-agen-detail',[
    'query'=>$query,
    'no_acak'=>$no_acak,
            'modelTentangKami'=>$modelTentangKami,
    'modelFotoProfil'=>$modelFotoProfil
]);
?>
    </div>
    <div class="panel-footer">
         <?php 
 yii\bootstrap4\ActiveForm::begin([
             'action'=>['print-laporan-agen-detail'],'layout' => 'inline',
            'method'=>'POST'
         ]);
                echo Html::hiddenInput('tgl_awal',$tgl_awal );
                echo Html::hiddenInput('tgl_akhir', $tgl_akhir);
                echo Html::hiddenInput('refagen', $id_ref_agen);
                echo Html::dropDownList('export', null, [
                    'pdf'=>'PDF','xls'=>'EXCEL'
                ],[
                    'prompt'=>'Pilih Salah Satu Export..',
                    'class'=>'form-control'
                ]);
echo Html::submitButton('Export', ['class' => "btn btn-md btn-info"]);
yii\bootstrap4\ActiveForm::end();
?>


    </div>
</div>