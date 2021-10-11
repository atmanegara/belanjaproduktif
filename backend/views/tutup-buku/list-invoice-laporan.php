<?php
use kartik\grid\GridView;

use kartik\form\ActiveForm;
use yii\bootstrap4\Html;
?>

    <p>
           <?= Html::a('<i class="fa fa-backward"></i> Kembali', ['index'], ['class' => 'btn btn-default']) ?>
     
    </p>
<?php
$form  = ActiveForm::begin();
?>
<?=
GridView::widget([
    'panel'=>[
        'type'=>'success',
        'heading'=>'Daftar Invoice Yang belum terlaporkan'
    ],
    'dataProvider'=>$dataProvider,
    'columns'=>[
        [
          'class'=> 'kartik\grid\CheckboxColumn'  
        ],
        'no_invoice',
        'tgl_transaksi',
        [
            'header'=>"Metode",
            'format'=>'raw',
            'value'=>function($data){
                $cekdataPembayaran = \backend\models\DetailPembayaran::find()->where(['no_invoice'=>$data['no_invoice']]);
                if($cekdataPembayaran->exists()){
                    $html = $cekdataPembayaran->one()->metodePembayaran->ket;
                }else{
                    $html = 'Belum Checkout';
                }
                return $html;
            }
        ]
    ]
    
])

?>
<?= $form->field($model,'tgl_lapor')->label(false)->hiddenInput() ?>
<?= $form->field($model,'tgl_lapor_akhir')->label(false)->hiddenInput() ?>
<?=
Html::submitButton('Buat Laporan ', ['class'=>'btn btn-md btn-primary'])
?>
<?php ActiveForm::end() ?>