<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\PersetujuanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Persetujuan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="persetujuan-index">


    <div class="panel panel-primary">
        <div class="panel-heading">
            Daftar Teks Persetujuan
        </div>
        <div class="panel-body">
               <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

           [
               'attribute'=>"persetujuan",
               'format'=>'raw'
           ],

            ['class' => 'kartik\grid\ActionColumn','template'=>'{update}',
                      'buttons'=>[
                   'update'=>function($url,$data,$key){
        return Html::button('<span class="fa fa-edit" aria-hidden="true"></span>', ['class' => 'btn btn-warning showModalButton',
            'value'=>Url::to( ['update','id'=>$key])
        ]);
                   },
                           ]
                           ],
        ],
    ]); ?>

        </div>
    </div>

 

</div>
