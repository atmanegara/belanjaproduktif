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
    <p>
       <?= Html::a('Kembali', ['index-agen'], ['class' => 'btn btn-default']) ?>
    </p>
    <div class="panel panel-info">
        <div class="panel-heading">
            Daftar Catatan
        </div>
        <div class="panel-body">
               <?= GridView::widget([
        'dataProvider' => $dataProvider,
//         'panel'=>[
//            'header'=>'Daftar Catatan',
//            'type'=> kartik\grid\GridView::TYPE_INFO
//        ],
          'toolbar'=>false,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
[
    'attribute'=>'id_ref_barang',
    'value'=>function($data){
        return $data->refBarang->nama_barang;
    }
],'qty',
            [
                'attribute'=>"id_ref_satuan",
                'value'=>function($data){
   return  $data->refSatuan->nama_satuan;
                }  ],
            [
                'attribute'=>'id_ref_suplier',
                'value'=>function($data){
                    return $data->refSuplier->nama_suplier;
                }
            ]
      //      'id',
      //      'id_ref_barang',
     //       'id_ref_satuan',
     //       'qty',
      //      'id_data_agen',
            //'id_ref_suplier',
            //'tgl_pemesanan',

         
        ],
    ]); ?>
        </div>
        <div class="panel-footer">
        <?= yii\bootstrap4\Html::a("Print PDF",['print-list-pesanan','no_acak'=>$no_acak,'export'=>'pdf'],['class'=>'btn btn-warning'])?>
       <?= yii\bootstrap4\Html::a("Print Excel",['print-list-pesanan','no_acak'=>$no_acak,'export'=>'xls'],['class'=>'btn btn-info'])?>
        </div>
    </div>
 

<?php
$role_id = Yii::$app->user->identity->role_id;
if(in_array($role_id, ['2','6'])){
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
