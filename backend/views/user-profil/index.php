<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Profils';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profil-index">

  
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
//            ['class' => 'kartik\grid\SerialColumn'],

            'nama_lengkap',
            'username',
            'password_string',

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
