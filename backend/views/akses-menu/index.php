<?php

use kartik\grid\GridView;
use yii\bootstrap4\Html;
use yii\helpers\Url;

?>

<?=
GridView::widget([
    'dataProvider'=>$dataProvider,
    'columns'=>[
//        'label1','label2','label3',
        [
          'header'=>'Menu',
            'format'=>'raw',
            'value'=>function($data){
                if($data['label1']){
                    $menu = "<span class='label label-info'>".$data['label1']."</span>";
                }
                if($data['label2']){
                    $menu .=" / ". "<span class='label label-warning'>".$data['label2']."</span>";
                    
                }
                                if($data['label3']){
                    $menu .=" / ". "<span class='label label-success'>".$data['label3']."</span>";
                    
                }
                
                return $menu;
            }
        ],
        'id1','id2','id3',
        [
            'class'=> '\kartik\grid\ActionColumn','template'=>'{tambah}',
            'buttons'=>[
                'tambah'=>function($url,$data){
                    $url = ['tambah','id1'=>$data['id1'],'id3'=>$data['id2'],'id3'=>$data['id3']];
                    return Html::a('Tambah Akses Menu', $url,['class'=>'btn btn-primary']);
                }
            ]
        ]
    ]
])
?>