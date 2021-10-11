<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataFaqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Faqs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-faq-index">

   
    <p>
        <?= Html::button('Buat FAQ Baru',['class' => 'btn btn-success showModalButton',
            'value'=> \yii\helpers\Url::to( ['create'])
            ]) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'panel'=>[
            'type'=> kartik\grid\GridView::TYPE_INFO,
            'heading'=>'Daftar FAQ'
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn','width'=>'1%'],

         //   'id',
      ['attribute'=>'pertanyaan','width'=>'5%'],
      ['attribute'=>'jawaban','width'=>'5%'],
       //     'aktif',

        ['class' => 'kartik\grid\ActionColumn','width'=>'10%','template'=>'{view} {update} {delete}',
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
                ]],        ],
    ]); ?>


</div>
