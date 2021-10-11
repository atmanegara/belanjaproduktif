<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RefAgenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Agens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-agen-index">

    <h1 class="page-header">Halaman Ref Agen</h1>

                 <p>
        <?= Html::button('Create Ref Agen',['class' => 'btn btn-success showModalButton',
            'value'=> \yii\helpers\Url::to(['create'])
            ]) ?>
    </p>

   <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
     //   'filterModel' => $searchModel,
        'panel'=>[
          'type'=> GridView::TYPE_PRIMARY,
            'heading'=>'     DAFTAR AGEN'
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn','width'=>'1%'],

      //      'id',
            ['attribute'=>'kd_agen','width'=>'3%'],
            ['attribute'=>'nama_agen','width'=>'3%'],
      //      'id_ref_syarat_agen',

            ['class' => 'kartik\grid\ActionColumn','width'=>'5%','template'=>'{view} {update} {delete}',
                'buttons'=>[
                    'view'=>function($url,$data,$key){
                        $url = \yii\helpers\Url::to(['view','id'=>$key]);
                        return Html::button('<span class="fas fa-eye" aria-hidden="true"></span>',['class'=>'btn btn-info showModalButton',
                            'value'=> $url]);
                    },
                       'update'=>function($url,$data,$key){
                        $url = \yii\helpers\Url::to(['update','id'=>$key]);
                        return Html::button('<span class="fas fa-pencil-alt" aria-hidden="true"></span>',['class'=>'btn btn-warning showModalButton',
                            'value'=> $url]);
                    },
                            'delete'=>function($url,$data,$key){
                        $url = \yii\helpers\Url::to(['delete','id'=>$key]);
                        return Html::a('<span class="fas fa-trash-alt" aria-hidden="true"></span>',$url,['class'=>'btn btn-danger',
                            'data'=> [
                                'method'=>'POST',
                                'confirm'=>'Apakah anda yakin hapus item ini?'
                            ]]);
                    },
                ]],
        ],
    ]); ?>
   
    

   

  


</div>
