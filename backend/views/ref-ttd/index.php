<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Ttds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-ttd-index">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'panel'=>[
            'type'=> kartik\grid\GridView::TYPE_INFO,
            'heading'=>'Daftar Tanda Tangan'
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

        //    'id',
            [
              'header'=>"Jenis Laporan",
                'value'=>function($data){
                return \backend\models\Laporan::findOne($data['id_laporan'])->jns_laporan;
                }
            ],
        //    'id_laporan',
            'no_induk',
            'nama',

            ['class' => 'kartik\grid\ActionColumn','template'=>'{update}',
                'buttons'=>[
                         'update'=>function($url,$data,$key){
                        $url = \yii\helpers\Url::to(['update','id'=>$key]);
                        return Html::button('<span class="fas fa-pencil-alt" aria-hidden="true"></span>',['class'=>'btn btn-warning showModalButton',
                            'value'=> $url]);
                    },
                ]
                ],
        ],
    ]); ?>


</div>
