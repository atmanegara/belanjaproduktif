<?php
use yii\bootstrap4\Html;
use yii\helpers\Url;
use kartik\form\ActiveForm;
?>

<div class="card card-primary">
    <div class="card-body">
        <?php $form = ActiveForm::begin() ?>
        <?= $form->field($model, 'totalbayar')->textInput() ?>
        <?= $form->field($model, 'totaltunai')->textInput() ?>
        <?= $form->field($model, 'totalkembali')->textInput() ?>
        <div class="form-group">
            <?= Html::submitButton('Simpan') ?>
        </div>
        <?php ActiveForm::end() ?>
    </div>
</div>
