<?php
use kartik\grid\GridView;
use yii\bootstrap4\Html;
use yii\helpers\Url;
?>

<div class="alert alert-danger alert-dismissible">
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                PASTIKAN AGEN YANG BERHENTI SUDAH DILAKUKAN KONFIRMASI KE PIHAK AGEN, AGEN YANG SUDAH BERHENTI TIDAK BISA DIKEMBALIKAN LAGI
              </div>

<p>
<?= Html::a('Masukkan Agen Berhenti',['index-agen'],['class'=>"btn btn-md btn-danger "]) ?>
</p>
<?=
GridView::widget([
    'panel'=>[
        'type'=> GridView::TYPE_SUCCESS,
        'heading'=>'Daftar Agen berhenti'
    ],
    'dataProvider'=>$dataProvider,
    'columns'=>[
        'nik','nama_agen','tgl_berhenti','alasan'
    ]
])
?>

