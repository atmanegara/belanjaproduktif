<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use backend\models\RegistrasiAgen;
use backend\models\RefProsesPendaftaran;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataAgenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Agens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-agen-index">

    <p>
        <?= Html::a('Kembali',['index-agen','id_ref_agen'=>$id_ref_agen],[
            'class'=>'btn btn-default',
        ]) ?>
        
           
    </p>
<div class="panel panel-primary">
		<div class='panel-heading'>
			<h4 class='panel-title'>Daftar Anggota</h4>
		</div>
		<div class='panel-body'>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn','width'=>"2%"],

          //  'id',
    //       ['attribute'=> 'id_agen','width'=>'5%'],
          //  'id_ref_agen',
           ['attribute'=> 'nik','width'=>"5%"],
           ['attribute'=>'nama_agen','width'=>'10%'],
           ['attribute'=> 'alamat','width'=>"5%"],
           ['attribute'=> 'nope','width'=>"5%"],
         [
            'header'=>'Status Anggota','width'=>"5%",
            'format'=>'raw',
            'value'=>function($data){
                $no_acak = $data['no_acak'];
                $dataReg = RegistrasiAgen::find()->where(['no_acak'=>$no_acak]);
                if($dataReg->exists()){
               $dataReg = $dataReg->one();
                    return RefProsesPendaftaran::find()->where(['id'=>$dataReg['id_ref_proses_pendaftaran']])->one()->nama_proses;
                }else{
                    return '-';
                }
            }
        ],

        ['class' => 'kartik\grid\ActionColumn','width'=>"15%",
                'template'=>"{view} {delete}",
                'buttons'=>[
                       'delete'=>function($url,$data,$key){
        return Html::a('<span class="fa fa-trash" aria-hidden="true"></span>',Url::to( ['delete-id','id'=>$key]), ['class' => 'btn btn-danger btn-md',
            'data'=>[
                'confirm'=>'Anda Yakin Hapus item ini?',
                'method'=>'post'
            ]]);
                   },
                    'view'=>function($url,$data){
                        $url = ['/registrasi-agen/view-reg','no_acak'=>$data['no_acak']];
                        return \yii\bootstrap4\Html::a('View',$url,['class'=>'btn btn-info']);
                    },
             
                ]
            ],
        ],
    ]); ?>
		</div>
</div>



</div>
