<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\FranchiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title =false;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="franchice-index">

   <p>
        <?= Html::button('Tambah baru',['class' => 'btn btn-success showModalButton',
            'value'=>Url::to( ['create'])]) ?>
    </p>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'panel'=>[
            'type'=>'info',
            'heading'=>'Daftar Franchice Agen'
        ],
  //      'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

       //     'id',
    //        'id_ref_agen',
            
            [
              'attribute'=>"id_ref_agen",
                'value'=>function($data){
                    return backend\models\RefAgen::findOne($data['id_ref_agen'])->nama_agen;
                }
            ],
           [
             'attribute'=>'nominal',
               'format'=>'decimal'
           ],
         
 [
             'attribute'=>'diskon',
               'format'=>'decimal'
           ],
                    [
             'attribute'=>'total',
               'format'=>'decimal'
           ],
             ['class' => 'kartik\grid\ActionColumn','width'=>'35%','template'=>'{view} {update} {delete}',
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
