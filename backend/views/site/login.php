<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


?>


<!-- begin login -->
<div class="login login-with-news-feed" >
	<!-- begin login -->
	
		<!-- begin news-feed -->
		<div class="news-feed">
			<div class="news-image" style="background-image: url(<?= Yii::getAlias('@web').'/gambar' ?>/logo-login.jpg)"></div>
			<div class="news-caption">
				<h4 class="caption-title"><b>Belanja</b> Produktif App</h4>
				<p>
					e-commerce banua
				</p>
			</div>
		</div>
		<!-- end news-feed -->
		<!-- begin right-content -->
		<div class="right-content">
			<!-- begin login-header -->
			<div class="login-header">
                            <div class="brand" style="text-align:center">
					<b>Belanja</b> Produktif
					<small>Belanja bulanan bisa Umrah</small>
				</div>
				<div class="icon">
					<i class="fa fa-sign-in"></i>
				</div>
			</div>
			<!-- end login-header -->
			<!-- begin login-content -->
			<div class="login-content">
				
    <?php 
    

    $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"form-group m-b-15\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->label(false)->textInput(['autofocus' => true,'class'=>'form-control form-control-lg',
            'placeholder'=>"Username",]) ?>
                            <div class="form-group">
        <?= $form->field($model, 'password')->label(false)->passwordInput([
            'placeholder'=>"Password",
            'class'=>'form-control form-control-lg','data'=>[
                'toggle'=>'password',
                'placement'=>'after',
                'message'=>"Show/hide password"
            ]]) ?>
                            </div>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"checkbox checkbox-css m-b-30\">{input} {label}</div>\n<div class=\"col-lg-12\">{error}</div>",
        ]) ?>

        <div class="login-buttons">
                 <?= Html::submitButton('Login', ['class' => 'btn btn-success btn-block btn-lg', 'name' => 'login-button']) ?>
         </div>
<div class="m-t-20 m-b-40 p-b-40 text-inverse">
    Anda bukan anggota? Click <a href="<?= yii\helpers\Url::to(Yii::getAlias('@admin_frontend').'/web/registrasi-agen/create') ?>" class="text-success">disini</a> untuk registrasi.
                            <p>
                            Jika anda lupa password hubungi pihak admin BP
                                
                            </p>
                        </div>
                            
                               <ul class="login-bg-list clearfix">
            <li >
                <a href="<?= yii\helpers\Url::to(Yii::getAlias('@admin_frontend').'/web') ?>" data-click="change-bg" data-img="../assets/img/login-bg/login-bg-17.jpg" style="background-image: url(<?= Yii::getAlias('@web').'/gambar' ?>/logo-login.jpg)"></a></li>
           </ul>
               
    <?php ActiveForm::end(); ?>

   
			</div>
			<!-- end login-content -->
		</div>
		<!-- end right-container -->
	

        
	<!-- end login -->
</div>
<!-- end login -->