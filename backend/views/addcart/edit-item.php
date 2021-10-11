<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Addcart */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="addcart-form">

    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'qty')->textInput(['type'=>'number','min'=>'1','max'=>'999999']) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
