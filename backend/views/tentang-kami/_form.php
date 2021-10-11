<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TentangKami */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tentang-kami-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class='row row-space-10'>
        <div class='col-md-4'>
    <?= $form->field($model, 'no_siup')->textInput(['maxlength' => true]) ?>
            
        </div>
        <div class='col-md-4'>

    <?= $form->field($model, 'nama_cv')->textInput(['maxlength' => true]) ?>
            
        </div>
           <div class='col-md-4'>

     <?= $form->field($model, 'telp_cv')->textInput(['maxlength' => true]) ?>
           
        </div>
    </div>
    
<div class='row row-space-10'>
        <div class='col-md-4'>
    <?= $form->field($model, 'telp_admin')->textInput(['maxlength' => true]) ?>
            
        </div>
        <div class='col-md-4'>

    <?= $form->field($model, 'telp_marketting')->textInput(['maxlength' => true]) ?>
            
        </div>
           <div class='col-md-4'>

     <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
           
        </div>
    </div>
    
    <div class='row row-space-10'>
        <div class="col-md-6">
    <?= $form->field($model, 'alamat_cv')->textarea() ?>
            
        </div>
        <div class="col-md-6">
            
    <?= $form->field($model, 'kontak_lainnya')->textarea(['maxlength' => true]) ?>
        </div>
    </div>




    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
