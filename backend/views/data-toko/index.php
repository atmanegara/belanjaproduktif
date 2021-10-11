<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataTokoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Tokos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-toko-index">


    <p>
        <?php
        if(!in_array(Yii::$app->user->identity->role_id,['1'])){
       echo Html::button('Tambah Baru', ['class' => 'btn btn-success showModalButton',
            'value' => yii\helpers\Url::to(['create'])]);
        }
                ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?=
    GridView::widget([
        'panel' => [
            'type' => GridView::TYPE_INFO,
            'heading' => 'Data Toko'
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn', 'width' => '2%'],
        [
                'header'=>'Nama Pemilik',
            //  'attribute'=>'id_data_agen',
            'width' => '2%',
                'value'=> function($data){
        $dataAgen = \backend\models\DataAgen::findOne($data['id_data_agen']);
        return $dataAgen['nama_agen'];
                }
            ],     
              [
                'width' => '2%',
             'header'=>'Foto Toko',
               'format' => "raw",
                        'value' => function($data) {
                 $id_data_toko = $data['id'];
                    $fototoko = \backend\models\FotoToko::find()->where(['id_data_toko'=>$id_data_toko])->one();
                          return Html::img(Yii::getAlias('@sourcePathImg') . '/' . $fototoko['filename'], ['width' => '90px', 'height' => '90px']) . ''
                                    . '<br>' . yii\bootstrap4\Html::button('Ganti foto', ['class' => 'btn btn-md btn-warning fa fa-camera showModalButton', 
                                        'value' => Url::to(['/foto-toko/reupload', 'id_data_toko' => $data['id']])]);
                       
                        }
            ],
            [
                'attribute' => 'nama_toko',
                'width' => '2%',
            ],
            [
                'attribute' => 'alamat',
                'width' => '2%',
            ],
           
            [
                'attribute' => 'aktif',
                'format' => 'raw',
                'width' => '2%',
                'value' => function($data) {
                    return $data['aktif'] == 'Y' ? "<span class='label label-success'>BUKA</span>" : "<span class='label label-warning'>TUTUP</span>";
                }
            ],
            ['class' => 'kartik\grid\ActionColumn', 'width' => '20%', 'template' => '{view} {update} {delete} {jadwal}',
                'buttons' => [
                    'jadwal'=>function($url,$data,$key){
                        $url = ['/detail-toko','id_data_toko'=>$key];
                        return Html::a('Jadwal Toko',$url,['class'=>'btn btn-success']);
                    },
                    'view' => function($url, $data, $key) {
                        $url = \yii\helpers\Url::to(['/data-toko/view', 'id' => $key]);
                        return Html::button('<span class="fas fa-eye" aria-hidden="true"></span>', ['class' => 'btn btn-info showModalButton',
                                    'value' => $url]);
                    },
                    'update' => function($url, $data, $key) {
                        $url = \yii\helpers\Url::to(['/data-toko/update', 'id' => $key]);
                        return Html::button('<span class="fas fa-pencil-alt" aria-hidden="true"></span>', ['class' => 'btn btn-warning showModalButton',
                                    'value' => $url]);
                    },
                    'delete' => function($url, $data, $key) {
                        $url = \yii\helpers\Url::to(['/data-toko/delete', 'id' => $key]);
                        return Html::a('<span class="fas fa-trash-alt" aria-hidden="true"></span>', $url, ['class' => 'btn btn-danger',
                                    'data' => [
                                        'method' => 'POST',
                                        'confirm' => 'Apakah anda yakin hapus item ini?'
                        ]]);
                    },
                ]],
        ],
    ]);
    ?>


</div>
