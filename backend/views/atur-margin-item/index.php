<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\AturMarginItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Atur Margin Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atur-margin-item-index">

     <h3>PERHITUNGAN MARGIN ITEM</h3>
<div class="note note-primary m-b-15">
					<div class="note-icon"><i class="fas fa-info"></i></div>
					<div class="note-content">
						<h4><b>Informasi!</b></h4>
						<p>
							Halaman ini untuk daftar margin di setiap Item
                                                </p>
                                                 <p>
    </p>
					</div>
				</div>
    <p>
        <?= Html::button('Tambah baru',['class' => 'btn btn-success showModalButton',
            'value'=>Url::to( ['create'])]) ?>
    </p>
    

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    </p>

    
    <?= GridView::widget([
        'panel'=>[
          'type'=> GridView::TYPE_INFO,
            'heading'=>'Daftar Pengaturan Margin Item'
        ],
        'dataProvider' => $dataProvider,
      //  'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

      //      'id',
            [
              'attribute'=>'id_ref_barang',
                'value'=>'refBarang.nama_barang'
            ],
            
            'nilai:text:Nilai Margin (%)',
           [
               'header'=>'Harga Satuan',
               'format'=>'decimal',
               'attribute'=>'harga_satuan'
           ],

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
