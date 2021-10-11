<?php

use yii\helpers\Html;
use kartik\grid\GridView;;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Kurirs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-kurir-index">

    <p>
            <?= Html::a('<i class="fa fa-backward"></i> Kembali', ['/ref-kurir/index'], ['class' => 'btn btn-default']) ?>
     
    </p>
    <?= GridView::widget([
        'panel'=>[
            'type'=> GridView::TYPE_INFO,
            'heading'=>'Daftar Anggota Kurir'
        ],
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

     //       'id',
           [
               'attribute'=> 'id_ref_kurir',
               'value'=>function($data){
                return \backend\models\RefKurir::findOne($data['id_ref_kurir'])->nama_kurir;
               }
           ],
            'nik',
            'nama_kurir',
            'telp_kurir',

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
