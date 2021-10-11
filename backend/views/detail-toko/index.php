<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DetailTokoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detail Tokos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-toko-index">

      <p>
           <?= Html::a('<i class="fa fa-backward"></i> Kembali', ['/data-toko'], ['class' => 'btn btn-default']) ?>
     
         <?= Html::button('Tambah Jadwal Baru',['class' => 'btn btn-success showModalButton',
            'value'=>Url::to( ['create','id_data_toko'=>$id_data_toko])]) ?>
    </p>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
         'panel'=>[
            'heading'=>'Daftar Jadwal Toko',
            'type'=> kartik\grid\GridView::TYPE_INFO
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

          //  'id',
            [
                'header'=>'Toko',
                'value'=>function($data){
                    return backend\models\DataToko::findOne($data['id_data_toko'])->nama_toko;
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
           'aktif',
            'ket',

      ['class' => 'kartik\grid\ActionColumn','template'=>'{delete} {update}','width'=>'30%',
               'buttons'=>[
                   'update'=>function($url,$data,$key){
        return Html::button('<span class="fa fa-edit" aria-hidden="true"></span>', ['class' => 'btn btn-warning showModalButton',
            'value'=>Url::to( ['update','id'=>$key])
        ]);
                   },
                                  'delete'=>function($url,$data,$key){
        return Html::a('<span class="fa fa-trash" aria-hidden="true"></span>',Url::to( ['delete','id'=>$key]), ['class' => 'btn btn-danger btn-md',
            'data'=>[
                'confirm'=>'Anda Yakin Hapus item ini?',
                'method'=>'post'
            ]]);
                   }
               ] 
               
            ],
        ],
    ]); ?>


</div>
