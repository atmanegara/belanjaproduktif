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
        <?= Html::button('Buat Pesanan Baru', ['class' => 'btn btn-success showModalButton',
            'value'=>yii\helpers\Url::to(['create'])
             ]) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel'=>[
            'type'=> \kartik\grid\GridView::TYPE_INFO,
            'heading'=>'Daftar Pencatatan Barang '
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn','width'=>'1%'],

          //  'id',
             ['attribute'=> 'jumlah','width'=>'2%'] ,
             ['attribute'=> 'no_acak','width'=>'2%'] ,
              ['attribute'=> 'tgl_pemesanan','width'=>'5%'] ,
                ['attribute'=> 'id_data_agen','width'=>'5%','value'=>'dataAgen.nama_agen'] ,
            //'id_ref_suplier',
            //'tgl_pemesanan',

            ['class' => 'kartik\grid\ActionColumn','template'=>'{detail} {view}','width'=>"10%",
                'buttons'=>[
                    'detail'=>function($url,$data){
        $no_acak = $data['no_acak'];
        return  Html::button('List Barang Pesanan',['class'=>'btn btn-warning showModalButton','value'=> yii\helpers\Url::to(['list-pesanan-barang-agen','no_acak'=>$no_acak])]);
                    },
                    'view'=>function($url,$data){
                        $dataCatatanAgen = backend\models\CatatanBarangAgen::find()->where(['no_acak'=>$data['no_acak']])->one();
                        if($dataCatatanAgen['diterima']=='Y'){
                         return "<span class='label label-success'>Barang sudah diterima Toko Agen</span>";   
                        }else{
        return yii\bootstrap4\Html::a('Tambah Barang / Item',['/catatan-barang/entry-data','no_acak'=>$data['no_acak']], ['class'=>"btn btn-primary"]);
                        }
                    }
                ]
                ],
        ],
    ]); ?>
    

</div>
