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

<?php $form = \kartik\form\ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]); ?>
<div class="row row-space-10">
    <div class='col-md-3'>

<?= $form->field($model, 'no_invoice')->textInput(['disabled' => true]) ?>

    </div>
    <div class='col-md-3'>
        <?php
        echo Html::label('ID AGEN');
        echo Html::textInput('id_agen', $modelDataAgen['id_agen'], ['class' => 'form-control', 'disabled' => true]);
        ?>
    </div>
    <div class='col-md-3'>
        <?php
        echo Html::label('NAMA');
        echo Html::textInput('nama_agen', $modelDataAgen['nama_agen'], ['class' => 'form-control', 'disabled' => true]);
        ?>	</div>
    <div class='col-md-3'>
        <?php
        echo Html::label('AGEN');
        echo Html::textInput('id_agen', RefAgen::findOne($modelDataAgen['id_ref_agen'])->nama_agen, ['class' => 'form-control', 'disabled' => true]);
        ?>	
    </div>
</div>
<div class='row row-space-10'>

<?= $form->field($model, 'nominal')->label('Nominal')->textInput(['disabled' => true]) ?>
</div>

</div>

<div class='row row-space-10'>


    <div class='col-md-8'>
<?= $form->field($model, 'id_status_pembayaran')->label('Status Verifikasi')->dropDownList($modelStatusPembayaran); ?>

    </div>
</div>

</div>


<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

</div>



<?php \kartik\form\ActiveForm::end(); ?>

</div>
