<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use backend\models\RegistrasiAgen;
use backend\models\RefProsesPendaftaran;
use backend\models\ArsipRegistrasiAgen;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataAgenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Agens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-agen-index">

    <p>
        <?= Html::button('Tambah Anggota Baru',[
            'class'=>'btn btn-primary showModalButton',
            'value'=>Url::to(['/registrasi-agen/create','id_referen_agen'=>$id_agen])
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
                'template'=>"{view}",
                'buttons'=>[
                    
                    'view'=>function($url,$data){
                        $url = ['/registrasi-agen/view-data-anggota','no_acak'=>$data['no_acak']];
                        return \yii\bootstrap4\Html::a('View',$url,['class'=>'btn btn-info']);
                    },
             
                ]
            ],
        ],
    ]); ?>
		</div>
</div>



</div>
