<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProgramAgenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Program Agens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-agen-index">

  
    <p>
    <?php
    $id_role = Yii::$app->user->identity->role_id;
    if(in_array($id_role, ['1'])){
        $url = Url::to(['create']);
        echo Html::button('Tambah Program Agen Baru',['class'=>'btn btn-primary btn-md showModalButton','value'=>$url]);
    }
    ?>
    </p>
    <?= GridView::widget([
        'panel'=>[
          'type'=>GridView::TYPE_INFO  ,
            'heading'=>'Entry Data'
        ],
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn','width'=>'1%'],

           [
               'attribute'=>'id_ref_program_agen','width'=>'3%',
               
               'value'=>function($data){
        return $data->refProgramAgen->nama_program;
               }
           ],
           // 'id',
          ['attribute'=>'id_data_agen','width'=>'15%',
              'value'=>function($data){
               return $data->dataAgen->nama_agen;
              }
              ],
                   
            //'no_acak',
            ['attribute'=>'tahun','width'=>'2%'],

            ['class' => 'kartik\grid\ActionColumn','width'=>'12%',
                'template'=>'{update} {detail}',
                'buttons'=>[
                    'update'=>function($url,$data,$key){
                  return Html::button('Input Keberangkatan',[
                      'class'=>'btn btn-md btn-warning showModalButton',
                      'value'=> Url::to(['/detail-program-agen/create','id'=>$key])
                  ]);
                    },
                                        'detail'=>function($url,$data,$key){
                  return Html::button('Detail',[
                      'class'=>'btn btn-md btn-info showModalButton',
                      'value'=> Url::to(['/detail-program-agen/detail-program-agen','id'=>$key])
                  ]);
                    }
                ]
                ],
        ],
    ]); ?>


</div>
