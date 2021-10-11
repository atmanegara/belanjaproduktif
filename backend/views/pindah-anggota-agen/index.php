<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use backend\models\RegistrasiAgen;
use backend\models\RefProsesPendaftaran;
use backend\models\ArsipRegistrasiAgen;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataAgenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Agens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-agen-index">

<div class="panel panel-primary">
		<div class='panel-heading'>
			<h4 class='panel-title'>Daftar Kategori Agen</h4>
		</div>
		<div class='panel-body'>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
     'responsiveWrap' => false,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn','width'=>"2%"],

          //  'id',
         'nama_agen',
            [
              'class'=> 'kartik\grid\ActionColumn',
                'template'=>'{agen}',
                'buttons'=>[
                    'agen'=>function($url,$data,$key){
        $url = ['agen','id_ref_agen'=>$key];
        return Html::a('Agen', $url, ['class'=>'btn btn-primary']);
                    }
                ]
            ],

        
        ],
    ]); ?>
		</div>
</div>



</div>
