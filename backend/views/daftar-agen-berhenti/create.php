<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use kartik\grid\GridViewAsset;
use yii\bootstrap4\Button;

/* @var $this yii\web\View */
/* @var $model backend\models\DataAgen */

$this->title = 'Halaman View';
$this->params['breadcrumbs'][] = ['label' => 'Data Agens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="data-agen-view">

    <div class="panel panel-success" data-sortable-id="form-stuff-1">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            Halaman View
        </div>
        <div class="panel-body">
            <div class='row row-space-10'>
               
                <div class='col-md-12'>
                    <?=
                    \yii\widgets\DetailView::widget([
                        'model' => $modelAgen,
                        'attributes' => [
                            'id_agen',
                            'nik',
                            'nama_agen', 'alamat'

                        ]
                    ])
                    ?>

                </div>
            </div>
            <div class='row row-space-10'>
                <?php $form = kartik\form\ActiveForm::begin()?>
                <?= $form->field($model, 'id')->textInput(['value'=>$modelAgen['id']]) ?>
                <?= $form->field($model, 'tgl_berhenti')->textInput(['type'=>'date']) ?>
                <?= $form->field($model, 'alasan')->textInput() ?>
                <div class="form-group">
                    <?= Html::submitButton('Simpan',['class'=>"btn btn-md btn-danger"]); ?>
                </div>
                <?php $form->end() ?>
            </div>
        </div>
    </div>
   
    
    

</div>
