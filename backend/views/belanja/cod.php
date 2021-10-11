<?php
use kartik\grid\GridView;
use yii\bootstrap4\Html;
use yii\helpers\Url;
?>

<div class="panel panel-inverse">
    <div class="panel-heading">
        Daftar COD
    </div>
    <div class="panel-body">
        <p>
        <?= Html::button('<i class="fa fa-plus"></i> Tambah Kurir',['class' => 'btn btn-success showModalButton',
            'value'=> \yii\helpers\Url::to(['/data-kurir/create-anggota'])]) ?>
    </p>     
        <?=
        GridView::widget([
            'dataProvider'=>$dataProvider,
            'columns'=>[
                [
                    'width'=>'1%',
                    'attribute'=>'no_acak',
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
                    'width'=>'1%'
                ],
                 ['attribute'=>'no_invoice','width'=>'1%'] ,
            [
                'header'=>'Total Pembayaran',
                'attribute'=>'sum_total',
                'width'=>'2%',
                'value'=>function($data){
            return number_format($data['sum_total'],0,',','.');
                }
                ] ,
                        [
                            'header'=>'Kurir',
                            'format'=>'raw',
                            'attribute'=>'id_data_kurir','width'=>'1%',
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
                          'attribute'=>'status_pesanan_kurir','width'=>'1%',
                          'value'=>function($data){
                                if(!$data['status_pesanan_kurir']){
                                    $label = "Proses Pengambilan barang";
                                }else{
                                    $label = "Barang sudah diterima";
                                }
                                return $label;
                          }
                          ] ,
                ['class'=> '\kartik\grid\ActionColumn','template'=>'{konfirmasi} {list-barang}','width'=>'15%',
                    'buttons'=>[
//                        'detail'=>function($url,$data){
//            $url = ['/produk/checkout-payment','no_invoice'=>$data['no_invoice']];
//            return Html::a('Konfirmasi Pembayaran', $url, ['class'=>'btn btn-warning']);
//                        },
                                'konfirmasi'=>function($url,$data){
//                                    $url=['create'];
                                      if($data['id_data_kurir']==''){
                                    return Html::button("Konfirmasi Kurir",['class'=>'btn btn-primary showModalButton',
                                        'value'=> Url::to(['/detail-pembayaran-kurir/create','no_invoice'=>$data['no_invoice']])]);
                                      }else{
                                           return Html::button("Detail Kurir",['class'=>'btn btn-primary showModalButton','value'=>Url::to(['/detail-pembayaran-kurir/view','id'=>$data['id_detail_kurir']])]);
                                      }
                                },
                                        'list-barang'=>function($url,$data){
                                            $url = ['list-barang','no_invoice'=>$data['no_invoice']];
                                            return Html::a('List Pesanan', $url,['class'=>'btn btn-md btn-success']);
                                        }
                    ]
                    ]
            ]
        ])
?>
    </div>
</div>

