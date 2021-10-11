<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\RegistrasiAgen */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Registrasi Agens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="registrasi-agen-view">
<div class="container">
    <p>
<div class="alert alert-success" role="alert">
    Selamat anda sudah berhasil melakukan registrasi, silahkan  login <?= \yii\bootstrap4\Html::a('Login','@admin_backend/web/site/login',['class'=>'btn btn-md btn-primary'])?>
</div>
    <?= Html::a('Print', yii\helpers\Url::to(['print-view','id'=>$model->id]), ['class'=>'btn btn-xs btn-warning']) ?>    
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
     //       'id',
            'no_reg',
            [
              'label'=>'USERNAME',
                'value'=>function($model){
                  $no_acak = $model['no_acak'];
                  $username = \common\models\User::find()->where(['no_acak'=>$no_acak])->one()->username;
                  return $username;
                }
            ],
          'nik',
      //      'nama',
    //        'alamat:ntext',
    //        'rt_rw',
    //        'id_ref_kelurahan',
    //        'id_ref_kecamatan',
            'nope:text:No WA',
            [
                'attribute'=>'id_ref_agen',
                'value'=>function($data){
                return $data->refAgen->nama_agen;
                }
            ],
            [
                'attribute'=>'id_ref_proses_pendaftaran',
                'value'=>function($data){
                return $data->refProsesPendaftaran->nama_proses;
                }
                ],
        ],
    ]) ?>
    <p>
        <b><u>Informasi Perusahaan</u></b>
    </p>
       <?= DetailView::widget([
        'model' => $modelTentangKami,
        'attributes' => [
            'nama_cv','telp_marketting','kontak_lainnya:text:No Rekening'
        ],
    ]) ?>
<p>
<i>* Pastikan no. telpon / WA anda aktif dan email anda valid, setiap informasi akan kita sampaikan melalui media telpon/email, harap simpan No Registrasi Ini</i>
</p>
</div>
</div>