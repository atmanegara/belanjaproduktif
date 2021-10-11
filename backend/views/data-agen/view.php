<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use kartik\grid\GridViewAsset;
use yii\bootstrap4\Button;

/* @var $this yii\web\View */
/* @var $model backend\models\DataAgen */

$this->title = 'Halaman View';
$this->params['breadcrumbs'][] = ['label' => 'Data Agens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="data-agen-view">

  <p>
      
           <?php
           if(in_array(Yii::$app->user->identity->role_id,['1'])){
               $urlindex='index';
           }else{
               $urlindex='index-agen';
           }
           echo Html::a('<i class="fa fa-backward"></i> Kembali', [$urlindex], ['class' => 'btn btn-default']) ?>
 
        <?php
        $url = ['/registrasi-agen/kirim', 'no_acak' => $no_acak];
        echo \yii\bootstrap4\Html::button('Kirim', ['class' => 'btn btn-primary showModalButton',
            'value' => Url::to($url)]);
        ?>
        <?php
        $url = Url::to(['preview-formulir-agen', 'no_acak' => $no_acak]);
        echo Html::a('Cetak Formulir', $url, [
//            'onClick' =>
//            "window.open('" . $url . "',
//                         'newwindow',
//                         'width=1000,height=500,top=10,left=100');
//              return false;"
            'class' => 'btn btn-md btn-warning']);
        ;
        ?>
     
        <?= Html::button('Buat Toko Baru', ['class' => 'btn btn-success showModalButton',
            'value'=> yii\helpers\Url::to( ['/data-toko/create'])]) ?>
    </p>
        <?php
        switch ($modelRegistrasi['id_ref_proses_pendaftaran']) {
            case 2:

                $html = '<div class="alert alert-success fade show m-b-10">
							DATA ANDA SUDAH TERVERIFIKASI
						</div>';
                break;
            case 3:
                $html = '<div class="alert alert-warning fade show m-b-10">
							DATA ANDA TERTUNDA , SILAHKAN CEK HASIL VERIFIKASI ADMIN BP DIS  <a href="#" class="alert-link">[ DISINI ] </a>
						</div>';

                break;
            default:
                $html = '<div class="alert alert-info fade show m-b-10">
			DATA PRIBADI SUDAH DI ISI, SELANJUTNYA ISI DATA REKENING, DATA WARIS, DAN UPLOAD BERKAS
						</div>';
                break;
        }
        echo $html;
        ?>
    </p>
    <div class="panel panel-success" data-sortable-id="form-stuff-1">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            Halaman View
        </div>
        <div class="panel-body">
            <div class='row row-space-10'>
                <div class='col-md-4'>
                    <?= \yii\bootstrap4\Html::img(Yii::getAlias('@sourcePathImg') . '/' . $model['filename'], ['width' => '90px', 'height' => '90px']) ?>
                </div>
                <div class='col-md-8'>
                    <?=
                    \yii\widgets\DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id_agen',
                            'nik',
                            'nama_agen', 'alamat'
//                            ['label' => 'Kecamatan',
//                                'value' => function($model) {
//                                    return $model->kecamatanDomisili->nama;
//                                }
//                            ]
                        ]
                    ])
                    ?>

                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class=" btn-group pull-right">
                <?= Html::button('Tambah Baru', ['class' => 'btn btn-success showModalButton',
                    'value' => yii\helpers\Url::to(['/data-agen-detail/create'])])
                ?>
            </div>
            <h4 class="panel-title">Data Rekening</h4>
        </div>
        <div class="panel-body">
            <?=
            GridView::widget([
                'dataProvider' => $dataProviderRekening,
                // 'filterModel' => $searchModel,
                'columns' => [
                //    ['class' => 'kartik\grid\SerialColumn', 'width' => '2%'],
                     [
                        'header' => 'status',
                        'width' => '2%',
                         'format'=>'raw',
                        'value' => function($data) {
                            return $data['aktif']=='Y' ? "<span class='label label-success'>AKTIF</span>" : "<span class='label label-danger'>TIDAK AKTIF</span>";
                        }
                    ],
                    [
                        'attribute' => 'id_ref_bank',
                        'width' => '2%',
                        'value' => function($data) {
                            return \backend\models\RefBank::findOne($data['id_ref_bank'])->nm_bank;
                        }
                    ],
                    [
                        'attribute' => 'no_rek',
                        'width' => '2%',
                    ],
                    ['class' => 'kartik\grid\ActionColumn', 'width' => '5%', 'template' => '{update} {delete}',
                        'buttons' => [
//                            'view' => function($url, $data, $key) {
//                                $url = \yii\helpers\Url::to(['/data-agen-detail/view', 'id' => $key]);
//                                return Html::button('<span class="fas fa-eye" aria-hidden="true"></span>', ['class' => 'btn btn-info showModalButton',
//                                            'value' => $url]);
//                            },
                            'update' => function($url, $data, $key) {
                                $url = \yii\helpers\Url::to(['/data-agen-detail/update', 'id' => $key]);
                                return Html::button('<span class="fas fa-pencil-alt" aria-hidden="true"></span>', ['class' => 'btn btn-warning showModalButton',
                                            'value' => $url]);
                            },
                            'delete' => function($url, $data, $key) {
                                $url = \yii\helpers\Url::to(['/data-agen-detail/delete', 'id' => $key]);
                                return Html::a('<span class="fas fa-trash-alt" aria-hidden="true"></span>', $url, ['class' => 'btn btn-danger',
                                            'data' => [
                                                'method' => 'POST',
                                                'confirm' => 'Apakah anda yakin hapus item ini?'
                                ]]);
                            },
                        ]],
                ],
            ]);
            ?>
        </div>
    </div>

