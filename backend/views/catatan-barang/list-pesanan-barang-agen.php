<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CatatanBarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Catatan Barangs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catatan-barang-index">
  

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
         'panel'=>[
            'heading'=>'Daftar Catatan Pesanana Barang',
             'footer'=>false,
            'type'=> kartik\grid\GridView::TYPE_INFO,
        ],
        
        'toolbar'=>false,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn' ,'width'=>'1%',],
[
    'attribute'=>'id_ref_barang',
    'width'=>'7%',
    'value'=>function($data){
        return $data->refBarang->nama_barang;
    }
],
        ['attribute'=> 'qty', 'width'=>'1%'],
            [
                'attribute'=>"id_ref_satuan", 'width'=>'1%',
                'value'=>function($data){
   return  $data->refSatuan->nama_satuan;
                }  ],
            [
                'attribute'=>'id_ref_suplier', 'width'=>'1%',
                'value'=>function($data){
                    return $data->refSuplier->nama_suplier;
                }
            ],
      //      'id',
      //      'id_ref_barang',
     //       'id_ref_satuan',
     //       'qty',
      //      'id_data_agen',
            //'id_ref_suplier',
            //'tgl_pemesanan',

        ],
    ]); ?>
<p>
    <div class="text-left">
      <?= yii\bootstrap4\Html::a("Print PDF",['print-list-pesanan','no_acak'=>$no_acak,'export'=>'pdf'],['class'=>'btn btn-warning'])?>
       <?= yii\bootstrap4\Html::a("Print Excel",['print-list-pesanan','no_acak'=>$no_acak,'export'=>'xls'],['class'=>'btn btn-info'])?>
         
    </div>
    </p>
<?php
$role_id = Yii::$app->user->identity->role_id;
if(in_array($role_id, ['2'])){
    if($dterima=='N'){
    echo yii\bootstrap4\Html::a('Diterima',['/catatan-barang/diterima','no_acak'=>$no_acak],['class'=>"btn btn-primary",
        'data'=>[
            'method'=>'post',
            'confirm'=>'Barang sudah diterima?'
        ]
        ]);
    }else{
        ?>
    <div class="alert alert-success fade show">Sudah terkonfirmasi diterma</div>
    <?php
    }
}
?>
</div>
