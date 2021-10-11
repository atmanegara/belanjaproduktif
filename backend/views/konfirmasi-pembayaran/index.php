<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use backend\models\RegistrasiAgen;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\KonfirmasiPembayaranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Konfirmasi Pembayarans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="konfirmasi-pembayaran-index">
    <h1 class="page-header">Halaman Konfirmasi Pembayaran</h1>
    <div class="note note-primary m-b-15">
        <div class="note-icon"><i class="fas fa-info"></i></div>
        <div class="note-content">
            <h4><b>Informasi!</b></h4>
            <p>
                Halaman ini untuk melakukan konfirmasi pembayaran pendaftaran agen,
            <ol type="1">
              <li>
                    Tombol [Konfirmasi] digunakan untuk melakukan konfirmasi pembayaran dari calon agen
                </li>    <li>      Tombol [Hapus] digunakan untuk mengahapus data pembayaran, si calon agen akan melakukan pendaftaran ulang,
                </li>
                <li>    Tombol [Konfirmasi Ulang] digunakan untuk membatalkan konfirmasi awal, komisi / bagi hasil pendaftaran, dan lakukan konfirmasi ulang lagi, tanpa si calon agen melakukan daftar ulang,
                </li>
              
            </ol>

            </p>
        </div>
    </div>
    <div class='row'>
        <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-gradient-purple">
                <div class="stats-icon stats-icon-lg"><i class="fa fa-archive fa-fw"></i></div>
                <div class="stats-content">
                    <div class="stats-title">SEMUA PEMBAYARAN MASUK</div>
                    <div class="stats-number"><?= $countAll ?></div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 100%;"></div>
                    </div>
                    <div class="stats-link">
                        <a href="<?= Url::to(['index']) ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-gradient-blue">
                <div class="stats-icon stats-icon-lg"><i class="fa fa-archive fa-fw"></i></div>
                <div class="stats-content">
                    <div class="stats-title">MENUNGGU PEMBAYARAN</div>
                    <div class="stats-number"><?= $countAll3 ?></div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 100%;"></div>
                    </div>
                    <div class="stats-link">
                        <a href="<?= Url::to(['index', 'id_status_pembayaran' => 3]) ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-gradient-yellow">
                <div class="stats-icon stats-icon-lg"><i class="fa fa-archive fa-fw"></i></div>
                <div class="stats-content">
                    <div class="stats-title">MENUNGGU VERIFIKASI (SUDAH BAYAR)</div>
                    <div class="stats-number"><?= $countAll1 ?></div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 100%;"></div>
                    </div>
                    <div class="stats-link">
                        <a href="<?= Url::to(['index', 'id_status_pembayaran' => 1]) ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-gradient-green">
                <div class="stats-icon stats-icon-lg"><i class="fa fa-archive fa-fw"></i></div>
                <div class="stats-content">
                    <div class="stats-title">PEMBAYARAN TERKONFIRMASI/VERIFIKASI</div>
                    <div class="stats-number"><?= $countAll2 ?></div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 100%;"></div>
                    </div>
                    <div class="stats-link">
                        <a href="<?= Url::to(['index', 'id_status_pembayaran' => 2]) ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsiveWrap' => false,
        'pjax' => true,
        'panel' => [
            'type' => GridView::TYPE_INFO
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn', 'width' => '1%'],
            [
                'attribute' => 'id_status_pembayaran', 'width' => '3%',
                'filter' => $modelStatusPembayaran,
                'format' => 'raw',
                'value' => function($data) {
                    $info = '';
                    if ($data['id_status_pembayaran'] == '2') {
                        $info = " <span class='label label-success'>" . $data['tgl_konfirmasi'] . "</span>";
                    }
                    return "<p> " . $data->statusPembayaran->status_pembayaran . " " . $info . " </p>";
                }
            ],
            ['attribute' => 'no_acak', 'width' => '1%'],
            ['attribute' => 'no_invoice', 'width' => '2%'],
       [
                'header' => 'No Telp', 'width' => '5%',
                'value' => function($data) {
                    $nope = '';
                    $dataRegistrasiAgen = RegistrasiAgen::find()->where(['no_acak' => $data['no_acak']]);
                    if ($dataRegistrasiAgen->exists()) {
                        $dataReg = $dataRegistrasiAgen->one();
                        $nope = $dataReg['nope'];
                    }

                    return $nope;
                }
            ],
                    ['attribute'=>'nik'],
            [
                'header' => 'Data Calon Agen', 'width' => '5%',
                'value' => function($data) {
                    $nik = '';
                    $nama = '';
                    $dataRegistrasiAgen = RegistrasiAgen::find()->where(['no_acak' => $data['no_acak']]);
                    if ($dataRegistrasiAgen->exists()) {
                        $dataReg = $dataRegistrasiAgen->one();
                        $nik = $dataReg['nik'];
                        $nama = $dataReg['nama'];
                    }

                    return $nik . ' - ' . $nama. '';
                }
            ],
            [
                'header' => 'Agen', 'width' => '5%',
                'value' => function($data) {
                    $agen = '';
                    $dataRegistrasiAgen = RegistrasiAgen::find()->where(['no_acak' => $data['no_acak']]);
                    if ($dataRegistrasiAgen->exists()) {
                        $dataReg = $dataRegistrasiAgen->one();
                        $refagen = backend\models\RefAgen::findOne($dataReg['id_ref_agen']);
                        $agen = $refagen['nama_agen'];
                    }

                    return $agen;
                }
            ],
            ['attribute' => 'nominal', 'width' => '3%',
                'format' => 'raw',
                'value' => function($data) {
                    $html = '';
                    $dataRegistrasiAgen = RegistrasiAgen::find()->where(['no_acak' => $data['no_acak']]);
                    if ($dataRegistrasiAgen->exists()) {
                        $dataReg = $dataRegistrasiAgen->one();
                        if (in_array($dataReg['id_ref_agen'], ['3', '4'])) {
                            $html = "<span class='label label-success'>Gratis</span>";
                        }
                        if ($data['nominal']) {
                            $html = number_format($data['nominal'], 0, ',', '.');
                        } else {
                            $html = "<span class='label label-warning'>Belum Bayar</span>";
                        }
                    }

                    return $html;
                }
            ],
            [
                'filter' => function($data) {
                    return ['type' => 'date'];
                },
                'attribute' => 'tgl_transfer', 'width' => '3%',
                'format' => 'raw',
                'value' => function($data) {
                    $html = '';
                    $dataRegistrasiAgen = RegistrasiAgen::find()->where(['no_acak' => $data['no_acak']]);
                    if ($dataRegistrasiAgen->exists()) {
                        $dataReg = $dataRegistrasiAgen->one();
                        if (in_array($dataReg['id_ref_agen'], ['3', '4'])) {

                            $html = "<span class='label label-success'>Gratis</span>";
                        }
                        if ($data['tgl_transfer']) {
                            $html = $data['tgl_transfer'];
                        } else {
                            $html = "<span class='label label-warning'>Belum Bayar</span>";
                        }
                    }



                    return $html;
                }
            ],
            ['class' => 'kartik\grid\ActionColumn', 'width' => '30%',
                'template' => '{view} {delete} {rekonfir} {printiinvoice}',
                'buttons' => [
                    'delete' => function($url, $data, $key) {
                  if ($data['id_status_pembayaran'] == '2') {
                      
                  }else{
                        return Html::a('<span class="fa fa-trash" aria-hidden="true"></span>', Url::to(['delete', 'id' => $key]),
                                        ['class' => 'btn btn-danger',
                                            'data' => [
                                                'confirm' => '.:. PERHATIAN .:. Anda Yakin Hapus item ini? RESIKO > SI CALON AGEN AKAN MELAKUKAN PENDAFTARAN ULANG',
                                                'method' => 'post'
                        ]]);
                  }
                    },
                    'view' => function($url, $data) {
                        if ($data['id_status_pembayaran'] == '2') {
                            return "";
                        } else {
                            return Html::a('Konfirmasi', ['view', 'id' => $data['id']], ['class' => "btn btn-md btn-warning"]);
                        }
                    },
                    'rekonfir' => function($url, $data, $key) {
                        if ($data['id_status_pembayaran'] == '2') {
                            return Html::a('<span class="fa fa-undo" aria-hidden="true"></span> Konfirmasi Ulang', Url::to(['update', 'id' => $key]),
                                            ['class' => 'btn btn-default',
                                                'data' => [
                                                    'confirm' => 'Anda Yakin Ingin Konfirmasi Ulang, Komisi pada agen / admin akan di hapus ?',
                                                    'method' => 'post'
                            ]]);
                        }
                    },
                    'printiinvoice' => function($url, $data) {
                        if ($data['id_status_pembayaran'] == '2') {
                            return Html::a('Print Invoice', ['preview-invoice', 'id' => $data['id']], ['class' => "btn btn-md btn-success"]);
                        }
                    }
                ]
            ],
        ],
    ]);
    ?>


</div>
