<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TransaksiBarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transaksi Barangs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaksi-barang-index">

<div class="note note-primary">
  <div class="note-icon"><i class="fa fa-info-circle"></i></div>
  <div class="note-content">
    <h4><b>Informasi!</b></h4>
    <p> Halaman ini berisi daftar Transaksi Barang terjual</p>
  </div>
</div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'panel'=>[
          'heading'=>'Daftar Transaksi Penjualan Item',
            'type'=> GridView::TYPE_INFO
        ],
        'dataProvider' => $dataProvider,
     //   'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

       'no_invoice',
              [
              'header'=>'Tanggal Transaksi',
                  'value'=>function($data){
        return $data['tgl_transaksi'];
                  }
                  ],
          [
              'header'=>'Agen',
          //    'attribute'=>'id_data_agen',
              'value'=>function($data){
           $dataAgen='';
              $modelDataAgen = \backend\models\DataAgen::find()->where(['id'=>$data['id_data_agen']]);
              if($modelDataAgen->exists()){
                $dataAgen= $modelDataAgen->one();
                $dataAgen = $dataAgen['id_agen'].' - '. $dataAgen['nama_agen'];
            }
            return $dataAgen;
              }
          ],
                  [
                     // 'attribute'=>"id_data_barang",
                      'value'=>function($data){
                      $dataModelBarang= backend\models\DataBarang::find()->where(['id'=>$data['id_data_barang']]);
                     $nmBarang='';
                      if($dataModelBarang->exists()){
                          $dataBarang = $dataModelBarang->one();
                          $nmBarang = $dataBarang['item_barang'];
                      }
                      return $nmBarang;
                      }
                  ],
      //      'id_data_barang',
          [
                              'header'=>"Qty",
                              'value'=>function($data){
                              return $data['qty'];
                              }
                          ],
                                  [
                              'header'=>"harga_satuan",
                              'value'=>function($data){
                              return $data['harga_satuan'];
                              }
                          ],
                          [
                              'header'=>"Total",
                              'value'=>function($data){
                              return $data['qty']*$data['harga_satuan'];
                              }
                          ],
//'keterangan',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
