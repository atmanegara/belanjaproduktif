<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CatatanBarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Catatan Barangs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catatan-barang-index">
    <div class="row row-space-10">
        <div class="col-md-12">
          <div class="panel panel-primary">
        <div class="panel-body">
            <?php
            $id_data_agen =$query['id_data_agen'];
                $no_acak =$query['no_acak'];
           $tgl_pemesanan = $query['tgl_pemesanan'];

            echo DetailView::widget([
                'model'=>$query,
                'attributes'=>[
                    'no_acak',
                    [
                      'attribute'=>'id_data_agen',
                        'value'=>function($data){
                return $data->dataAgen->nama_agen;
                        }
                    ],'tgl_pemesanan'
                ]
            ]) ?>
        </div>
    </div>  
        </div>
    
        
    </div>
   
    <div class="row row-space-12">
        <div class="col-md-6">
           
             <?= GridView::widget([
                 'pjax'=>true,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
                 'toolbar'=>false,'responsive'=>true,

            'hover' => true,
        'panel'=>[
            'heading'=>'List Item',
            'type'=> GridView::TYPE_INFO,
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn','width'=>'1%'],

          //  'id',
           ['attribute'=>'nama_barang','width'=>'10%'],
          

            ['class' => 'kartik\grid\ActionColumn','width'=>'10%','template'=>"{additem}",
                'buttons'=>[
                    'additem'=>function($url,$data,$key)use($no_acak){
        $url = yii\helpers\Url::to(['add-items','id'=>$key,'no_acak'=>$no_acak]);
                        return Html::button("<i class='fa fa-plus'></i> Item" ,['class'=>'btn btn-primary showModalButton','value'=>$url]);
                    }
                ]
                ],
        ],
    ]); ?>

 
   
        </div>
        <div class="col-md-6">
            <?= $this->render('list-pesanan-barang',[
                'no_acak'=>$no_acak,
                'dataProvider'=>$dataProviderListPesanan
            ]) ?>
        </div>
    </div>
    
</div>
