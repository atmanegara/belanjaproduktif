<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\RefSuplierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Supliers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-suplier-index">

  
  <p>
        <?= Html::button('Tambah baru',['class' => 'btn btn-success showModalButton',
            'value'=>Url::to( ['create'])]) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'panel'=>[
            'heading'=>'Daftar Supplier',
            'type'=>'info'
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

      //      'id',
            'nama_suplier',
            'alamat',
            'no_telp',

     ['class' => 'kartik\grid\ActionColumn','template'=>'{delete} {update}','width'=>'30%',
               'buttons'=>[
                   'update'=>function($url,$data,$key){
        return Html::button('<span class="fa fa-edit" aria-hidden="true"></span>', ['class' => 'btn btn-warning showModalButton',
            'value'=>Url::to( ['update','id'=>$key])
        ]);
                   },
                                  'delete'=>function($url,$data,$key){
        return Html::a('<span class="fa fa-trash" aria-hidden="true"></span>',Url::to( ['/akreditasi/dtl-reputasi-peserta-didik/delete','id'=>$key]), ['class' => 'btn btn-danger btn-md',
            'data'=>[
                'confirm'=>'Anda Yakin Hapus item ini?',
                'method'=>'post'
            ]]);
                   }
               ] 
               
            ],

        ],
    ]); ?>


</div>
