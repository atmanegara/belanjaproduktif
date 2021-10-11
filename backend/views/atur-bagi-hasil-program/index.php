<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\AturBagiHasilProgramSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Atur Bagi Hasil Programs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atur-bagi-hasil-program-index">

     <h3>PERHITUNGAN KOMISI</h3>
<div class="note note-primary m-b-15">
					<div class="note-icon"><i class="fas fa-info"></i></div>
					<div class="note-content">
						<h4><b>Informasi!</b></h4>
						<p>
							Halaman ini untuk daftar komisi yang didapat agen memilih program
                                                </p>
                                                 <p>
        *) pada kolom Agen maksudnya adalah jika Agen A, dia dapat persen dari setiap item / seluruh transaksi, contoh , Agen Pasok akan dapat 5% setiap pembelian item barang dr semua transaksi
    </p>
					</div>
				</div>

    <p>
         <?= Html::button('Tambah Baru',['class' => 'btn btn-success showModalButton',
            'value'=> yii\helpers\Url::to( ['create'])]) ?>
        
    </p>
   

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           ['class' => 'kartik\grid\SerialColumn','width'=>'1%'],

        //    'id',
           ['attribute'=> 'id_ref_agen','header'=>'Agen',
               'width'=>'10%',
               'value'=>'refAgen.nama_agen'
           ],
             ['attribute'=> 'id_ref_program_agen','header'=>'Agen',
               'width'=>'10%',
               'value'=>'refProgramAgen.nama_program'
           ],
            ['attribute'=> 'nominal','header'=>"Dalam ",
               'width'=>'5%',
               'value'=>'nominal'
           ],

          ['class' => 'kartik\grid\ActionColumn','template'=>'{view} {update} {delete}','width'=>'5%',
                'buttons'=>[
                    'update'=>function($url,$data,$key){
                    return  Html::button('<span class="fas fa-pencil-alt" aria-hidden="true"></span>',['class' => 'btn btn-warning showModalButton',
            'value'=> yii\helpers\Url::to( ['update','id'=>$key])]);
                    },
                            ]
                ],
        ],
    ]); ?>


</div>
