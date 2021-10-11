<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataItemBarangAgenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Item Barang Agens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-item-barang-agen-index">


    <p>
        <?php
        if(count($dataProvider->getModels())==0){
        echo Html::button('Input Item baru',['class' => 'btn btn-success showModalButton',
            'value'=>Url::to( ['create'])
            ]) ;
        }?>
        
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'panel'=>[
            'heading'=>"Daftar Item",
            'type'=> GridView::TYPE_INFO
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

     //       'id',
          //  'no_acak',
        ['attribute'=>'id_ref_barang',
            'value'=>'refBarang.nama_barang'],
            [
              'header'=>'stok akhir',
                'format'=>'raw',
                'value'=>function($data){
                $no_acak=$data['no_acak'];
                $no_acak_promo = \frontend\models\DataDetailAgen::find()->where(['no_acak'=>$no_acak])->one();
                $dataAgen = \backend\models\DataAgen::find()->where(['no_acak'=>$no_acak_promo['no_acak_referensi']])->one();
                $dataBarang = \backend\models\DataBarang::find()->where(['id_data_agen'=>$dataAgen['id'],'id_ref_barang'=>$data['id_ref_barang']])->one();
                $stokBarang = \backend\models\StokBarang::find()->where(['id_data_agen'=>$dataAgen['id'],'id_data_barang'=>$dataBarang['id']])->one();;
                $stokSisa = $stokBarang['stok_sisa'];
                return $stokSisa;
                }
            ],
            'tgl_masuk',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
