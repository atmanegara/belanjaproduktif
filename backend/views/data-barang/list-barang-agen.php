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
 <h1 class="page-header">Halaman List Daftar Item Barang Di agen Toko</h1>
      <div class="note note-primary m-b-15">
					<div class="note-icon"><i class="fas fa-info"></i></div>
					<div class="note-content">
						<h4><b>Informasi!</b></h4>
						<p>
							Halaman informasi daftar item barang per produk barang
                                               

                                                </p>
					</div>
				</div>
  <!-- begin row -->

<p>
           <?= Html::a('<i class="fa fa-backward"></i> Kembali', ['/data-barang/daftar-barang'], ['class' => 'btn btn-default']) ?>
     
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
      //  'filterModel' => $searchModel,
        'panel'=>[
          'type'=> GridView::TYPE_INFO  
        ],
 
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],   
            [
                'attribute'=>"id_ref_barang",
                'header'=>"Nama Item",
                'value'=>function($data){
                return \backend\models\RefBarang::findOne($data['id_ref_barang'])->nama_barang;
                }
            ]
            ],
   
    ]); ?>


</div>
