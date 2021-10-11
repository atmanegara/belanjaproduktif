<?php
use kartik\grid\GridView;
use yii\bootstrap4\Html;
use yii\helpers\Url;
?>

<div class="note note-warning m-b-15">
								<h4><b>PERHATIAN</b></h4>
								<p>
									PASTIKAN BARANG SUDAH DITERIMA OLEH SI PEMBELI
								</p>
							</div>
<div class="panel panel-inverse">
    <div class="panel-heading">
        Daftar COD
    </div>
    <div class="panel-body">
        <?=
        GridView::widget([
            'dataProvider'=>$dataProvider,
            'columns'=>[
                [
                    'width'=>'3%',
                    'header'=>'Pembeli',
                    'value'=>function($data){
                        $dataAgen = \backend\models\DataAgen::find()->where(['no_acak'=>$data['no_acak']])->one();
                        return $dataAgen['id_agen'].' / '.$dataAgen['nama_agen'];
                    }
                ],
//                 [
//                    'attribute'=>'id_metode_pembayaran',
//                    'header'=>'Tanggal Checkout',
//                    'width'=>'2%',
//                     'value'=>function($data){
//                        $metodePembayaran = backend\models\MetodePembayaran::findOne($data['id_metode_pembayaran']);
//                        return $metodePembayaran['ket'];
//                     }
//                ],
                
                [
                    'attribute'=>'tgl_masuk',
                    'header'=>'Tanggal Checkout',
                    'width'=>'2%'
                ],
                 ['attribute'=>       'no_invoice','width'=>'5%'] ,
            [
                'header'=>'Total Pembayaran',
                'attribute'=>'sum_total',
                'width'=>'5%',
                'value'=>function($data){
            return number_format($data['sum_total'],0,',','.');
                }
                ] ,
                        [
                            'header'=>'Kurir',
                            'format'=>'raw',
                            'attribute'=>'id_data_kurir','width'=>'5%',
                            'value'=>function($data){
                                if($data['id_data_kurir']==''){
                                    $label = "<span class='label label-warning'>Kurir tidak ditemukan</span>";
                                }else{
                                   $label = "<span class='label label-success'>Ya Kurir Ada</span>";
                                }
                                return $label;
                            }
                        ],
                
                      [
                          'format'=>'raw',
                          'attribute'=>'status_pesanan_kurir','width'=>'5%',
                          'value'=>function($data){
                                if($data['status_pesanan_kurir']=='0'){
                                    $label = "Proses Pengambilan barang";
                                }else{
                                    $label = "Barang sudah diterima";
                                }
                                return $label;
                          }
                          ] ,
                ['class'=> '\kartik\grid\ActionColumn','template'=>'{bayar} ','width'=>'5%',
                    'buttons'=>[
                        'bayar'=>function($url,$data){
            $url = ['/produk/checkout-payment-cod-kurir','no_invoice'=>$data['no_invoice']];
            return Html::a('Konfirmasi Pembayaran', $url, ['class'=>'btn btn-warning']);
                        },
//                                'konfirmasi'=>function($url,$data){
////                                 
//                                    return Html::button("Bayar",['class'=>'btn btn-primary showModalButton',
//                                        'value'=> Url::to(['bayar','no_invoice'=>$data['no_invoice']])]);
//                                    
//                                }
                    ]
                    ]
            ]
        ])
?>
    </div>
</div>

