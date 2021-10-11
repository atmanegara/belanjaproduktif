<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\KonfirmasiTopup */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Konfirmasi Topups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="konfirmasi-topup-view">


    <p>
    <?=
Html::a('<i class="fa fa-home"> </i>Kembali',['index'],['class'=>"btn btn-md btn-default"]);
?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
         'condensed'=>true,
    'hover'=>true,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=>'Invoice # ' . $model->no_invoice,
        'type'=>DetailView::TYPE_INFO,
        'headingOptions'=>[
            'template'=>false
        ]
    ],
        'buttons1' => false,
        'attributes' => [
      //      'id',
            'no_acak',
            'no_invoice',
      //     'id_metode_transfer',
            'nominal',
//             'from_bank',
             'tgl_transfer',
//             'filename',
            ['attribute'=>'id_status_pembayaran',
                'value'=>$model->statusPembayaran->status_pembayaran   
                
                ]
        ],
    ]) ?>

</div>
