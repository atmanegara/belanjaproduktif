<?php
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\bootstrap4\Html;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?=
GridView::widget([
    'dataProvider'=>$dataProvider,
    'columns'=>[
        'nama_agen',
    [
            'class'=> '\kartik\grid\ActionColumn',
            'template'=>'{list-penjualan}',
            'buttons'=>[
                'list-penjualan'=>function($url,$data,$key){
    $url = Url::to(['lap-penjualan-agen','id_data_agen'=>$key]);
                    return Html::a('List Penjualan Agen', $url,['class'=>'btn btn-md btn-warning']);
                }
            ]
        ]
    ]
])
?>

