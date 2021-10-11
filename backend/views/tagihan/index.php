<?php
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap4\Html;



?>
<div class="note note-primary">
  <div class="note-icon"><i class="fa fa-info-circle"></i></div>
  <div class="note-content">
    <h4><b>Informasi!</b></h4>
    <p> Halaman ini berisi daftar tagihan penjualan yang belum bayar</p>
  </div>
</div>
<?=
GridView::widget([
    'dataProvider'=>$dataProvider,
    'panel'=>[
      'type'=> GridView::TYPE_INFO,
        'heading'=>'Daftar Transaksi'
        ],
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
        [
            'attribute'=>'id_status_pembayaran',
            'value'=>'statusPembayaran.status_pembayaran'
        ],
        [
            'class'=> '\kartik\grid\ActionColumn',
            'template'=>'{detail}',
            'buttons'=>[
                'detail'=>function($url,$data,$key){
    $no_invoice = $data['no_invoice'];
    $url = Url::to(['detail','no_invoice'=>$no_invoice]);
    return Html::a('Detail', $url, ['class'=>'btn btn-warning ']);
                }
            ]
        ]
    ]
])
?>