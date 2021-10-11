<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProgramAgenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Program';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-agen-index">

   
      <div class="note note-warning note-with-right-icon m-b-15">
					<div class="note-icon"><i class="fa fa-info"></i></div>
					<div class="note-content text-left">
						<h4><b>Daftar Program</b></h4>
						<p>
							Informasi program agen
						</p>
					</div>
				</div>
 
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
     'panel'=>[
            'type'=> \kartik\grid\GridView::TYPE_INFO,
            'heading'=>'Daftar Agen di Program'
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn','width'=>'1%'],

           // 'id',
          //  'id_data_agen',
            //'no_acak',
            ['attribute'=>  'id_ref_program_agen',
                'value'=>'refProgramAgen.nama_program',
                'width'=>'15%'] ,
      //    ['attribute'=>     'tahun','width'=>'15%'] ,

           
            ['class' => 'kartik\grid\ActionColumn','width'=>'5%','template'=>'{delete}',
                'buttons'=>[
//                    'view'=>function($url,$data,$key){
//                        $url = \yii\helpers\Url::to(['view','id'=>$key]);
//                        return Html::button('<span class="fas fa-eye" aria-hidden="true"></span>',['class'=>'btn btn-info showModalButton',
//                            'value'=> $url]);
//                    },
//                       'update'=>function($url,$data,$key){
//                        $url = \yii\helpers\Url::to(['update','id'=>$key]);
//                        return Html::button('<span class="fas fa-pencil-alt" aria-hidden="true"></span>',['class'=>'btn btn-warning showModalButton',
//                            'value'=> $url]);
//                    },
                            'delete'=>function($url,$data,$key){
                        $url = '#'; //\yii\helpers\Url::to(['delete','id'=>$key]);
                        return Html::a('<span class="fas fa-eye" aria-hidden="true"></span>',$url,['class'=>'btn btn-warning',
                            'data'=> [
                                'method'=>'POST',
                                'confirm'=>'Masih Tahap pengembangan'
                            ]]);
                    },
                ]],
        ],
    ]); ?>


</div>
