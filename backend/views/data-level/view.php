<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\detail\DetailView;
/* @var $this yii\web\View */
/* @var $model backend\models\DataLevel */

$this->title = 'Riwayat LEvel Agen';
$this->params['breadcrumbs'][] = ['label' => 'Data Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="data-level-view">

      <p>
        <?= Html::a('Kembali', ['index'], ['class' => 'btn btn-primary']) ?>

    </p>
    <?=
 DetailView::widget([
     'mode'=> DetailView::MODE_VIEW,
     'panel'=>[
         'type'=> DetailView::TYPE_INFO,
         'heading'=>'.;. LIST'
     ],
     'buttons1'=>false,
        'model'=>$modelDataAgen,
        'attributes'=>[
            'id_agen',
            'nik','nama_agen',
          [
              'attribute'=>'id_ref_agen',
              'value'=>$modelDataAgen->refAgen->nama_agen
              
          ]
        ]
    ])
?>
     <?= GridView::widget([
         'panel'=>[
             'type'=> GridView::TYPE_INFO,
             'heading'=>'Daftar Riwayat Level Agen'
         ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

  //          'id',
    //        'no_acak',
            [
                'attribute'=>'dari_id_ref_agen',
                'value'=>function($data){
         return backend\models\RefAgen::findOne($data['dari_id_ref_agen'])->nama_agen;
                }
            ],
                        [
                'attribute'=>'ke_id_ref_agen',
                'value'=>function($data){
         return backend\models\RefAgen::findOne($data['ke_id_ref_agen'])->nama_agen;
                }
            ],
            'tgl_masuk',
            'catatan:ntext',

        ],
    ]); ?>

</div>
