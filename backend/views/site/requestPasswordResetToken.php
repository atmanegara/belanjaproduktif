<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-cover">
	    <div class="login-cover-image" style="background-image: url(../assets/img/login-bg/login-bg-17.jpg)" data-id="login-cover-image"></div>
	    <div class="login-cover-bg"></div>
	</div>
  <!-- begin login -->

        <div class="login login-v2" data-pageload-addclass="animated fadeIn">
            <!-- begin brand -->
            <div class="login-header">
                <div class="brand" style="text-align:center">
                 <b>Belanja</b> Produktif
                    <small>Reset Password untuk lupa password</small>
                </div>
                
            </div>
            <!-- end brand -->
            <!-- begin login-content -->
            <div class="login-content">
                    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                <p>
                    Forgotten your password? Enter your email address below to begin the reset process.
                </p>
                <?= $form->field($model, 'email')->label('Alamat Email')->textInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
            </div>
        </div>
   
