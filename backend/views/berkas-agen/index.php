<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BerkasAgenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Berkas Agens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="berkas-agen-index">

    
   
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'panel'=>[
            'type'=> GridView::TYPE_INFO,
            'heading'=>'Daftar Berkas'
        ],
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

   //         'id',
 //           'id_agen',
            'id_data_agen',
//            'id_ref_jenis_dok',
            [
  //              'header'=>'Jenis Dok',
                'attribute'=>'id_ref_jenis_dok',
                'value'=>function($data){
                return $data->refJenisDok->nama_dok;
                }
            ],
            [
                'attribute'=>'filename',
                'format'=>'raw',
                'value'=>function($data){
                $url=Url::to(Yii::getAlias('@sourcePathImg/').$data['filename']);
                    return Html::a($data['filename'],$url,[
                        'onClick'=>
                        "window.open('".$url."',
                         'newwindow',
                         'width=300,height=250');
              return false;"
                    ]);
                }
            ],
            'filename',

        //    ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
