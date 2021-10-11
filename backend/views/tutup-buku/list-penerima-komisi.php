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
 <h1 class="page-header">Halaman Daftar Penerima Komisi</h1>
     
 <p>
      <?= Html::a('Halaman Daftar Tutup Buku', ['index',], ['class' => 'btn btn-default']) ?>
 </p> 
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'type' => kartik\grid\GridView::TYPE_INFO,
            'heading' => 'Daftar Penerima Komisi'
        ],
        
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn', 'width' => '1%'],
          
           ['attribute'=>'no_acak','header'=>'No Tutup Buku'],
                      'id_agen:text:ID AGEN',
                      'nama_agen:text:Nama Agen',
            ]
    ]);
    ?>


</div>
