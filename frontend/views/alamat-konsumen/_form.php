<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AlamatKonsumen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alamat-konsumen-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>
 <?= $form->field($model, 'ini')->label('Alamat Utama')->dropDownList([ 'Y' => 'Ya', 'N' => 'Tidak', ], ['prompt' => 'Pilih Status Alamat..']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
