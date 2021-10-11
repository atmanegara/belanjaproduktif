<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use backend\models\RegistrasiAgen;
use backend\models\RefProsesPendaftaran;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataAgenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Daftar Agen';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-agen-index">


<div class="panel panel-primary">
 <h1 class="page-header">Halaman Daftar Join Agen</h1>
      <div class="note note-primary m-b-15">
					<div class="note-icon"><i class="fas fa-info"></i></div>
					<div class="note-content">
						<h4><b>Informasi!</b></h4>
						<p>
							Halaman ini menampilkan mitra agen yang belum mempunyai ID referensi
                                                </p>
					</div>
				</div>
  <!-- begin row -->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       'filterModel' => $searchModel,
        'pjax'=>true,
     'responsiveWrap' => false,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn','width'=>"2%"],

    [
        'attribute'=>'filename',
        'format'=>"raw",'width'=>'2%',
        'value'=>function($data){
        return Html::img(Yii::getAlias('@sourcePathImg') . '/' . $data['filename'], ['width' => '90px', 'height' => '90px']).''
                . '<br>'.yii\bootstrap4\Html::button('Ganti foto',['class'=>'btn btn-md btn-warning fa fa-camera showModalButton','value'=>Url::to(['/data-agen/reupload','id'=>$data['id']])]);
        }
    ],
           ['attribute'=> 'id_agen','width'=>'5%'],
          //  'id_ref_agen',
           ['attribute'=> 'nik','width'=>"5%"],
           ['attribute'=>'nama_agen','width'=>'10%'],
           ['attribute'=>'alamat','width'=>'10%'],
        [
            'header'=>'Status Anggota','width'=>"5%",
            'value'=>function($data){
                $no_acak = $data['no_acak'];
                $dataReg = RegistrasiAgen::find()->where(['no_acak'=>$no_acak]);
             $nama_proses = '';
                     if($dataReg->exists()){
                    $proses=$dataReg->one();
                    $id_ref_proses_pendaftaran = $proses['id_ref_proses_pendaftaran'];
                           $prosespendafatran= RefProsesPendaftaran::find()->where(['id'=>$id_ref_proses_pendaftaran])->one();
                           $nama_proses = $prosespendafatran['nama_proses'];
                }
                return $nama_proses;
            }
        ],

        ['class' => 'kartik\grid\ActionColumn','width'=>"15%",
                'template'=>"{join}",
                'buttons'=>[
                            'join'=>function($url,$data){
                                if(in_array($data['id_ref_agen'], ['2','3','7'])){
                                    if($data['no_acak_ref']=='' || $data['no_acak_ref']==Yii::$app->user->identity->no_acak){
                                        return Html::button('Join Agen',['class'=>'btn btn-md btn-primary showModalButton','value'=> Url::to(['create-join','no_acak'=>$data['no_acak']])]);
                                    }
                                }
                            }

                ]
            ],
        ],
    ]); ?>
		</div>
</div>



</div>
