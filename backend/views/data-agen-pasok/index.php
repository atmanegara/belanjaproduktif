<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataAgenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Agens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-agen-index">
<div class='row row-space-10'>
	<div class='col-md-4'>
  <div class="note note-warning note-with-right-icon m-b-15">
					<div class="note-icon"><i class="fa fa-caret-right"></i></div>
					<div class="note-content text-left">
						<h4><b>1. Isi Data Pribadi dan Agen</b></h4>
						<p>
							Pastikan isi dengan benar sesuai KTP / KK, Jumlah Agen persyaratan maks sesuai jenis agen yang di pilih
							*<i>Info lengkap bisa di baca di bagian Bantuan</i>
						</p>
					</div>
				</div>
	</div>
	<div class='col-md-4'>
  <div class="note note-warning note-with-right-icon m-b-15">
					<div class="note-icon"><i class="fa fa-caret-right"></i></div>
					<div class="note-content text-right">
						<h4><b>2. Upload Berkas Persyaratan</b></h4>
						<p>
							Scan jadikan PDF untuk upload file persyaratan, atau dengan Foto yang jelas kualitas HD
							Max : 5mb / file
						</p>
					</div>
				</div>
	</div>
	<div class='col-md-4'>
  <div class="note note-warning note-with-right-icon m-b-15">
					<div class="note-icon"><i class="fa fa-caret-right"></i></div>
					<div class="note-content text-right">
						<h4><b>3. Kirim Data </b></h4>
						<p>
							JIka semua sudah selesai sesuai tahapan,pastikan data sudah dikirim ke belanja produksi
						</p>
					</div>
				</div>
	</div>
</div>
    <p>
        <?php
        if(in_array(Yii::$app->user->identity->id_ref_agen, ['2'])){
       echo Html::button('Buat Data Agen',['class' => 'btn btn-success showModalButton',
            'value'=>Url::to( ['create','no_acak'=>$no_acak,'no_acak_ref'=>$no_acak_ref])
        ]);
        }?>
    </p>
  

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

          //  'id',
            'id_agen',
          //  'id_ref_agen',
            'nama_agen',
            'nik',
            //'alamat:ntext',
            //'rt',
            //'rw',
            //'id_ref_kelurahan',
            //'id_ref_kecamatan',
            //'kode_post',
            //'tmpt_lahir',
            //'tgl_lahir',
            //'id_ref_status_sipil',
            //'pekerjaan',
            //'no_wa',
            //'alamat_domisili:ntext',
            //'rt_domisili',
            //'rw_domisili',
            //'id_ref_kecamatan_domisili',

            ['class' => 'kartik\grid\ActionColumn',
                'template'=>"{edit} {upload} {view} {kirim}",
                'buttons'=>[
                    'upload'=>function($url,$data){
                           $url = ['/berkas-agen/index','no_acak'=>$data['no_acak']];
                            return \yii\bootstrap4\Html::a('Berkas',$url,['class'=>'btn btn-info']);
                    },
                    'view'=>function($url,$data){
                        $url = ['/data-agen-pasok/view','no_acak'=>$data['no_acak']];
                        return \yii\bootstrap4\Html::a('View',$url,['class'=>'btn btn-warning']);
                    },
                    'kirim'=>function($url,$data){
                        $url = ['/registrasi-agen/kirim','no_acak'=>$data['no_acak']];
                        return \yii\bootstrap4\Html::button('Kirim',['class'=>'btn btn-primary showModalButton',
                            'value'=>Url::to($url)]);
                        
                    }
                ]
            ],
        ],
    ]); ?>


</div>
