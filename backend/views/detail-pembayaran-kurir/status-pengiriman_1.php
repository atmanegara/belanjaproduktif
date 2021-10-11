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
           <?= Html::a('<i class="fa fa-backward"></i> Kembali', ['/produk/list-checkout-payment?status_pembayaran=3'], ['class' => 'btn btn-default']) ?>
     
    </p>
    <p>
        PESANAN ANDA SEDANG DIPROSES PIHAK TOKO
    </p>

</div>
