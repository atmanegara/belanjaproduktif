<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\file\FileInput;
use backend\models\RefAgen;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\KonfirmasiTopup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="konfirmasi-topup-form">

    <?php $form = \kartik\form\ActiveForm::begin([ 'type' => ActiveForm::TYPE_VERTICAL]); ?>
<div class='panel panel-inverse'>
	<div class='panel-heading'>
		<h4 class='panel-title'>Konfirmasi</h4>
	</div>
	<div class='panel-body'>
	<div class='row row-space-10'>
	<div class='col-md-3'>
	
    <?= $form->field($model, 'no_invoice')->textInput(['disabled' => true]) ?>

    	</div>
	<div class='col-md-3'>
<?php
echo Html::label('ID AGEN');
echo Html::textInput('id_agen',$modelDataAgen['id_agen'],['class'=>'form-control','disabled' => true]);
?>
	</div>
	<div class='col-md-3'>
<?php
echo Html::label('NAMA');
echo Html::textInput('nama_agen',$modelDataAgen['nama_agen'],['class'=>'form-control','disabled' => true]);
?>	</div>
	<div class='col-md-3'>
<?php
echo Html::label('AGEN');
echo Html::textInput('id_agen',RefAgen::findOne($modelDataAgen['id_ref_agen'])->nama_agen,['class'=>'form-control','disabled' => true]);
?>	
        </div>
</div>
<div class='row row-space-10'>
	<div class='col-md-4'>
    <?= $form->field($model, 'from_bank')->dropDownList($modelRefBank,[
        'prompt'=>'Pilih Bank..','disabled' => true
    ]) ?>
	</div>
<div class='col-md-4'>
    <?= $form->field($model, 'nominal')->textInput(['disabled' => true]) ?>
	</div>
<div class='col-md-4'>
    <?= $form->field($model, 'tgl_transfer')->textInput(['type'=>'date','disabled' => true]) ?>

	</div>
</div>
    <div class="row row-space-10">
        <div class="col-md-8">
<?= \yii\bootstrap4\Html::img( Yii::getAlias('@sourcePathImg').'/'.$model->filename,[
    'width'=>'100%','height'=>'200px'
]
) ?>
        </div>
        <div class="col-md-4">
            <?php
             $url=Url::to(Yii::getAlias('@sourcePathImg/').$model->filename);
		                    echo Html::a('Perbesar',$url,[
		                        'class'=>'btn btn-md btn-info',
		                        'onClick'=>
		                        "window.open('".$url."',
                         'newwindow',
                         'width=300,height=250');
              return false;"
		                    ]);
            ?>
        </div>
</div>
           
            <div class='row row-space-10'>
        <div class="col-md-8">
                    <?= $form->field($model, 'ket')->label('Catatan Informasi Pembatalan (Max 160 Karakter)')->textarea([
                        'rows'=>'3'
                    ]) ?>
        </div>
            </div>
            
	</div>
	
	<div class='panel-footer'>
	<div class='row row-space-10'>
    <div class="form-group">
        <?= Html::submitButton('BATAL', ['class' => 'btn btn-danger']) ?>
    </div>

</div>
	</div>
</div>



    <?php \kartik\form\ActiveForm::end(); ?>

</div>
