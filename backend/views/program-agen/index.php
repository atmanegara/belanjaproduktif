<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProgramAgenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Program Agen';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-agen-index">

      <div class="note note-warning note-with-right-icon m-b-15">
					<div class="note-icon"><i class="fa fa-caret-right"></i></div>
					<div class="note-content text-left">
						<h4><b>Daftar Program</b></h4>
						<p>
							Informasi program agen
						</p>
					</div>
				</div>
   
    <p>
    <?php 
 //   if(!$dataProvider->getModels()){
        echo Html::button('Tambah Baru',['class'=>"btn btn-primary btn-md showModalButton",
            'value'=> Url::to(['create'])]);
   // }
    ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    //    'filterModel' => $searchModel,
        'panel'=>[
            'type'=> \kartik\grid\GridView::TYPE_INFO,
            'heading'=>'Daftar Agen di Program'
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn','width'=>'1%'],

           // 'id',
          //  'id_data_agen',
            //'no_acak',
          
 ['attribute'=>  'nama_program','width'=>'15%'] ,
             ['attribute'=>  'bykagen','width'=>'5%'],
//            'tahun',

            ['class' => 'kartik\grid\ActionColumn','width'=>"15%",
                'contentOptions'=>['class'=>'with-btn'],
                'template'=>'{detail}',
                'buttons'=>[
                    'detail'=>function($url,$data,$key){
        $url = Url::to(['detail','id_ref_program_agen'=>$key]);
                            return Html::a('Detail', $url, ['class'=>'btn btn-primary btn-md']);
                    }
                ]],
        ],
    ]); ?>


</div>
