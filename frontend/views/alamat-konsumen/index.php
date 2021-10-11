<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Alamat Konsumens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alamat-konsumen-index">
    
    <div class=" col-md-12" style="margin-top: 5px">
        <p>
        <?= Html::button('Tambah Alamat baru',  ['class' => 'btn btn-success showModalButton',
            'value'=> \yii\helpers\Url::to(['create'])
            ]) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

       //     'id',
      //      'no_acak',
            'alamat:ntext',
        //    'id_data_konsumen',
            [
             'attribute'=>'ini',
                'header'=>'Status Alamat',
                'format'=>'raw',
                'value'=>function($data){
        if($data['ini']=='Y'){
            $label = 'label label-success';
            $info = 'alamat utama';
        }else{
            $label = 'label label-info';
            $info = '-';
        }
                return "<span class='$label'>".$info."</span>";
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?> 
    </div>



</div>
