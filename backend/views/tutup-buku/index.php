<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TutupBukuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lapor Transaksi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tutup-buku-index">
 <h1 class="page-header">Halaman Daftar Tutup Buku</h1>
      <div class="note note-primary m-b-15">
					<div class="note-icon"><i class="fas fa-info"></i></div>
					<div class="note-content">
						<h4><b>Informasi!</b></h4>
                                                <ul>
                                                    <li>
							PENGAJUAN LAPORAN HANYA PERHARI, DISARANKAN LAKUKAN SETELAH SELESAI TRANSAKSI DALAM 1 HARI (TUTUP TOKO) 
                                        
                                                        
                                                    </li>
                                                          <li>
							UNTUK MELIHAT PENERIMA KOMISI BISA LAKUKAN KLIK NOMOR ACAK TUTUP BUKU
                                                        
                                                    </li>
                                                </ul>
							<p>
                                                   <span class="label label-danger">jika ingin mengulang laporan hapus laporan terdahulu, jika sudah diverifikasi / sudah dibagi hasil komisinya, laporan ditidak bisa dihapus</span>
                                                </p>
                                                
					</div>
				</div>


    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'type' => kartik\grid\GridView::TYPE_INFO,
            'heading' => 'Daftar Tutup Buku Transaksi'
        ],
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn', 'width' => '1%'],
          
        //     ['attribute'=>'no_acak_tutup_buku'],
            [
                'header'=>'No Tutup Buku',
                'format'=>'raw',
                'attribute' => "no_acak",
                'value'=>function($data){
        $url = ['list-penerima-komisi','no_acak'=>$data['no_acak']];
                    //  $dataBagiHasil = \backend\models\DataBagiHasil::find()->where(['no_acak_tutup_buku'=>$data['no_acak']])->exists();
                   //    $ketBagiHasil="<span class='label label-info'>Belum bagi hasil</span> "; 
                           //    if($dataBagiHasil){
               
                    return '['.$data['tgljam_lapor'].'] '. Html::a($data['no_acak'], $url);
//                               }else{
//                                   return $data['no_acak'];
//                               }
                }
            ],
            //        'kd_posting',
           [
       'header'=>'Tanggal Bulan Laporan s/d', 'width' => '15%',
         'value'=>function($data){
            return $data['tgl_lapor'].' s/d '.$data['tgl_lapor_akhir'];
         }
     ],
            [
                'header' => "Nama Agen Lapor",
                'value' => function($data) {
                    $dataToko = (new \yii\db\Query())
                                    ->select('a.nama_toko')->from('data_toko a')->innerJoin('data_agen b', 'a.id_data_agen=b.id')
                                    ->where(['b.no_acak' => $data['no_acak_user']])->one();
                    return $dataToko['nama_toko'];
                }
            ],
            [
                'attribute' => 'verifikasi',
                'format' => 'raw',
                'value' => function($data) {
                 $dataBagiHasil = \backend\models\DataBagiHasil::find()->where(['no_acak_tutup_buku'=>$data['no_acak']])->exists();
                       $ketBagiHasil="<span class='label label-info'>Belum bagi hasil</span> "; 
                               if($dataBagiHasil){
                              $ketBagiHasil = "<span class='label label-primary'>Sudah Bagi Hasil </span> "; 
                            }
                    return $data['verifikasi'] == '0' ? "<span class='label label-info'>Prosess</span>" .'|'.$ketBagiHasil : "<span class='label label-success'>Terverifikasi</span>".'|'.$ketBagiHasil;
                }
            ],
            ['class' => 'kartik\grid\ActionColumn', 'template' => '{preview} {bagihasil} {cek}', 'width' => '40%',
                'buttons' => [
                    'preview' => function($url, $data) {
                        $no_acak = $data['no_acak'];
                        $no_acak_user = $data['no_acak_user'];
                        $url = ['/laporan-penjualan/verifikasi-lap-penjualan-agen', 'no_acak' => $no_acak, 'no_acak_user' => $no_acak_user];
                                if ($data['verifikasi'] == '1') {
                                    $urlHapus = ['/data-bagi-hasil/delete-laporan', 'no_acak_tutup_buku' => $no_acak];
                                             return Html::a('Preview', $url, ['class' => "btn btn-md btn-warning"]) .' | '. Html::a('Hapus Laporan', $urlHapus, ['class' => "btn btn-md btn-danger",
                                                 'data'=>[
                                                     'method'=>'post',
                                                     'confirm'=>'Yakin Laporan ini di hapus?'
                                                 ]
                                                 ]);
                
                                }else{
                        return Html::a('Preview', $url, ['class' => "btn btn-md btn-warning"]);
                                }
                    },
                    'bagihasil' => function($url, $data, $key) {
                        $no_acak = $data['no_acak'];
                        $no_acak_user = $data['no_acak_user'];
                        if ($data['verifikasi'] == '1') {
                            $dataBagiHasil = \backend\models\DataBagiHasil::find()->where(['no_acak_tutup_buku'=>$no_acak])->exists();
                            if($dataBagiHasil){
                            $url = ['/data-bagi-hasil/delete-no-tutup-buku', 'no_acak_tutup_buku' => $no_acak];
                            return   Html::a('Hapus Bagi Hasil', Url::to($url), [
                                        'class' => "btn btn-md btn-danger",
                                        'data' => [
                                            'confirm' => 'Yakin item Bagi Hasil ini mau dihapus?',
                                            'method' => 'post'
                                        ]
                            ]);
                        
                          //   return ;
                            }else{
                            $url = ['/data-bagi-hasil/create', 'no_acak_tutup_buku' => $no_acak, 'no_acak_user' => $no_acak_user];
                            return Html::button('Input Bagi Hasil', ['class' => "btn btn-md btn-info showModalButton", 'value' => Url::to($url)]);
                            }
                        }
                         
                    },
                                   'cek'=>function($url,$data){
                                    $url=['list-invoice-laporan','no_acak'=>$data['no_acak']];
                                    return Html::a('Cek Invoice', $url,['class'=>"btn btn-md btn-default"]);
                                }
                ]
            ],
        ],
    ]);
    ?>


</div>
