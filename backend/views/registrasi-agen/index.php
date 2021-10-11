<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RegistrasiAgenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registrasi Agens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registrasi-agen-index">

    <h1 class="page-header">Halaman Registrasi Agen</h1>

    <div class="note note-primary m-b-15">
        <div class="note-icon"><i class="fas fa-info"></i></div>
        <div class="note-content">
            <h4><b>Informasi!</b></h4>
            <p>
                Halaman ini untuk verifikasi data agen yang melakukan pedaftartan yang sudah mengisi data pribadi setiap agen promo,
            </p>
        </div>
    </div>
    <div class='row'>
        <div class="col-lg-4 col-md-6">
            <div class="widget widget-stats bg-warning">
                <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                <div class="stats-info">
                    <h4>TOTAL ANGGOTA BARU MASUK</h4>
                    <p><?= $countAll ?></p>	
                </div>
                <div class="stats-link">
                    <a href="<?= Url::to(['index']) ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="widget widget-stats bg-info">
                <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                <div class="stats-info">
                    <h4>TOTAL ANGGOTA BARU PROSESS</h4>
                    <p><?= $countProces ?></p>	
                </div>
                <div class="stats-link">
                    <a href="<?= Url::to(['index', 'id_ref_proses_pendaftaran' => 1]) ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="widget widget-stats bg-success">
                <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                <div class="stats-info">
                    <h4>TOTAL ANGGOTA BARU TERVERIFIKASI</h4>
                    <p><?= $countSelesai ?></p>	
                </div>
                <div class="stats-link">
                    <a href="<?= Url::to(['index', 'id_ref_proses_pendaftaran' => 2]) ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>

    </div>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'panel' => [
            'type' => \kartik\grid\GridView::TYPE_PRIMARY
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn', 'width' => '1%'],
            //        'id',
            ['attribute' => 'no_reg', 'width' => '3%'],
            ['attribute' => 'tgl_registrasi', 'width' => '3%'],
            ['attribute' => 'nik', 'width' => '5%'],
            ['attribute' => 'nama',
                'format' => 'raw',
                'value' => function($data) {
                    $no_acak = $data['no_acak'];
                    $modelex = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak]);
                    return $modelex->exists() ? $modelex->one()->nama_agen : $data['nama'].'<br>'."<span class='label label-danger'>Data Pribadi Belum Di isi</span>";
                },
                'width' => '15%'],
            //'alamat:ntext',
            //'rt_rw',
            //'id_ref_kelurahan',
            //'id_ref_kecamatan',
            'nope',
            //'email:email',
            //'id_ref_agen',
            ['attribute' => 'id_ref_proses_pendaftaran', 'width' => '1%',
                'format' => "raw",
                'value' => function($data) {
                    switch ($data['id_ref_proses_pendaftaran']) {
                        case 2:

                            $html = "<span class='label label-success'>" . $data->refProsesPendaftaran->nama_proses . "</span>";
                            break;
                        case 3:
                            $html = "<span class='label label-warning'>" . $data->refProsesPendaftaran->nama_proses . "</span>";

                            break;
                        default:
                            $html = "<span class='label label-info'>" . $data->refProsesPendaftaran->nama_proses . "</span>";
                            break;
                    }
                    return $html;
                }
            ],
           ['attribute' => 'setuju', 'width' => '1%',
            'format'=>'raw',
        'value'=>function($data){
            return $data['setuju']=='Y' ? "<span class='label label-success'> Setuju </span>" : "<span class='label label-warning'> Tidak Setuju </span>";
        }
        ],
            ['class' => 'kartik\grid\ActionColumn', 'width' => '10%', 'template' => "{view} {verifikasi} {delete} {formulirx}",
                'buttons' => [
//                     'verifikasi'=>function($url,$data){
//                         $url = Url::to(['/registrasi-agen/verifikasi-data','no_acak'=>$data['no_acak']]);
//                         return \yii\bootstrap4\Html::button('Verifikasi',['class'=>'btn btn-primary showModalButton','value'=>$url]);
//                     }

                    'view' => function($url, $data) {
                        $no_acak = $data['no_acak'];
                        $modelex = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak]);
                        if (!$modelex->exists()) {
                            return "<span class='label label-warning'>Data Pribadi Belum diisi</span>";
                        } else {
                            $url = Url::to(['/registrasi-agen/view-calon-agen', 'no_acak' => $no_acak]);
                            return \yii\bootstrap4\Html::a('Cek Data', $url, ['class' => 'btn btn-primary ']);
                        }
                    },
                                'formulir'=>function($url,$data){
                         $no_acak = $data['no_acak'];
                
                    
                      $url = Url::to(['/data-agen/preview-formulir-agen', 'no_acak' => $no_acak]);
                      
                        return \yii\bootstrap4\Html::a('Formulir Agen',$url,['class'=>'btn btn-success ']);
                        
                    },
                    'delete'=>function($url,$data){
                        if($data['id_ref_proses_pendaftaran']==2){
                            return '';
                        }else{
                            return Html::a("<i class='fa fa-trash'></i>", $url, ['btn btn-md btn-danger',
                                'data'=>[
                                    'confirm'=>'Yakin dihapus, data akan hilang, disarankan lakukan konfirmasi ulang pendaftaran registrasi',
                                    'method'=>'POST'
                                ]
                                ]);
                        }
                    }
                ]
            ],
        ],
    ]);
    ?>


</div>
