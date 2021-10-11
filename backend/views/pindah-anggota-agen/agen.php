<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use backend\models\RegistrasiAgen;
use backend\models\RefProsesPendaftaran;
use backend\models\ArsipRegistrasiAgen;
use kartik\select2\Select2;
use kartik\dialog\Dialog;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataAgenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Agens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-agen-index">

<div class="panel panel-primary">
   
		<div class='panel-heading'>
			<h4 class='panel-title'>Daftar Agen</h4>
		</div>
		<div class='panel-body'>
                 
    <?= GridView::widget([
        'pjax'=>true,
        'id'=>'tabel-agen',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
     'responsiveWrap' => false,
        'columns' => [
            ['class'=> 'kartik\grid\CheckboxColumn','width'=>"1%"],
            ['class' => 'kartik\grid\SerialColumn','width'=>"2%"],
[
    'header'=>'Agen Referensi','width'=>"1%",
    'attribute'=>'no_acak_ref',
    'filter'=> \backend\models\DataAgen::dropdownagenAllNoAcak(),
    'value'=>function($data){
        $dataAgen = \backend\models\DataAgen::find()->where(['no_acak'=>$data['no_acak_ref']]);
        return $dataAgen->exists() ? $dataAgen->one()->nama_agen : '-' ;
    }
],
          //  'id',
           ['attribute'=> 'id_agen','width'=>'5%'],
          //  'id_ref_agen',
           ['attribute'=>'nama_agen','width'=>'10%'],
           ['attribute'=> 'nik','width'=>"5%"],
        [
            'header'=>'Status Anggota','width'=>"5%",
            'format'=>'raw',
            'value'=>function($data){
                $no_acak = $data['no_acak'];
                $dataReg = RegistrasiAgen::find()->where(['no_acak'=>$no_acak]);
                if($dataReg->exists()){
               $dataReg = $dataReg->one();
                    return RefProsesPendaftaran::find()->where(['id'=>$dataReg['id_ref_proses_pendaftaran']])->one()->nama_proses;
                }else{
                    return '-';
                }
            }
        ],
//[
//    'class'=> 'kartik\grid\ActionColumn',
//    'template'=>'{anggota}',
//    'buttons'=>[
//        'anggota'=>function($url,$data,$key){
//              $url = ['anggota-agen','no_acak'=>$data['no_acak']];
//        return Html::a('Anggota Agen', $url, ['class'=>'btn btn-warning']);
//        }
//    ]
//]
        
        ],
    ]); ?>
		</div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-md-8">
                <p>
                      <label>Pilih Agen Yang dituju</label>
                   <?= Select2::widget([
    'name' => 'no_acak_agen',
                       'id'=>'no_acak_agen',
 //   'attribute' => 'no_acak_agen',
    'data' => $dataAgen,
    'options' => ['placeholder' => 'Pilih Salah Satu Agen ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>
                </p>
                <p>
                        <?=Html::button('Pindah',['class'=>'btn btn-success','onClick'=>'pilih()'])?>
         
                </p>
              
            </div>
            
        </div>
     
    </div>
</div>



</div>
<?=
Dialog::widget([
    'libName' => 'krajeeDialog',
    'options' => [], // default options
])
?>
<script>
pilih=()=>{
    var no_acak_agen = $("#no_acak_agen").val();
     var keys = $('#tabel-agen').yiiGridView('getSelectedRows');

        if (keys == '') {
            krajeeDialog.alert('Tidak ada data yang dipilih !');
            return false;
        }
        
        $.post({
            url : "<?= Url::to(['pindah']) ?>",
            data : {
                no_acak_agen :no_acak_agen,
                selection : keys
            },
                    success:function(data){
                            if (data['message'] == true) {
                            $.pjax.reload('#pjax-tabel-agen');
                        }
//                        } else {
//                            krajeeDialog.alert('Check Data');
//                        }
                    }
        })
}
</script>