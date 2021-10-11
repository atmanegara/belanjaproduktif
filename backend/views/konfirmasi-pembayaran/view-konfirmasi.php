<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\KonfirmasiPembayaran */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Konfirmasi Pembayarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="konfirmasi-pembayaran-view">

     <div class="note note-primary m-b-15">
					<div class="note-icon"><i class="fas fa-info"></i></div>
					<div class="note-content">
						<h4><b>Informasi!</b></h4>
						<p>
							VERIFIKASI PEMBAYARAN AKAN DI INFORMASIKAN VIA TELP / WA / EMAIL, PASTIKAN DATA YANG ANDA ISI SUDAH BENAR DAN AKTIF (EMAIL)
                                                </p>
                                                <p>
                                                    <i>Info lengkap silahkan hubungi pihak Admin BP</i>
                                                </p>
					</div>
				</div>  
    <p>
<?=
DetailView::widget([
    'model'=>$model,
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
    'buttons1' => false,//Yii::$app->user->isGuest ? '{view} {delete}' : '{view}',
    'attributes'=>[
        'no_invoice',
        'nominal',
        ['attribute'=>'tgl_transfer'],
    ]
]);
?>
                                </p>
</div>
