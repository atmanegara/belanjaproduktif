<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\DetailPembayaranKurir */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Detail Pembayaran Kurirs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="detail-pembayaran-kurir-view">

   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
       //     'id',
            'no_invoice',
          //  'id_data_kurir',
            [
                'label'=>'Kurir',
                'format'=>'raw',
                'value'=>function($model){
                $dataKurir = \backend\models\DataKurir::findOne($model['id_data_kurir']);
                return 'NIK : '. $dataKurir['nik'].' <br>'.'Nama : '. $dataKurir['nama_kurir'].' <br> '.'Telp : '.$dataKurir['telp_kurir'];
                }
            ], 
                    [
                'label'=>'Status Pesanan',
                'value'=>function($model){
               
                return $model['status_pesanan_kurir']=='0' ? "DI PROSES" : "DITERIMA";
                }
            ]
        ],
    ]) ?>

</div>
