<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\DataKomisi */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Data Komisis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="data-komisi-view">



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
         
             [
              'label'=>'id_data_agen','width'=>'10%',
                'format'=>'raw',
                'value'=>function($data){
                    $dataAgen = \backend\models\DataAgen::findOne($data['id_data_agen']);
                    $html = $dataAgen->refAgen->nama_agen .', '.$dataAgen->nik.', '.$dataAgen->nama_agen;
                    return $html;
                }
            ],
            'tgl_transaksi',
            'nominal',
            'ket',
        ],
    ]) ?>

</div>
