<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Banks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-bank-index">

  <h1 class="page-header">Halaman Ref. Bank</h1>
      <div class="note note-primary m-b-15">
					<div class="note-icon"><i class="fas fa-info"></i></div>
					<div class="note-content">
						<h4><b>Informasi!</b></h4>
						<p>
							Halaman ini untuk daftar pilihan bank (untuk pilihan bank saat konfirmasi pembayaran)
                                                </p>
					</div>
				</div>

    <p>
        <?= Html::button('Create Ref Bank', ['class' => 'btn btn-success showModalButton',
            'value'=> yii\helpers\Url::to(['create'])
            ]) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'panel'=>[
          'type'=> GridView::TYPE_INFO  
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn','width'=>'1%'],

    //        'id',
          ['attribute'=>'nm_bank','width'=>'10%'],

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
