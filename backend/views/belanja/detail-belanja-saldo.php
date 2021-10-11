<?php
use kartik\grid\GridView;
use yii\bootstrap4\Html;
use yii\helpers\Url;

?>
<p>
    
</p>
<?=
GridView::widget([
    'panel'=>[
        'type'=> GridView::TYPE_INFO,
        'heading'=>'Daftar Belanja #'.$modelTransaksiBarang['no_invoice'].', Tanggal Transaksi : '.$modelTransaksiBarang['tgl_transaksi']
    ],
    'toolbar'=>false,
'showPageSummary'=>true,
    'dataProvider'=>$dataProvider,
    'hover'=>true,
    'columns'=>[
        'nama_barang','qty:text:Banyak','harga_jual:text:Harga Jual',
        [
            'attribute'=>"total_jual",
            'header'=>'Total Jual',
            'pageSummary'=>true,
            'value'=>function($data){
    return number_format($data['total_jual'],0,',','.');
            }
        ]
    ]
])
?>
