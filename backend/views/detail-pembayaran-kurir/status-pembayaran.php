<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\DetailPembayaranKurir */

$this->title = false;
$this->params['breadcrumbs'][] = ['label' => 'Detail Pembayaran Kurirs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="detail-pembayaran-kurir-view">

    <p>
        <?= Html::a('Di terima', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
       
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
       //     'id',
     //       'no_invoice',
         //   'id_data_kurir',
         //   'status_pesanan_kurir',
            [
                'label'=>"Kurir",
                'value'=>function($data){
                    $dataKurir = \backend\models\DataKurir::find()->where(['id'=>$data['id_data_kurir']])->one();
                    return $dataKurir['nik'].' '.$data['nama_kurir'].', Telp : '.$data['telp'];
                }
            ],
                    [
                        'format'=>'raw',
                'label'=>"Status Pesanan",
             'value'=>function($data){
                                if($data['status_pesanan_kurir']=='0'){
                                    $label = "Proses Pengambilan barang";
                                }else{
                                    $label = "Barang sudah diterima";
                                }
                                return $label;
                          }
            ]
        ],
    ]) ?>

</div>
