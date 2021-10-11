<?php
use kartik\grid\GridView;
use yii\bootstrap4\Html;
use yii\helpers\Url;
?>
<div class="note note-primary">
  <div class="note-icon"><i class="fa fa-info-circle"></i></div>
  <div class="note-content">
    <h4><b>Informasi!</b></h4>
    <p> Halaman ini berisi daftar tagihan franchise yang dibayar secara cicil / kredit </p>
  </div>
</div>
<?=
GridView::widget([
    'panel'=>[
        'heading'=>'Daftar Tagihan Biaya Pendaftaran Mitra',
        'type'=> \kartik\grid\GridView::TYPE_INFO
    ],
    'dataProvider'=>$dataProvider,
    'columns'=>[
        'no_invoice',
        [
          'header'=>'Agen',
            'value'=>function($data){
    $no_acak = $data['no_acak'];
   $namaAgen='-';
    $dataAgen = \backend\models\DataAgen::find()->where(['no_acak'=>$no_acak]);
    if($dataAgen->exists()){
        $namaAgen = $dataAgen->one();
        $namaAgen = $namaAgen['id_agen'].' - '.$namaAgen['nama_agen'];
    }
    return $namaAgen;
            }
        ],
        'tgl_transfer',
        [
            'class'=> '\kartik\grid\ActionColumn',
            'template'=>'{detail}',
            'buttons'=>[
                'detail'=> function ($url,$data){
    $no_acak = $data['no_acak'];
    $url = Url::to(['detail-transaksi-franchise','no_acak'=>$no_acak]);
                    return Html::a('Detail', $url,['class'=>'btn btn-md btn-warning']);
                }
            ]
        ]
    ]
])
?>