<?php

use kartik\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap4\Html;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataBarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Barangs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-barang-index">

  <!-- begin row -->

<!-- end row -->
<!-- begin row -->


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   
    <?php
    $form = \kartik\form\ActiveForm::begin([
        'action'=>['delete-id'],
        'method'=>'POST'
    ]);
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel'=>[
            'heading'=>'Daftar Item di Agen',
            'type'=> kartik\grid\GridView::TYPE_INFO,
              'after'=> Html::submitButton('Hapus Yang di ceklist', ['class'=>"btn btn-md btn-danger"]),
            'footer'=>''
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
      ['class'=> '\kartik\grid\CheckboxColumn'],
      
       //     'id',
         [
             'attribute'=>"id_data_agen",
         'value'=>'dataAgen.nama_agen'
         ],
            'item_barang',
          //  'id_ref_satuan_barang',

            
        ],
    ]); 
     $form->end();
    ?>


</div>
