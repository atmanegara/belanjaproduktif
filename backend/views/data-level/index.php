<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataLevelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Level';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-level-index">

 
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'panel'=>[
            'type'=> \kartik\grid\GridView::TYPE_INFO,
            'heading'=>'Daftar Agen'
        ],
        'dataProvider' => $dataProvider,
        'responsiveWrap' => false,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn','width'=>'1%'],

           ['attribute'=> 'id_agen','width'=>'5%'],
          //  'id_ref_agen',
           ['attribute'=> 'nik','width'=>"15%"],
           ['attribute'=>'nama_agen','width'=>'20%'],
  ['attribute'=>'id_ref_agen','width'=>'10%',
      'filter'=> \backend\models\RefAgen::getDropdownlistByAktif(),
      'value'=>'refAgen.nama_agen'],
            ['class' => 'kartik\grid\ActionColumn','template'=>'{riwayat} {update}',
                'buttons'=>[
                    'riwayat'=>function($url,$data,$key){
        $url = ['view','no_acak'=>$data['no_acak']];
                        return Html::a('Riwayat Level', $url,['class'=>"btn btn-md btn-info"]);
                    },
                            'update'=>function($url,$data,$key){
                        $url = ['create','id'=>$key];
                        return Html::button('Ganti Level', ['class'=>'btn btn-md btn-warning showModalButton','value'=> \yii\helpers\Url::to($url)]);
                            }
                ]],
        ],
    ]); ?>


</div>
