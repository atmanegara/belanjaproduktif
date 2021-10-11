<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\RegistrasiAgen */

$this->title = 'Registrasi Agen';
$this->params['breadcrumbs'][] = ['label' => 'Registrasi Agens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registrasi-agen-create">
     	<div class='container'>
	    <!-- BEGIN #my-account -->
        <div id="about-us-cover" class="section-container">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN breadcrumb -->
                <ul class="breadcrumb m-b-10 f-s-12">
                    <li><a href="#">Home</a></li>
                    <li class="active">Registrasi Agen</li>
                </ul>
                <!-- END breadcrumb -->
                <!-- BEGIN account-container -->
                <div class="account-container">
                    <!-- BEGIN account-sidebar -->
                    <div class="account-sidebar">
                        <div class="account-sidebar-cover">
                            <img src="<?= Yii::getAlias('@web') ?>/color-admin/assets/img/cover/cover-14.jpg" alt="" />
                        </div>
                        <div class="account-sidebar-content">
                            <h4>Akun Kamu</h4>
                            <p>
                               Pastikan semua data sudah benar sesuai KTP
                            </p>
                            
                        </div>
                    </div>
                    <!-- END account-sidebar -->
                    <!-- BEGIN account-body -->
                    <div class="account-body">
                        <!-- BEGIN row -->
                        <?= $this->render('_form', [
        'model' => $model,
                            'modelKabupaten'=>$modelKabupaten,
                              'modelKecamatan'=>$modelKecamatan,
'modelKelurahan'=>$modelKelurahan,
//        'modelRefKelurahan'=>$modelRefKelurahan,
//        'modelRefKecamatan'=>$modelRefKecamatan,
        'modelRefAgen'=>$modelRefAgen
    ]) ?>
                        <!-- END row -->
                    </div>
                    <!-- END account-body -->
                </div>
                <!-- END account-container -->
            </div>
            <!-- END container -->
        </div>
        <!-- END #about-us-cover -->
        

   
</div>
</div>
