<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TutupBukuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tutup Bukus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tutup-buku-index">
 <h1 class="page-header">Halaman Daftar Komisi</h1>
      <div class="note note-primary m-b-15">
					<div class="note-icon"><i class="fas fa-info"></i></div>
					<div class="note-content">
						<h4><b>Informasi!</b></h4>
							<p>
							PENGAJUAN LAPORAN HANYA PERHARI, DISARANKAN LAKUKAN SETELAH SELESAI TRANSAKSI DALAM 1 HARI (TUTUP TOKO) 
                                        
                                                <p>
                                                    <span class="label label-danger">jika ingin mengulang laporan hapus laporan terdahulu, jika sudah diverifikasi / sudah dibagi hasil komisinya, laporan ditidak bisa dihapus</span>
                                                </p>
                                                
					</div>
				</div>

    <p>
        <?= Html::button('Buat Laporan',['class' => 'btn btn-success showModalButton','value'=> yii\helpers\Url::to( ['create'])]) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'panel'=>[
          'heading'=>'Daftar Transaksi Yang Terlapor'  ,
            'type'=> GridView::TYPE_INFO
        ],
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

      //      'id',
            'no_acak:text:No Tutup Buku',
         //   'kd_posting',
     //       'bulan_posting:text:Bulan','tahun_posting:text:Tahun',
     [
       'header'=>'Tanggal Bulan Laporan s/d',
         'value'=>function($data){
            return $data['tgl_lapor'].' s/d '.$data['tgl_lapor_akhir'];
         }
     ],
    [
                'attribute' => 'verifikasi',
                'format' => 'raw',
                'value' => function($data) {
                 $dataBagiHasil = \backend\models\DataBagiHasil::find()->where(['no_acak_tutup_buku'=>$data['no_acak']])->exists();
                       $ketBagiHasil="<span class='label label-info'>Belum bagi hasil</span> "; 
                               if($dataBagiHasil){
                              $ketBagiHasil = "<span class='label label-primary'>Sudah input </span> "; 
                            }
                    return $data['verifikasi'] == '0' ? "<span class='label label-info'>Prosess</span>" .'|'.$ketBagiHasil : "<span class='label label-success'>Terverifikasi</span>".'|'.$ketBagiHasil;
                }
            ],
            'tgljam_lapor:text:Tanggal Jam Input',
            ['class' => 'kartik\grid\ActionColumn','template'=>'{preview} {delete}', 'width' => '20%',
                'buttons'=>[
                    'delete'=>function($url,$data){
                        $no_acak = $data['no_acak'];
                        $no_acak_user = $data['no_acak_user'];
                    if ($data['verifikasi'] == '0') {
                    $urlHapus = ['/data-bagi-hasil/delete-laporan', 'no_acak_tutup_buku' => $no_acak];
                                             return  Html::a('Hapus Laporan', $urlHapus, ['class' => "btn btn-md btn-danger",
                                                 'data'=>[
                                                     'method'=>'post',
                                                     'confirm'=>'Yakin Laporan ini di hapus?'
                                                 ]
                                                 ]);
                    }else{
                          return "<span class='label label-info'>Laporan sudah diverifikasi, untuk info lanjut silahkan hubungi Admin ";
                    }
                    
                    },
                    'preview'=>function($url,$data){
                    $no_acak = $data['no_acak'];
                    $url = ['/laporan-penjualan/preview-lap-penjualan-agen','no_acak'=>$no_acak];
                    return Html::a('Preview', $url,['class'=>"btn btn-md btn-warning"]);
                    }
                ]
                ],
        ],
    ]); ?>


</div>
