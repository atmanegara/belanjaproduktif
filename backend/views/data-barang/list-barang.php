<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use backend\models\StokBarang;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataBarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Barangs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-barang-index">
 <h1 class="page-header">Halaman List Daftar Item Barang</h1>
<p>
           <?= Html::a('<i class="fa fa-backward"></i> Kembali', ['/data-barang/daftar-barang'], ['class' => 'btn btn-default']) ?>
     
    </p>
    <div class="note note-primary m-b-15">
					<div class="note-icon"><i class="fas fa-info"></i></div>
					<div class="note-content">
						<h4><b>Informasi!</b></h4>
						<p>
							Halaman informasi daftar item barang per produk barang
                                                <ol type="1">
                                                    <li>Jika Ingin Menambah Produk Barang Baru / Item Produk,Hubungi Pihak admin BP</li>
                                                    <li>Jika ada pesanan online produk keluar, klik list [Item], > stok barang</li>
                                                </ol>

                                                </p>
					</div>
				</div>
  <!-- begin row -->



    <p>
 <?= Html::a('Jumlah Item STOK HABIS [ '.$stokBarang['totalitem'].' ]', ['list-barang','stok'=>'0'], [
     'class'=>'btn btn-danger'
 ]) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel'=>[
          'type'=> GridView::TYPE_INFO  
        ],
 
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
//
         //   'id',
            ['attribute'=>'kode_barcode','width'=>'10%'
               ],
//                     [
//                         
//                       'attribute'=>  'barkode','width'=>'1%'
//                         ],
                [
                    'attribute'=>'filename',
                    'format'=>'raw',
                    'value'=>function($data){
                        $filename_path = Yii::getAlias('@sourcePathImg/').$data['filename'];
                        return Html::img($filename_path,['width'=>'90px','height'=>'90px']);
                    }
                ],
            'item_barang',
            ['attribute'=>'id_ref_satuan_barang',
                'value'=>function($data){
                return $data->refSatuanBarang->nama_satuan;
                }],
             [
                 'header'=>'Stok Terakhir',
                 'value'=>function($data){
                 $dataStokBarang=StokBarang::find()->where([
                     'id_data_agen'=>$data['id_data_agen'],
                     'id_data_barang'=>$data['id']])->one();
                 return $dataStokBarang['stok_sisa'];
                 }
             ],
                 [
                     'header'=>"Harga Jual",
                     'value'=>function($data){
                  $dataStokBarang=StokBarang::find()->where([
                     'id_data_agen'=>$data['id_data_agen'],
                     'id_data_barang'=>$data['id']])->one();
                 return number_format($dataStokBarang['harga_jual'],0,',','.');
                     }
                 ],
            ['class' => 'kartik\grid\ActionColumn','width'=>'25%',
                'template'=>'{view} {update} {qty}',
                'buttons'=>
                [
                    'view'=>function($url,$data){
                           return Html::a("<i class='fa fa-list'></i> ITEM ", Url::to(['/transaksi-barang/list-transaksi-barang',
                            'id_data_barang'=>$data['id'],'id_data_agen'=>$data['id_data_agen']]),['class'=>"btn btn-md btn-info"]);
                    },
               
                     'update'=>function($url,$data){
                     return Html::button('Hapus',['class'=>'btn btn-md btn-danger showModalButton',
                         'value'=>Url::to(['data-barang/update-status-barang','id'=>$data['id']])
                     ]);
                     },
                     
                        'qty'=>function($url,$data){
                     return Html::button('UBAH STOK',['class'=>'btn btn-md btn-warning showModalButton',
                         'value'=>Url::to(['data-barang/update-qty','id'=>$data['id']])
                     ]);
                     }
                     ]                
            ],
        ],
    ]); ?>


</div>
