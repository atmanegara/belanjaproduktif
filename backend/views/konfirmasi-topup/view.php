<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\KonfirmasiTopup */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Konfirmasi Topups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="konfirmasi-topup-view">

    <h1><?= Html::encode($this->title) ?></h1>
  <p>
        <?= Html::button('Konfirmasi Pembayaran', ['class' => 'btn btn-primary showModalButton',
            'value'=>Url::to(['update', 'id' => $model->id])
        ]) ?>
        
    </p>
  

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
      //      'id',
            'no_acak',
            'no_invoice',
      //     'id_metode_transfer',
            'nominal',
//             'from_bank',
//             'tgl_transfer',
//             'filename',
            ['attribute'=>'id_status_pembayaran',
                'value'=>function($model){
                 return $model->statusPembayaran->status_pembayaran;   
                }
                ]
        ],
    ]) ?>

</div>
