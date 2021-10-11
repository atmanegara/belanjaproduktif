<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TransaksiBarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transaksi Barangs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaksi-barang-index">

 <h1 class="page-header">Halaman List Item Transaksi Pada Produk ID <?= 'Barcode :: '. $dataBarang['barkode'] ?></h1>
      <div class="note note-primary m-b-15">
					<div class="note-icon"><i class="fas fa-info"></i></div>
					<div class="note-content">
						<h4><b>Informasi!</b></h4>
						<p>
							Halaman informasi daftar transaksi item barang per produk barang
                                               

                                                </p>
					</div>
				</div>
    <p>
        <?php 
echo Html::a('Input Stok Keluar (Manual)', ['update','id_data_barang'=>$id_data_barang,'id_data_agen'=>$id_data_agen], ['class' => 'btn btn-success'])
   
// echo Html::a('Tambah Baru (Via Scanner Barcode', ['#transaksi-barang/create','id_data_barang'=>$id_data_barang,'id_data_agen'=>$id_data_agen], ['class' => 'btn btn-success']) ?>
        <?php
//        echo Html::button('Tambah Baru', ['class' => 'btn btn-warning showModalButton',
//            'value'=>Url::to(['create','id_data_barang'=>$id_data_barang,'id_data_agen'=>$id_data_agen])
//        ]) 
                ?>
    </p>

<div class="widget-list-item">
				<div class="widget-list-media">
				<?php 
				$filename_path = Yii::getAlias('@sourcePathImg/').$dataBarang['filename_barang'];
				echo \yii\bootstrap4\Html::img($filename_path,['width'=>'90px','height'=>'90px','class'=>'rounded']);
				?>
	
				</div>
				<div class="widget-list-content">
					<h4 class="widget-list-title"><?php echo $dataBarang['item_barang']?></h4>
					<p class="widget-list-desc">-</p>
				</div>
				
			</div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
   //     'filterModel' => $searchModel,
        'panel'=>[
          'type'=> GridView::TYPE_INFO  
        ],
       
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn','width'=>'1%'],

       //     'id',
          ['attribute'=>'tgl_transaksi','width'=>'6%'],
         //   'id_data_agen',
           // 'id_data_barang',
          ['attribute'=>'qty','width'=>'5%'],
          ['attribute'=>'harga_satuan','width'=>'5%'],
             ['attribute'=>'harga_jual','width'=>'5%'],
               ['attribute'=>'keterangan','width'=>'5%'],
 
      //      ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
