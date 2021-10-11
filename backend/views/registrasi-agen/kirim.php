<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model backend\models\RegistrasiAgen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registrasi-agen-form">
<?=
DetailView::widget([
    'model'=>$model,
    'attributes'=>[
        'no_reg','nik','nama','alamat','nope'
    ]
])
?>
    <?php $form = ActiveForm::begin(); ?>
<div class='row space-row-10'>
	<div class='col-md-6'>
   <?= $form->field($model, 'no_reg')->label(false)->hiddenInput(['disabled' => true]) ?>

	
	</div>
<div class='col-md-6'>
    <?= $form->field($model, 'nik')->label(false)->hiddenInput(['disabled' => true]) ?>
	
	</div>
</div>
 

   <div class="note note-secondary m-b-15">
				<?=$persetujuan['persetujuan']?>
				</div>
    <?= $form->field($model, 'setuju')->dropDownList([ 'Y' => 'Setuju', 'N' => 'Tidak', ], [
        'value'=>'0',
        'prompt' => 'Pilih...','required'=>"true"]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
