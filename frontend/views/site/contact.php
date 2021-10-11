<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>

    <div id="page-container">
     <!-- BEGIN #page-header -->
        <div id="page-header" class="section-container page-header-container bg-black">
            <!-- BEGIN page-header-cover -->
            <div class="page-header-cover">
                <img src="<?=Yii::getAlias('@web')?>/color-admin/assets/img/cover/cover-15.jpg" alt="" />
            </div>
            <!-- END page-header-cover -->
            <!-- BEGIN container -->
            <div class="container">
                <h1 class="page-header"><b>Hubungi</b> Kami</h1>
            </div>
            <!-- END container -->
        </div>
        <!-- BEGIN #page-header -->
        
        <!-- BEGIN #product -->
        <div id="product" class="section-container p-t-20">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN breadcrumb -->
                <ul class="breadcrumb m-b-10 f-s-12">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Support</a></li>
                    <li class="active">Contact Us</li>
                </ul>
                <!-- END breadcrumb -->
                <!-- BEGIN row -->
                <div class="row row-space-30">
                    <!-- BEGIN col-8 -->
                    <div class="col-md-8">
                        <h4 class="m-t-0">Form Kontak</h4>
                        <p class="m-b-30 f-s-13">
                           Hubungi kami jika ada kritik dan saran yang membangun, demi kemajuan kita bersama
                        </p>
                        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'subject') ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
                    </div>
                    <!-- END col-8 -->
                    <!-- BEGIN col-4 -->
                    <div class="col-md-4">
                        <h4 class="m-t-0">Kontak Kami</h4>
                        <div class="embed-responsive embed-responsive-16by9 m-b-15">
             <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3324.8564318871286!2d114.8604933424966!3d-3.448268885135071!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de681c05688fd3b%3A0xf09df82fedc6cebe!2sBelanja%20Produktif!5e0!3m2!1sid!2sid!4v1593467031056!5m2!1sid!2sid" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>            </div>
                        <div><b><?=$dataTentangKami['nama_cv']?></b></div>
                        <p class="m-b-15">
                            <?=$dataTentangKami['alamat_cv']?><br />
                              <u>NO. SIUP</u> : <?=$dataTentangKami['no_siup']?><br />
                              <u>Telp. Kantor</u>      : <?=$dataTentangKami['telp_cv']?>
                        </p>
                        <div><b>Telpon Marketing / Email</b></div>
                        <p class="m-b-15">
                            <u>Email</u> :    <a href="mailto:<?=$dataTentangKami['email']?>" class="text-inverse"><?=$dataTentangKami['email']?></a><br />
                        <u> Admin</u> : <?=$dataTentangKami['telp_admin']?><br />
                         <u>Marketing</u> : <?=$dataTentangKami['telp_marketting']?><br />
                         <u>Info Rekening</u> :<br /> <?=$dataTentangKami['kontak_lainnya']?>
                        </p>
                       
                    </div>
                    <!-- END col-4 -->
                </div>
                <!-- END row -->
            </div>
            <!-- END row -->
        </div>
        <!-- END #product -->

</div>
