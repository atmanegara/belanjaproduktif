<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pendapatan Registrasis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pendapatan-registrasi-index">

  


    <?= GridView::widget([
        'pjax'=>true,
        'panel'=>[
            'heading'=>'Daftar Pendapatan Registras',
            'type'=> kartik\grid\GridView::TYPE_INFO
        ],
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

       //     'id',
         //   'id_ref_agen',
            [
              'header'=>'Agen Terdaftar',
                'value'=>function($data){
        $dataAgen = \frontend\models\RegistrasiAgen::find()->where(['no_acak'=>$data['no_acak']]);
        if($dataAgen->exists()){
            $namaAgen = $dataAgen->one()->nama;
        }else{
            $namaAgen='-';
        }
        return $namaAgen;
                }
            ],
            [
              'label'=>'Agen',
                'value'=>'refAgen.nama_agen'
            ],
            'nominal',
            'tgl_masuk',

            ['class' => 'kartik\grid\ActionColumn','template'=>'{delete}'],
        ],
    ]); ?>


</div>
