<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\RegistrasiAgen */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Registrasi Agens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="registrasi-agen-view">



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'no_reg',
            'no_acak',
            'nik',
            'nama',
            'alamat:ntext',
            'rt_rw',
            'id_ref_kelurahan',
            'id_ref_kecamatan',
            'nope',
            'email:email',
            'id_ref_agen',
            'id_ref_proses_pendaftaran',
            'setuju',
        ],
    ]) ?>

</div>
