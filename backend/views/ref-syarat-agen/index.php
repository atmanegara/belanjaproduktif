<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\RefSyaratAgenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Syarat Agens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-syarat-agen-index">

  
   <p>
        <?= Html::button('Tambah baru',['class' => 'btn btn-success showModalButton',
            'value'=>Url::to( ['create'])]) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'panel'=>[
            'type'=> GridView::TYPE_INFO,
            'heading'=>'Daftar Persyaratan'
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

        //    'id',
            'refAgen.nama_agen',
            [
                'header'=>'Syarat dan Ketentuan Agen',
                'format'=>'raw',
                'value'=>function($data,$key){
        $urlUpdate = \yii\helpers\Url::to(['update','id'=>$key,'syarat'=>'1']);
       $urlDelete = \yii\helpers\Url::to(['delete','id'=>$key,'syarat'=>'1']);
       return $data['syarat_daftar'].'<hr>'.Html::button('<span class="fas fa-pencil-alt" aria-hidden="true"></span>',['class'=>'btn btn-warning showModalButton',
                        'value'=> $urlUpdate]).'|'. Html::a('<span class="fas fa-trash-alt" aria-hidden="true"></span>',$urlDelete,['class'=>'btn btn-danger',
                            'data'=> [
                                'method'=>'POST',
                                'confirm'=>'Apakah anda yakin hapus item ini?'
                          ]]);
                }
            ],
                     [
                'header'=>'Syarat dan Ketentuan Komisi',
                'format'=>'raw',
               'value'=>function($data,$key){
           $urlUpdate = \yii\helpers\Url::to(['update','id'=>$key,'syarat'=>'2']);
     $urlDelete = \yii\helpers\Url::to(['delete','id'=>$key,'syarat'=>'2']);
       return $data['syarat_komisi'].'<hr>'.Html::button('<span class="fas fa-pencil-alt" aria-hidden="true"></span>',['class'=>'btn btn-warning showModalButton',
                        'value'=> $urlUpdate]).'|'. Html::a('<span class="fas fa-trash-alt" aria-hidden="true"></span>',$urlDelete,['class'=>'btn btn-danger',
                            'data'=> [
                                'method'=>'POST',
                                'confirm'=>'Apakah anda yakin hapus item ini?'
                          ]]);
                }
            ],
                      [
                'header'=>'Hak dan Wajib Agen',
                 'format'=>'raw',
               'value'=>function($data,$key){
           $urlUpdate = \yii\helpers\Url::to(['update','id'=>$key,'syarat'=>'3']);
     $urlDelete = \yii\helpers\Url::to(['delete','id'=>$key,'syarat'=>'3']);
       return $data['hak_wajib'].'<hr>'.Html::button('<span class="fas fa-pencil-alt" aria-hidden="true"></span>',['class'=>'btn btn-warning showModalButton',
                        'value'=> $urlUpdate]).'|'. Html::a('<span class="fas fa-trash-alt" aria-hidden="true"></span>',$urlDelete,['class'=>'btn btn-danger',
                            'data'=> [
                                'method'=>'POST',
                                'confirm'=>'Apakah anda yakin hapus item ini?'
                          ]]);
                }
            ],
            
//             ['class' => 'kartik\grid\ActionColumn','width'=>'5%','template'=>'{view} {update} {delete}',
//                'buttons'=>[
//                    'view'=>function($url,$data,$key){
//                        $url = \yii\helpers\Url::to(['view','id'=>$key]);
//                        return Html::button('<span class="fas fa-eye" aria-hidden="true"></span>',['class'=>'btn btn-info showModalButton',
//                            'value'=> $url]);
//                    },
//                       'update'=>function($url,$data,$key){
//                        $url = \yii\helpers\Url::to(['update','id'=>$key]);
//                        return Html::button('<span class="fas fa-pencil-alt" aria-hidden="true"></span>',['class'=>'btn btn-warning showModalButton',
//                            'value'=> $url]);
//                    },
//                            'delete'=>function($url,$data,$key){
//                        $url = \yii\helpers\Url::to(['delete','id'=>$key]);
//                        return Html::a('<span class="fas fa-trash-alt" aria-hidden="true"></span>',$url,['class'=>'btn btn-danger',
//                            'data'=> [
//                                'method'=>'POST',
//                                'confirm'=>'Apakah anda yakin hapus item ini?'
//                            ]]);
//                    },
//                ]],
        ],
    ]); ?>


</div>
