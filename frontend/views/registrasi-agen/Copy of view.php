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


    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'no_reg',
            'nik',
            'nama',
            'alamat:ntext',
            'rt_rw',
            'id_ref_kelurahan',
            'id_ref_kecamatan',
            'nope',
            'id_ref_agen',
            'id_ref_proses_pendaftaran',
        ],
    ]) ?>

</div>
