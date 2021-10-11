<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use kartik\grid\GridViewAsset;

/* @var $this yii\web\View */
/* @var $model backend\models\DataAgen */

$this->title = 'Halaman View';
$this->params['breadcrumbs'][] = ['label' => 'Data Agens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="data-agen-view">

    <p>
     
    </p>
<div class="panel panel-success" data-sortable-id="form-stuff-1">
                        <!-- begin panel-heading -->
                        <div class="panel-heading">
                        Halaman View
                        </div>
                          <div class="panel-body">
                          <?=
\yii\widgets\DetailView::widget([
    'model'=>$model,
    'attributes'=>[
        'id_agen',
        'nik',
        ['label'=>'Kecamatan',
            'value'=>function($model){
                    return $model->refKecamatanDomisili->nm_kecamatan;
            }
        ]
    ]
])

?>
                          </div>
                        </div>
<div class="panel panel-default">
<div class="panel-heading">
		<div class=" btn-group pull-right">
			<?=Html::button('Tambah Waris',['class'=>'btn  btn-default showModalButton',
			    'value'=>Url::to(['/data-agen-waris/create','id_data_agen'=>$id_data_agen])
			]) ?>
		</div>
		  <h4 class="panel-title">Data Waris Agen</h4>
	</div>
<div class="panel-body">
<?=GridView::widget([
    'dataProvider'=>$modelAgenWaris,
    'columns'=>[
       'nama_waris',
        'nope_waris',
        [
            'attribute'=>'jns_bank',
//             'value'=>function($model){
//                 return $model->
//             }
        ],
        'atas_nama_bank','norek_bank'
        ]
]) ?>
</div>
</div>
<div class="panel panel-primary">
	<div class="panel-heading">
		<div class=" btn-group pull-right">
			<?=Html::button('Upload Berkas',['class'=>'btn  btn-default showModalButton',
			    'value'=>Url::to(['/berkas-agen/create','id_data_agen'=>$id_data_agen,'no_acak'=>$no_acak])
			]) ?>
		</div>
		  <h4 class="panel-title">Berkas Agen</h4>
	</div>
	<div class="panel-body">
		<?=
		GridView::widget([
		    'dataProvider'=>$modelBerkasAgen,
		    'columns'=>[
		        [
		            'attribute'=>'id_ref_jns_dok',
		            'value'=>function($data){
		            return $data->refJenisDok->nama_dok;
		            }
		        ],
		        [
		            'attribute'=>'filename',
		            'format'=>'raw',
// 		            'value'=>function($data){
		        
// 		            }
		        ],
		        ['class'=>'kartik\grid\ActionColumn',
		            'template'=>'{view} {delete}',
		            'buttons'=>[
		                'view'=>function($url,$data){
		                $pisah = explode('.',$data['filename']);
		                if($pisah[1]=='pdf'){
		                    $html=yii\bootstrap\Html::button('Tampil Dokumen',[
		                        'title'=>'Tampil Dokumen Persyaratan',
		                        'value'=> Url::to(['tampil-dok','id'=>$data['id']]),
		                        'class'=>'btn btn-info showModalButton'
		                    ]);
		                }else{
		                    $html= Html::a('Tampil Dokumen',Yii::getAlias('@sourcePathImg').'/'.$data['filename'],['target'=>"_blank",'class'=>'btn btn-info']);
		                }
		                return $html;
		                }
		            ]
		        ]
		    ]
		])
		?>
	</div>
</div>
	
</div>
