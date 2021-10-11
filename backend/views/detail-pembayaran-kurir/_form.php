<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DetailPembayaranKurir */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detail-pembayaran-kurir-form">
<div class="note note-secondary m-b-15">
								<h4><b>PERHATIAN!</b></h4>
								<p>
									Pastikan Kurir yang datang, sesuai dengan daftar yang tertera
								</p>
							</div>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'no_invoice')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'id_data_kurir')->dropDownList($modelKurir,[
        'prompt'=>'Pilih Kurir...'
    ]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
