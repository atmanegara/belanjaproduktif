<?php

use kartik\grid\GridView;
?>

<?=
GridView::widget([
    'panel'=>[
        'heading'=>'Detail Transaksi',
        'type'=> kartik\grid\GridView::TYPE_INFO
    ],
    'dataProvider'=>$dataProvider,
    'columns'=>[
        'no_invoice',
        'tahap_dp:text:Tahap Pembayaran',
//        [
//            'attribute'=>'id_status_dp',
//            'value'=>'statusDp.ket'
//        ],
        'nominal','uang_muka:text:Nominal Pembayaran','sisa',
        [
            'header'=>'Keterangan',
            'value'=>function($data){
                $no_acak = $data['no_acak'];
                $no_invoice = $data['no_invoice'];
                $statusKonfirmasi = backend\models\KonfirmasiPembayaran::find()->alias('a')
                        ->where([
                            'a.no_acak'=>$no_acak,
                            'a.no_invoice'=>$no_invoice
                        ])->one();
                $status_dp='';
                if($statusKonfirmasi['id_status_dp']=='1'){
                    $status_dp = "Tanggal Pembayaran : ".$statusKonfirmasi['tgl_transfer'];
                }elseif($statusKonfirmasi['id_status_dp']=='2'){
                    $status_dp = "Pembayaran Sudah Lunas, pertanggal : ".$statusKonfirmasi['tgl_konfirmasi'];
                }
                return $status_dp;
            }
        ]
    ]
])
?>
