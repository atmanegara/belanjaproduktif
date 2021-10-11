<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TarifKurirSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tarif Kurirs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tarif-kurir-index">

  <div class="note note-primary m-b-15">
								<div class="note-icon"><i class="fa fa-money-bill-wave"></i></div>
								<div class="note-content">
									<h4><b>Perhatian!</b></h4>
									<p>
										Ini daftar list tarif berdasarkan hari dan jam kurir									</p>
								</div>
							</div>

   <p>
           <?= Html::a('<i class="fa fa-backward"></i> Kembali', ['/ref-kurir'], ['class' => 'btn btn-default']) ?>
     
         <?= Html::button('Tambah Tarif Baru',['class' => 'btn btn-success showModalButton',
            'value'=>Url::to( ['create','id_ref_kurir'=>$id_ref_kurir])]) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'panel'=>[
            'heading'=>'Daftar Tarif Kurir',
            'type'=> kartik\grid\GridView::TYPE_INFO
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

        //    'id',
         //   'id_ref_kurir',
            [
                'header'=>'Kurir',
                'value'=>function($data){
                    return \backend\models\RefKurir::findOne($data['id_ref_kurir'])->nama_kurir;
                }
            ],
              [
                'header'=>'hari',
                'value'=>function($data){
                    return Yii::$app->setting->hari($data['hari']);
                }
            ],
            'jam_awal',
            'jam_akhir',
            //'tarif',

              ['class' => 'kartik\grid\ActionColumn','width'=>'50%','template'=>'{update} {delete}',
                'buttons'=>[
                  
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
