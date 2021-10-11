<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DataAgen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-agen-form">

    <?php $form = ActiveForm::begin(); ?>
	

    <?= $form->field($model, 'id_ref_proses_pendaftaran')->dropDownList($modelRefProsesPendaftaran) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
