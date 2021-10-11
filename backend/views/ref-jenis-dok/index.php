<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RefJenisDokSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Jenis Doks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-dok-index">

    <h1 class="page-header">Halaman Ref. Jenis Dokumen</h1>
      <div class="note note-primary m-b-15">
					<div class="note-icon"><i class="fas fa-info"></i></div>
					<div class="note-content">
						<h4><b>Informasi!</b></h4>
						<p>
							Halaman ini untuk daftar jenis dokumen prasyarat menjadi anggota,
                                                </p>
					</div>
				</div>

                 <p>
        <?= Html::button('Tambah Jenis Dokumen',['class' => 'btn btn-success showModalButton',
            'value'=> \yii\helpers\Url::to(['create'])
            ]) ?>
    </p>

          
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
          'bordered' => true,
    'striped' => false,
    'condensed' => false,
    'responsive' => true,
    'hover' => true,
  'panel'=>[
          'type'=> GridView::TYPE_PRIMARY,
            'heading'=>'Jenis Dokumen Agen'
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn','width'=>'1%'],

      //      'id',
        //    'id_ref_agen',
            [
                
              'attribute'=>'id_ref_agen',
                'value'=>function($data){
                    return $data->refAgen->nama_agen;
                },'width'=>'2%'
            ],
            [
                
              'attribute'=>'nama_dok',
               'width'=>'10%'
            ],

             ['class' => 'kartik\grid\ActionColumn','width'=>'5%','template'=>'{view} {update} {delete}',
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
