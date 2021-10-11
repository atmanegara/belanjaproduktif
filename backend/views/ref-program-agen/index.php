<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RefProgramAgenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Halaman Program';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-program-agen-index">

  <div class="note note-primary m-b-15">
					<div class="note-icon"><i class="fas fa-info"></i></div>
					<div class="note-content">
						<h4><b>Informasi!</b></h4>
						<p>
							Halaman ini untuk daftar pilihan Program pada Agen
                                                </p>
					</div>
				</div>  <p>
        <?= Html::button('Tambah baru', ['class' => 'btn btn-success showModalButton',
            'value'=> yii\helpers\Url::to(['create'])
            ]) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'panel'=>[
            'type'=> \kartik\grid\GridView::TYPE_INFO,
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn','width'=>"2%"],

       //     'id',
           ['attribute'=>  'nama_program','width'=>"15%"],
           ['attribute'=>  'biaya','width'=>"5%",'format'=>'decimal'],

            ['class' => 'kartik\grid\ActionColumn','width'=>'15%','template'=>'{view} {update} {delete}',
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
