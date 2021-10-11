<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RefBarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Halaman Referensi Barang';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-barang-index">

    <div class="note note-warning note-with-left-icon">
  <div class="note-icon"><i class="fa fa-lightbulb"></i></div>
  <div class="note-content text-left">
      <p>
                Download dan Import File Template Excel
     
      </p>
      <p>
          
       <?= Html::a('Download Template',['template-ref-barang'],['class'=>'btn btn-md btn-warning']) ?>
      
              <?= Html::button('Import Template',['class'=>'btn btn-md btn-success showModalButton','value'=> yii\helpers\Url::to(['import-ref-barang'])]) ?>
   
      </p>
  </div>
</div>
   
    <p>
        <?= Html::button('Buat Data Baru',  ['class' => 'btn btn-success showModalButton',
            'value'=> yii\helpers\Url::to(['create'])
            ]) ?>
        
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'panel'=>[
          'type'=> GridView::TYPE_INFO  
        ],
        'pjax'=>true,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn','width'=>'1%'],

     [
                    'attribute'=>'filename',
                    'format'=>'raw','width'=>'2%',
                    'value'=>function($data){
                        $filename_path = Yii::getAlias('@sourcePathImg/').$data['filename'];
                        $html =Html::button("<span class='fa fa-edit'></span> Edit Gambar",['class'=>"btn btn-warning showModalButton",'value'=> \yii\helpers\Url::to(['update-gambar','id'=>$data['id']])]);
                        
                        return Html::img($filename_path,['width'=>'90px','height'=>'90px']).$html;
                    }
                ],
                        ['attribute'=>'kode_barcode','width'=>'10%'],
            ['attribute'=>'kode','width'=>'10%'],
            ['attribute'=>'nama_barang','width'=>'15%'],

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
