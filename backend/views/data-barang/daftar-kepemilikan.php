<?php

use kartik\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap4\Html;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataBarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Barangs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-barang-index">

  <!-- begin row -->

<!-- end row -->
<!-- begin row -->


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel'=>[
            'heading'=>'Daftar Item di Agen',
            'type'=> kartik\grid\GridView::TYPE_INFO
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

       //     'id',
            'bykagen',
            'item_barang',
          //  'id_ref_satuan_barang',

            ['class' => 'kartik\grid\ActionColumn','template'=>'{list}',
                'buttons'=>[
                    'list'=>function($url,$data){
                    $url = Url::to(['list-item-agen','id_ref_barang'=>$data['id_ref_barang']]);
                    return Html::button("<i class='fa fa-list'></i> Agen",[
                        'class'=>'btn btn-md btn-info showModalButton',
                        'value'=>$url
                    ]);
                    }
              
            ]],
        ],
    ]); ?>


</div>