<?php
$role_id = Yii::$app->user->identity->role_id;
if (in_array($role_id, ['1', '2'])) {
    ?>
        <div class="panel panel-warning">
            <div class="panel-heading">
                <div class=" btn-group pull-right">
    <?= Html::button('Tambah Baru', ['class' => 'btn btn-success showModalButton',
        'value' => yii\helpers\Url::to(['/data-toko/create'])])
    ?>
                </div>
                <h4 class="panel-title">Data Toko</h4>
            </div>
            <div class="panel-body">
                <?=
                GridView::widget([
                    'dataProvider' => $dataProviderToko,
                    // 'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'kartik\grid\SerialColumn', 'width' => '2%'],
                        //     'id',
                        //      'id_data_agen',
                        [
                            'attribute' => 'no_toko',
                            'width' => '2%',
                        ],
                        [
                            'attribute' => 'nama_toko',
                            'width' => '2%',
                        ],
                        [
                            'attribute' => 'alamat',
                            'width' => '2%',
                        ],
//            'id_kabupaten',
                        //'id_kelurahan',
                        //'id_kecamatan',
                        //'telp',
                        [
                            'attribute' => 'aktif',
                            'format' => 'raw',
                            'width' => '2%',
                            'value' => function($data) {
                                return $data['aktif'] == 'Y' ? "<span class='label label-success'>BUKA</span>" : "<span class='label label-warning'>TUTUP</span>";
                            }
                        ],
                        ['class' => 'kartik\grid\ActionColumn', 'width' => '5%', 'template' => '{view} {update} {delete}',
                            'buttons' => [
                                'view' => function($url, $data, $key) {
                                    $url = \yii\helpers\Url::to(['/data-toko/view', 'id' => $key]);
                                    return Html::button('<span class="fas fa-eye" aria-hidden="true"></span>', ['class' => 'btn btn-info showModalButton',
                                                'value' => $url]);
                                },
                                'update' => function($url, $data, $key) {
                                    $url = \yii\helpers\Url::to(['/data-toko/update', 'id' => $key]);
                                    return Html::button('<span class="fas fa-pencil-alt" aria-hidden="true"></span>', ['class' => 'btn btn-warning showModalButton',
                                                'value' => $url]);
                                },
                                'delete' => function($url, $data, $key) {
                                    $url = \yii\helpers\Url::to(['/data-toko/delete', 'id' => $key]);
                                    return Html::a('<span class="fas fa-trash-alt" aria-hidden="true"></span>', $url, ['class' => 'btn btn-danger',
                                                'data' => [
                                                    'method' => 'POST',
                                                    'confirm' => 'Apakah anda yakin hapus item ini?'
                                    ]]);
                                },
                            ]],
                    ],
                ]);
                ?>
            </div>
        </div>
            <?php } ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class=" btn-group pull-right">
    <?=
    Html::button('Tambah Waris', ['class' => 'btn  btn-default showModalButton',
        'value' => Url::to(['/data-agen-waris/create', 'id_data_agen' => $id_data_agen, 'no_acak' => $no_acak])
    ])
    ?>
            </div>
            <h4 class="panel-title">Data Waris Agen</h4>
        </div>
        <div class="panel-body">
