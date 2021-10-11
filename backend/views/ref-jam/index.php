<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\RefJamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Jams';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jam-index">

 <div class="note note-primary m-b-15">
					<div class="note-icon"><i class="fas fa-info"></i></div>
					<div class="note-content">
						<h4><b>Informasi!</b></h4>
						<p>
							Halaman ini untuk daftar jam pengiriman barang
                                                </p>
					</div>
				</div>
   <p>
        <?= Html::button('Tambah baru',['class' => 'btn btn-success showModalButton',
            'value'=>Url::to( ['create'])]) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel'=>[
          'type'=> GridView::TYPE_INFO,
            'heading'=>''
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn','width'=>'5%'],

          //  'id',
           ['attribute'=> 'jam','width'=>'15%'] ,
            ['attribute'=> 'aktif','width'=>'3%'] ,

            ['class' => 'kartik\grid\ActionColumn','width'=>'12%','template'=>'{view} {update} {delete}',
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
