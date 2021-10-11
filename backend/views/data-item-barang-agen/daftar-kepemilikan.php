<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataItemBarangAgenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Item Barang Agens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-item-barang-agen-index">



    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'panel'=>[
            'heading'=>"Daftar Item",
            'type'=> GridView::TYPE_INFO
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
         'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

     //       'id',
        ['attribute'=>'item_barang'],
        ['header'=>'Agen',
            'format'=>'raw',
            'value'=>function($data){
        return $data['id_agen'] ? $data['id_agen'].' / '.$data['nama_agen'] : 'Tidak ada Pemilik Item';
            }
            ],
             
          

         //   ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>


</div>
