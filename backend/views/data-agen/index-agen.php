<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataAgenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Agens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-agen-index">

  <div class="row">
	<!-- begin col-2 -->
	<div class="col-lg-2 ui-sortable">
		<div><b class="text-inverse">Features</b></div>
                <p>
                <?= Html::img(Yii::getAlias('@sourcePathImg') . '/' . $model['filename'], ['width' => '90px', 'height' => '90px']);?>
                <p>
                <p>
                    <?=yii\bootstrap4\Html::button('Ganti foto',['class'=>'btn btn-md btn-warning fa fa-camera showModalButton','value'=>Url::to(['/data-agen/reupload','id'=>$model['id']])]);?>
                </p>
        </div>
        <div class="col-lg-10 ui-sortable">
            <div class="panel panel-inverse m-b-0">
                <div class="panel-heading ui-sortable-handle">
                    	<h4 class="panel-title">Summernote</h4>
                </div>
                <div class="panel-body ">
                    <?=    yii\widgets\DetailView::widget([
       'model'=>$model,
       'attributes'=>[
          
           ['attribute'=> 'id_agen'],
          //  'id_ref_agen',
           ['attribute'=> 'nik'],
           ['attribute'=>'nama_agen'],
           ['attribute'=>'alamat'],
       ]
   ])
            ?> 
                </div>
            </div>
            
        </div>
  </div>

  


</div>