<?=
GridView::widget([
    'dataProvider' => $modelAgenWaris,
    'columns' => [
        'nama_waris',
        'nope_waris',
        [
            'attribute' => 'jns_bank',

        ],
        'atas_nama_bank', 'norek_bank',
         ['class' => 'kartik\grid\ActionColumn', 'width' => '15%', 'template' => '{update} {delete}',
                            'buttons' => [
                               
                                'update' => function($url, $data, $key) {
                                    $url = \yii\helpers\Url::to(['/data-agen-waris/update', 'id' => $key]);
                                    return Html::button('<span class="fas fa-pencil-alt" aria-hidden="true"></span>', ['class' => 'btn btn-warning showModalButton',
                                                'value' => $url]);
                                },
                                'delete' => function($url, $data, $key) {
                                    $url = \yii\helpers\Url::to(['/data-agen-waris/delete', 'id' => $key]);
                                    return Html::a('<span class="fas fa-trash-alt" aria-hidden="true"></span>', $url, ['class' => 'btn btn-danger',
                                                'data' => [
                                                    'method' => 'POST',
                                                    'confirm' => 'Apakah anda yakin hapus item ini?'
                                    ]]);
                                },
                            ]],
    ]
])
?>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class=" btn-group pull-right">

            </div>
            <h4 class="panel-title">Berkas Agen</h4>
        </div>
        <div class="panel-body">
<?=
GridView::widget([
    'dataProvider' => $modelBerkasAgen,
    'columns' => [
        [
            'width' => '5px',
            'header'=>'Dokumen/Berkas',
            'attribute' => 'nama_dok'
        ],
        [
            'width' => '5px',
            'attribute' => 'filename',
            'format' => 'raw',
// 		            'value'=>function($data){
// 		            }
        ],
        ['class' => 'kartik\grid\ActionColumn',
            'width' => '5px',
            'template' => '{view} {delete}',
            'buttons' => [
                'view' => function($url, $data)use($id_data_agen, $no_acak) {
                    if ($data['filename']) {
                        $url = Url::to(Yii::getAlias('@sourcePathImg/') . $data['filename']);

                        return Html::a('Tampil Dokumen', $url, [
                                    'class' => 'btn btn-md btn-info',
                                    'onClick' =>
                                    "window.open('" . $url . "',
                         'newwindow',
                         'width=300,height=250');
              return false;"
                        ]);
                    } else {

                        return Html::button('Upload Berkas', ['class' => 'btn  btn-default showModalButton',
                                    'title' => 'Upload',
                                    'value' => Url::to(['/berkas-agen/create', 'id_data_agen' => $id_data_agen, 'no_acak' => $no_acak, 'id_ref_jenis_dok' => $data['id_ref_jenis_dok']])
                        ]);
                    }
                },
                'delete' => function($url, $data, $key) {
                    $url = ['/berkas-agen/delete', 'id' => $data['id']];
                    return \yii\bootstrap\Html::a('<span class="fas fa-trash-alt" aria-hidden="true"></span>', $url, [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'method' => 'post',
                                    'confirm' => 'Are you sure to delete this item?'
                                ]
                    ]);
                }
            ]
        ]
    ]
])
?>
        </div>
    </div>

  <?php
        $url = ['/registrasi-agen/kirim', 'no_acak' => $no_acak];
        echo \yii\bootstrap4\Html::button('Simpan', ['class' => 'btn btn-primary showModalButton',
            'value' => Url::to($url)]);
        ?>

</div>
