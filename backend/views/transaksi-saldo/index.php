<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TransaksiSaldoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Transaksi Saldo';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaksi-saldo-index">

   
    <p>
    <?=
Html::a('<i class="fa fa-backward"></i> Kembali',['/data-saldo/index-agen'],['class'=>"btn btn-md btn-default"]);
?>
    </p>
    <?= GridView::widget([
        'showPageSummary'=>true,
        'panel'=>[
            'type'=> \kartik\grid\GridView::TYPE_INFO,
            'heading'=>'Daftar Riwayat Transaksi Saldo'
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
'no_invoice',
       //     'id',
            'tgl_transaksi',
            [
              'header'=>"Nominal Masuk",
                'format'=>'decimal',
                'pageSummary'=>true,
                'attribute'=>'nominal_masuk'
            ],
            [
              'header'=>"Nominal Keluar",
                'pageSummary'=>true,
                'format'=>'decimal',
                'attribute'=>'nominal_keluar'
            ],
            [
              'header'=>"Nominal Akhir",
              //  'pageSummary'=>true,
                'format'=>'decimal',
                'attribute'=>'nominal_sisa'
            ],
//            'nominal_masuk:decimal:Nominal Masuk',
//            'nominal_keluar:decimal:Nominal Keluar',
//            'nominal_sisa:decimal:Sisa (Keluar-Masuk)',
            ['attribute'=>'id_metode_transfer',
                'value'=>function($data){
        $meto = \backend\models\MetodeTransfer::findOne($data['id_metode_transfer']);
        return $meto ? $meto['nm_metode_transfer'] : '-';
                }
                ],
                         ['attribute'=>'id_ref_bank',
                'value'=>function($data){
        $meto = \backend\models\RefBank::findOne($data['id_ref_bank']);
        return $meto ? $meto['nm_bank'] : '-';
                }
                ],
//            ['attribute'=>'id_ket_saldo',
//                'header'=>''
//                'value'=>function($data){
//        $meto = \backend\models\KetSaldo::findOne($data['id_ket_saldo']);
//        return $meto ? $meto['ket_saldo'] : '-';
//                }
//                ],

          //  ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
