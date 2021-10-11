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
        <div class='panel-heading'>
            <h4 class='panel-title'>Daftar Pribadi</h4>
        </div>
        <div class='panel-body'>
            <p>

                <?php
                //  var_dump($dataProvider->count);
                if (in_array(Yii::$app->user->identity->role_id, ['2', '3', '5', '4', '6'])) {
                    if ($dataProvider->count == '0') {

                        echo Html::button('<i class="fa fa-plus"></i> Buat baru', [
                            'class' => 'btn btn-success showModalButton',
                            'value' => Url::to(['create', 'no_acak' => $no_acak])
                        ]);
                    }
                }
                ?>
            </p>

            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'pjax' => true,
                'responsiveWrap' => false,
                'columns' => [
                    ['class' => 'kartik\grid\SerialColumn'],
                    [
                        'attribute' => 'filename',
                        'format' => "raw",
                        'value' => function($data) {
                            return Html::img(Yii::getAlias('@sourcePathImg') . '/' . $data['filename'], ['width' => '90px', 'height' => '90px']) . ''
                                    . '<br>' . yii\bootstrap4\Html::button('Ganti foto', ['class' => 'btn btn-md btn-warning fa fa-camera showModalButton', 'value' => Url::to(['/data-agen/reupload', 'id' => $data['id']])]);
                        }
                    ],
                    ['attribute' => 'id_agen'],
                    //  'id_ref_agen',
                    ['attribute' => 'nik'],
                    ['attribute' => 'nama_agen'],
                    ['attribute' => 'alamat'],
//                    [
//                        'header' => 'Status Anggota',
//                        'value' => function($data) {
//                            $no_acak = $data['no_acak'];
//                            $dataReg = RegistrasiAgen::find()->where(['no_acak' => $no_acak]);
//                            $nama_proses = '';
//                            if ($dataReg->exists()) {
//                                $proses = $dataReg->one();
//                                $id_ref_proses_pendaftaran = $proses['id_ref_proses_pendaftaran'];
//                                $prosespendafatran = RefProsesPendaftaran::find()->where(['id' => $id_ref_proses_pendaftaran])->one();
//                                $nama_proses = $prosespendafatran['nama_proses'];
//                            }
//                            return $nama_proses;
//                        }
//                    ],
                    ['class' => 'kartik\grid\ActionColumn', 'width' => "30%",
                        'template' => "{upload} {view} {kirim} {update} {delete} {formulir}",
                        'buttons' => [
                            'update' => function($url, $data, $key) {
                                $url = ['/data-agen/update', 'id' => $key];
                                return \yii\bootstrap4\Html::button('Update', ['class' => 'btn btn-warning showModalButton',
                                            'value' => Url::to($url)]);
                            },
                            'upload' => function($url, $data) {
                                $url = ['/berkas-agen/index', 'no_acak' => $data['no_acak']];
                                return \yii\bootstrap4\Html::a('Berkas', $url, ['class' => 'btn btn-default']);
                            },
                            'view' => function($url, $data) {
                                $url = ['/data-agen/view', 'no_acak' => $data['no_acak']];
                                return \yii\bootstrap4\Html::a('View', $url, ['class' => 'btn btn-info']);
                            },
                            'delete' => function($url, $data, $key) {
                                $role_id = Yii::$app->user->identity->role_id;
                                if (in_array($role_id, ['1'])) {
                                    $no_acak = $data['no_acak'];
                                    return Html::a('<span class="fa fa-trash" aria-hidden="true"></span> Hapus', Url::to(['delete-all', 'no_acak' => $no_acak]), ['class' => 'btn btn-danger btn-md',
                                                'data' => [
                                                    'confirm' => 'Anda Yakin Data Ini di hapus, semua riwayat agen akan terhapus permanen?',
                                                    'method' => 'post'
                                    ]]);
                                } else {
                                    return '';
                                }
                            },
                            'formulir' => function($url, $data) {
                                $no_acak = $data['no_acak'];


                                $url = Url::to(['preview-formulir-agen', 'no_acak' => $no_acak]);

                                return \yii\bootstrap4\Html::a('Formulir Agen', $url, ['class' => 'btn btn-primary ']);
                            }
                        ]
                    ],
                ],
            ]);
            ?>
        </div>
    </div>



</div>
