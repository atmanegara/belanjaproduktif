<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\BeritaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Beritas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="berita-index">

    <p>
    <h3>Halaman </h3>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

       //     'id',
            'title',
            'isi:ntext',

            ['class' => 'kartik\grid\ActionColumn','template'=>'{delete} {update}','width'=>'30%',
               'buttons'=>[
                   'update'=>function($url,$data,$key){
        return Html::button('<span class="fa fa-edit" aria-hidden="true"></span>', ['class' => 'btn btn-warning showModalButton',
            'value'=>Url::to( ['update','id'=>$key])
        ]);
                   },
                                  'delete'=>function($url,$data,$key){
        return Html::a('<span class="fa fa-trash" aria-hidden="true"></span>',Url::to( ['delete','id'=>$key]), ['class' => 'btn btn-danger btn-md',
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
