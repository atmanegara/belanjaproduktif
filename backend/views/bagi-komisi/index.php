<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\web\JsExpression;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\RiwayatBagiKomisiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Riwayat Bagi Komisis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="riwayat-bagi-komisi-index">
<div class="note note-warning note-with-left-icon m-b-15">
								<div class="note-icon"><i class="fa fa-lightbulb"></i></div>
								<div class="note-content text-left">
									<h4><b>Informasi!</b></h4>
									<p>
										Jika ada kesalahan membagi hasil, hapus terlebih dulu dan buat baru lagi
									</p>
								</div>
							</div>
  <p>
        <?= Html::button('Tambah baru',['class' => 'btn btn-success showModalButton',
            'value'=>Url::to( ['create'])]) ?>
    </p>


    <?php   $url = \yii\helpers\Url::to(['/data-agen/agen-list']);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showPageSummary'=>true,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

          //  'id',
            //'id_user',
           [
               'header'=>'Agen Yang dituju',
               'attribute'=>'id_data_agen',
              'filter' => \kartik\select2\Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'id_data_agen',
                    'data' => backend\models\DataAgen::dropdownagenAll(),
                    'options' => [
                        'placeholder' => 'Pilih Agen..',
                    ],
                  'pluginOptions' => [
        'allowClear' => true,
        'minimumInputLength' => 3,
        'language' => [
            'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
        ], 'ajax' => [
            'url' => $url,
            'dataType' => 'json',
            'data' => new JsExpression('function(params) { return {q:params.term}; }')
        ],
        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
        'templateResult' => new JsExpression('function(eukom) { return eukom.text; }'),
        'templateSelection' => new JsExpression('function (eukom) { return eukom.text; }'),
    ],
                ]),
               'value'=>'dataAgen.nama_agen'
           ],
            'tgl_dibagi:date:Tanggal Dibagi',
          [
              'pageSummary'=>true,
               'header'=>'Nominal',
               'attribute'=>'nominal',
              'format'=>'decimal',
               'value'=>function($data){
               return $data['nominal'];
               }
           ],
                   'refSumberKomisi.ket_sumber',
            'keterangan:text:Catatan Informasi',
            //'tgljam_input',

             ['class' => 'kartik\grid\ActionColumn','width'=>'35%','template'=>'{viewx} {delete}',
                'buttons'=>[
//                    'view'=>function($url,$data,$key){
//                        $url = Url::to(['view','id'=>$key]);
//                        return Html::button('<span class="fas fa-eye" aria-hidden="true"></span>',['class'=>'btn btn-info showModalButton',
//                            'value'=> $url]);
//                    },
                      
                            'delete'=>function($url,$data,$key){
                        $url = Url::to(['delete','id'=>$key]);
                        return Html::a('<span class="fas fa-trash-alt" aria-hidden="true"></span>',$url,['class'=>'btn btn-danger',
                            'data'=> [
                                'method'=>'POST',
                                'confirm'=>'Apakah anda yakin hapus item ini?'
                            ]]);
                    },
                           
                ]],
        ],
    ]); ?>


</div>
