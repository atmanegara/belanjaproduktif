<?php

use kartik\grid\GridView;
use yii\bootstrap4\Html;
use yii\helpers\Url;
?>

<div class="panel panel-inverse">
    <div class="panel-heading">

    </div>
    <div class="panel-body">
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'attribute' => 'id_metode_pembayaran',
                    'header' => 'Pembayaran Via',
                    'width' => '1%',
                    'value' => function($data) {
                        $metodePembayaran = backend\models\MetodePembayaran::findOne($data['id_metode_pembayaran']);
                        return $metodePembayaran['ket'];
                    }
                ],
                [
                    'attribute' => 'tgl_masuk',
                    'header' => 'Tanggal Checkout',
                    'width' => '5%'
                ],
                ['attribute' => 'no_invoice', 'width' => '3%'],
                [
                    'header' => 'Ongkos Kirim',
                    'attribute' => 'ongkir',
                    'width' => '10%',
                    'value' => function($data) {
                        return number_format($data['ongkir'], 0, ',', '.');
                    }
                ],
                [
                    'header' => 'Pembayaran',
                    'attribute' => 'sum_total',
                    'width' => '10%',
                    'value' => function($data) {
                        return number_format($data['sum_total'], 0, ',', '.');
                    }
                ],
                [
                    'header' => 'Total Pembayaran',
                    //     'attribute' => 'sum_total',
                    'width' => '10%',
                    'value' => function($data) {
                        return number_format($data['sum_total'] + $data['ongkir'], 0, ',', '.');
                    }
                ],
                ['attribute' => 'status_pembayaran', 'width' => '10%'],
                ['header' => 'Status Pesanan',
                    'format' => 'raw',
                    'value' => function($data) {
                        $status_booking = ' ';
                        switch (true) {
                            case in_array($data['status_booking'], [1, 0]):
                                if ($data['id_metode_pembayaran'] == '2') {
                                    if ($data['status_pesanan_kurir'] == '1') {
                                        $status_booking = "<span class='label label-success'> SELESAI </span>";
                                    }
                                } else {
                                    $status_booking = "<span class='label label-default'> - </span>";
                                }
                                break;
                            case in_array($data['status_booking'], [2]):
                                $status_booking = "<span class='label label-success'> SELESAI </span>";
                                break;
                            case in_array($data['status_booking'], [3]):
                                $status_booking = "<span class='label label-danger'> BATAL </span>";
                                break;
                        }
                        return $status_booking;
                    },
                    'width' => '10%'],
                ['class' => '\kartik\grid\ActionColumn', 'template' => '{detail} {konfirmasi}', 'width' => '30%',
                    'buttons' => [
                        'detail' => function($url, $data) {
                            switch ($data['id_metode_pembayaran']) {
                                case 1: //Aplikasi
                                    if($data['id_status_pembayaran']==2){
                                    $url = ['/produk/checkout-payment', 'no_invoice' => $data['no_invoice']];
                                    return Html::a('Detail', $url, ['class' => 'btn btn-warning']);
                                    }else{
                                        return '';
                                    }
                                    break;
                                case 2://COD;
                                    $url = ['/produk/checkout-payment-cod', 'no_invoice' => $data['no_invoice']];
                                    return Html::a('Detail', $url, ['class' => 'btn btn-warning']);
                                    break;
                                case 3://TOKO;
                                    $url = ['/produk/checkout-payment-toko', 'no_invoice' => $data['no_invoice']];
                                    return Html::a('Detail', $url, ['class' => 'btn btn-warning']);
                                    break;
                            }
                        },
                        'konfirmasi' => function($url, $data) {
                            switch ($data['id_metode_pembayaran']) {
                                case 1: //Aplikasi
                                    $url = ['/produk/konfirmasi-payment', 'no_invoice' => $data['no_invoice']];
                                    $id_status_pembayaran = $data['id_status_pembayaran'];
                                    if ($id_status_pembayaran == '3') {
                                        return Html::a("Konfirmasi Pembayaran", $url, ['class' => 'btn btn-md btn-success']);
                                    } else {
                                        return '';
                                    }
                                    break;
                                case 2://COD;
                                    $url = ['/detail-pembayaran-kurir/status-pengiriman', 'no_invoice' => $data['no_invoice']];
                                    $id_status_pembayaran = $data['id_status_pembayaran'];
                                    if ($id_status_pembayaran == '3') {
                                        return Html::a("Lacak Barang", $url, ['class' => 'btn btn-md btn-success']);
                                    } else {
                                        return '';
                                    }
                                    break;
//                                case 3://Toko;
//                                    $url = ['/produk/konfirmasi-payment', 'no_invoice' => $data['no_invoice']];
//                                    $id_status_pembayaran = $data['id_status_pembayaran'];
//                                    if ($id_status_pembayaran == '3') {
//                                        return Html::a("Konfrrmasi Pembayaran", $url, ['class' => 'btn btn-md btn-success']);
//                                    } else {
//                                        return '';
//                                    }
//                                    break;
                            }
                        }
                    ]
                ]
            ]
        ])
        ?>
    </div>
</div>

