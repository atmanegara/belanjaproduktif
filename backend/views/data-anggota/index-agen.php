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

<div class="panel panel-primary">
		<div class='panel-heading'>
			<h4 class='panel-title'>Daftar Anggota</h4>
		</div>
		<div class='panel-body'>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
     'responsiveWrap' => false,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn','width'=>"2%"],

          //  'id',
           ['attribute'=> 'id_agen','width'=>'5%'],
          //  'id_ref_agen',
           ['attribute'=>'nama_agen','width'=>'10%'],
           ['attribute'=> 'nik','width'=>"5%"],
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
                'template'=>"{detalbawah} {deletez}",
                'buttons'=>[
                    'detalbawah'=>function($url,$data,$key){
                   //     $url = ['/data-','id'=>$key];
                      return \yii\bootstrap4\Html::a('Detail Anggota',['detail-anggota','no_acak_agen'=>$data['no_acak']],['class'=>'btn btn-warning']);
                    },
                            'delete'=>function($url,$data,$key){
                        $no_acak = $data['no_acak'];
                $dataReg = RegistrasiAgen::find()->where(['no_acak'=>$no_acak]);
                if(!$dataReg->exists()){
            
                    return Html::a("<span class='fa fa-trash'></span> Hapus", ['delete','no_acak'=>$no_acak], [
                        'class'=>'btn btn-md btn-danger',
                        'data'=>[
                            'method'=>'post',
                            'confirm'=>'Anda Yakin item ini dihapus?'
                        ]
                    ]);
                }
                            }
                            ]
//                    'upload'=>function($url,$data){
//                           $url = ['/berkas-agen/index','no_acak'=>$data['no_acak']];
//                            return \yii\bootstrap4\Html::a('Berkas',$url,['class'=>'btn btn-default']);
//                    },
//                    'view'=>function($url,$data){
//                        $url = ['/data-agen/view','no_acak'=>$data['no_acak']];
//                        return \yii\bootstrap4\Html::a('View',$url,['class'=>'btn btn-info']);
//                    },
//                    'kirim'=>function($url,$data){
//                         $no_acak = $data['no_acak'];
//                $dataReg = RegistrasiAgen::find()->where(['no_acak'=>$no_acak])->one();
//                
//                        $url = ['/registrasi-agen/kirim','no_acak'=>$data['no_acak']];
//                        if($dataReg['id_ref_proses_pendaftaran']=='2'){
//                            return '';
//                        }
//                        return \yii\bootstrap4\Html::button('Kirim',['class'=>'btn btn-primary showModalButton',
//                            'value'=>Url::to($url)]);
//                        
//                    }
//                ]
          ],
        ],
    ]); ?>
		</div>
</div>



</div>
