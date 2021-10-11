<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Kurirs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kurir-index">

 
    <p>
        <?= Html::button('<i class="fa fa-plus"></i> Tambah Mitra Kurir',['class' => 'btn btn-success showModalButton',
            'value'=> \yii\helpers\Url::to( ['create'])]) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'panel'=>[
            'type'=> \kartik\grid\GridView::TYPE_INFO,
            'heading'=>'Daftar Mitra Kurir'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

         //   'id',
            'nama_kurir:text:Mitra Kurir',

            ['class' => 'yii\grid\ActionColumn','template'=>'{create} {list} {tarif} {update} {delete} ',
                'buttons'=>[
                     'create'=>function($url,$data,$key){
                        $url = \yii\helpers\Url::to(['/data-kurir/create','id'=>$key]);
                        return Html::button('<span class="fa fa-plus" aria-hidden="true"></span> Anggota Kurir',['class'=>'btn btn-primary showModalButton',
                            'value'=> $url]);
                    },
                      'update'=>function($url,$data,$key){
                        $url = \yii\helpers\Url::to(['update','id'=>$key]);
                        return Html::button('<span class="fas fa-pencil-alt" aria-hidden="true"></span>',['class'=>'btn btn-warning showModalButton',
                            'value'=> $url]);
                    },
                             'tarif'=>function($url,$data,$key){
                        $url = \yii\helpers\Url::to(['/tarif-kurir/index','id'=>$key]);
                        return Html::a('<span class="fas fa-pencil-alt" aria-hidden="true"></span> Daftar Tarif',$url,
                                ['class'=>'btn btn-success ']);
                    },
                             'delete'=>function($url,$data,$key){
                        $url = \yii\helpers\Url::to(['delete','id'=>$key]);
                        return Html::a('<span class="fas fa-trash-alt" aria-hidden="true"></span>',$url,['class'=>'btn btn-danger',
                            'data'=> [
                                'method'=>'POST',
                                'confirm'=>'Apakah anda yakin hapus item ini?'
                            ]]);
                    },
                            'list'=>function($url,$data,$key){
                        $url = \yii\helpers\Url::to(['/data-kurir/index-id-kurir','id'=>$key]);
                        return Html::a('<span class="fas fa-list" aria-hidden="true"></span> Daftar Anggota ',$url,['class'=>'btn btn-info']);
                    },
                ]],
        ],
    ]); ?>


</div>
