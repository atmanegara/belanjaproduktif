<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataKomisiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Komisis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-komisi-index">

    <h1 class="page-header">Halaman Daftar Komisi</h1>
    <div class="note note-primary m-b-15">
        <div class="note-icon"><i class="fas fa-info"></i></div>
        <div class="note-content">
            <h4><b>Informasi!</b></h4>
            <p>
                Halaman Daftar Komisi
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-icon"><i class="fa fa-money-bill-wave"></i></div>
                <div class="stats-info">
                    <h4>TOTAL KOMISI ADMIN BELANJA PRODUKTIF</h4>
                    <p><?= number_format($totalBp['nominal'],0,',','.') ?></p>	
                </div>
                <div class="stats-link">
                    <a href="<?= Url::to(['/data-komisi', 'id_ref_agen' => '5']) ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="widget widget-stats bg-blue">
                <div class="stats-icon"><i class="fa fa-money-bill-wave"></i></div>
                <div class="stats-info">
                    <h4>TOTAL KOMISI DI AGEN PROMO</h4>
                    <p><?= number_format($totalPromo['nominal'],0,',','.') ?></p>	
                </div>
                <div class="stats-link">
                    <a href="<?= Url::to(['/data-komisi', 'id_ref_agen' => '1']) ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
          <div class="col-lg-4 col-md-6">
            <div class="widget widget-stats bg-orange">
                <div class="stats-icon"><i class="fa fa-money-bill-wave"></i></div>
                <div class="stats-info">
                    <h4>TOTAL KOMISI DI AGEN STOKIS</h4>
                    <p><?= number_format($totalStokis['nominal'],0,',','.') ?></p>	
                </div>
                <div class="stats-link">
                    <a href="<?= Url::to(['/data-komisi', 'id_ref_agen' => '7']) ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="widget widget-stats bg-yellow">
                <div class="stats-icon"><i class="fa fa-money-bill-wave"></i></div>
                <div class="stats-info">
                    <h4>TOTAL KOMISI DI AGEN PASOK</h4>
                    <p><?= number_format($totalPasok['nominal'],0,',','.') ?></p>	
                </div>
                <div class="stats-link">
                    <a href="<?= Url::to(['/data-komisi', 'id_ref_agen' => '2']) ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>
      
        <div class="col-lg-4 col-md-6">
            <div class="widget widget-stats bg-grey">
                <div class="stats-icon"><i class="fa fa-money-bill-wave"></i></div>
                <div class="stats-info">
                    <h4>TOTAL KOMISI DI AGEN NIAGA</h4>
                    <p><?= number_format($totalNiaga['nominal'],0,',','.') ?></p>	
                </div>
                <div class="stats-link">
                    <a href="<?= Url::to(['/data-komisi', 'id_ref_agen' => '3']) ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [
            'type' => GridView::TYPE_INFO
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn', 'width' => '1%'],
            //    'id',
            //  'id_data_agen',
            [
                'header'=>'Agen  / Anggota Penerima Komisi',
                'attribute' => 'id_data_agen', 'width' => '10%',
                'format' => 'raw',
                'value' => function($data) {
                    $dataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $data['no_acak']]);
                    if ($dataAgen->exists()) {
                        $dataAgenx = $dataAgen->one();
                        $html = $dataAgenx['nik'] . ', ' . $dataAgenx['nama_agen'];
                    }
//                    else {
//                        $html = '-';
//                        if ($data['id_data_agen'] == '99') {
//                            $html = 'BP Kantor';
//                        }
//                    }
                    return $html;
                }
            ],
                     [
                'header'=>'Agen',
                'attribute' => 'id_data_agen', 'width' => '10%',
                'format' => 'raw',
                'value' => function($data) {
                    $dataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $data['no_acak']]);
                    if ($dataAgen->exists()) {
                        $dataAgenx = $dataAgen->one();
                        $refAgen = backend\models\RefAgen::findOne($dataAgenx['id_ref_agen']);
                        $html =$refAgen['nama_agen'];
                    }
//                    else {
//                        $html = '-';
//                        if ($data['id_data_agen'] == '99') {
//                            $html = 'BP Kantor';
//                        }
//                    }
                    return $html;
                }
            ],
            [
                'attribute' => 'tgl_transaksi', 'width' => '10%'],
            [
                'attribute' => 'nominal',
                'value' => function($data) {
                    return number_format($data['nominal'], 0, ',', '.');
                },
                'width' => '10%'
            ],
                         [
                'header' => 'Nominal Setelah Pembulatan',
                'value' => function($data) {
                //Pembulatan  ke atas
                $nominalUp = round ( $data['nominal'], -2);
                    return number_format($nominalUp, 0, ',', '.');
                },
                'width' => '10%'
            ],
            ['class' => 'kartik\grid\ActionColumn', 'width' => '10%', 'template' => '{view} {delete}',
                'buttons' => [
                    'view' => function($url, $data) {
                        $url = ['/transaksi-komisi', 'no_acak' => $data['no_acak']];
                        return Html::a('Riwayat Komisi', $url, ['class' => 'btn btn-md btn-primary']);
                    },
                    'update' => function($url, $data, $key) {
                        return Html::button('Update', ['class' => 'btn btn-md btn-info showModalButton',
                                    'value' => yii\helpers\Url::to(['/data-komisi/update', 'id' => $key])
                        ]);
                    }
                ]
            ],
        ],
    ]);
    ?>


</div>
