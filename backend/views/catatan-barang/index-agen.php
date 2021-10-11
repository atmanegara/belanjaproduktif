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

   
<div class="note note-primary m-b-15">
								<div class="note-icon"><i class="fa fa-info"></i></div>
								<div class="note-content">
									<h4><b>INFORMASI !</b></h4>
									<p>
Pastikan Data Toko anda sudah di input
									</p>
								</div>
							</div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'panel'=>[
            'header'=>'Daftar Catatan',
            'type'=> kartik\grid\GridView::TYPE_INFO
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
'no_acak',
//            'id',
//            'id_ref_barang',
//            'id_ref_satuan',
//            'qty',
//            'id_data_agen',
            //'id_ref_suplier',
            'tgl_pemesanan',
            [
                'format'=>'raw',
                'header'=>'Status Diterima',
                'value'=>function($data){
        $no_acak = $data['no_acak'];
        $dterima = backend\models\CatatanBarangAgen::getStatusTerimaBarang($no_acak);
                return $dterima=='Y' ? "<span class='label label-success'>Selesai / Diterima</span>" : "<span class='label label-warning'>Belum di terima</span>";
                }
            ],
            ['class' => 'kartik\grid\ActionColumn','template'=>'{view}',
                'buttons'=>[
                    'view'=>function($url,$data){
        return yii\bootstrap4\Html::a('View',['list-barang-agen','no_acak'=>$data['no_acak']], ['class'=>"btn btn-warning"]);
                    }
                ]
                ],
        ],
    ]); ?>


</div>
