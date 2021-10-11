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
        <?= Html::button('Buat Catatan', ['class' => 'btn btn-success showModalButton',
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
            ['class' => 'kartik\grid\SerialColumn','width'=>'3%'],

          //  'id',
             ['attribute'=> 'id_ref_barang','width'=>'5%',
                 'value'=>'refBarang.nama_barang'] ,
             ['attribute'=> 'id_ref_satuan','width'=>'5%','value'=>'refSatuan.nama_satuan'] ,
              ['attribute'=> 'qty','width'=>'5%'] ,
                ['attribute'=> 'id_data_agen','width'=>'15%','value'=>'dataAgen.nama_agen'] ,
            //'id_ref_suplier',
            //'tgl_pemesanan',

            ['class' => 'kartik\grid\ActionColumn','template'=>'{view}','width'=>"10%",
                'buttons'=>[
                    'view'=>function($url,$data){
        return yii\bootstrap4\Html::a('View',['/catatan-barang/entry-data','no_acak'=>$data['no_acak']], ['class'=>"btn btn-warning"]);
                    }
                ]
                ],
        ],
    ]); ?>


</div>
