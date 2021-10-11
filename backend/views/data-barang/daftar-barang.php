<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataBarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Barangs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-barang-index">
 <h1 class="page-header">Halaman Daftar Barang</h1>
      <div class="note note-primary m-b-15">
					<div class="note-icon"><i class="fas fa-info"></i></div>
					<div class="note-content">
						<h4><b>Informasi!</b></h4>
						<p>
							Halaman informasi daftar item barang per agen promo
                                                </p>
					</div>
				</div>
  <!-- begin row -->
<div class="row">
	<!-- begin col-3 -->
<!--	<div class="col-lg-3 col-md-6">
		<div class="widget widget-stats bg-red">
			<div class="stats-icon"><i class="fa fa-desktop"></i></div>
			<div class="stats-info">
				<h4>TOTAL ITEM BARANG</h4>
				<p>3,291,922</p>	
			</div>
			<div class="stats-link">
				<a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>-->
	<!-- end col-3 -->
	<!-- begin col-3 -->

	<!-- end col-3 -->
	
	
</div>
<!-- end row -->
<!-- begin row -->


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'panel'=>[
            'type'=> \kartik\grid\GridView::TYPE_INFO
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_agen',
            
            'nik',
            'nama_agen',
          
            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {add}',
                'buttons'=>[
                    'view'=>function($url,$data){
                            return \yii\bootstrap4\Html::a('Daftar Barang / Item',Url::to([
                                'list-barang','id_data_agen'=>$data['id']
                            ]),['class'=>"btn btn-md btn-warning"]);
                    }
                ]
            ],
        ],
    ]); ?>


</div>
