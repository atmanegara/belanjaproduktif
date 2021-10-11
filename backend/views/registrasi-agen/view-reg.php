<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\RegistrasiAgen */

$this->title = false;
$this->params['breadcrumbs'][] = ['label' => 'Registrasi Agen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="registrasi-agen-view">
 <div class="note note-primary m-b-15">
					<div class="note-icon"><i class="fas fa-info"></i></div>
					<div class="note-content">
						<h4><b>Informasi!</b></h4>
						<p>
							ANGGOTA BARU MENDAPATKAN AKUN PENGGUNA UNTUK LOGIN KE APLIKASI BP DENGAN LINK http://belanjaproduktif.com/ ,
                                                        
                                                </p>
					</div>
				</div>

    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title">
                Informasi Akun
            </div>
        </div>
        <div class="panel-body">
            <div class="note note-success m-b-15">
								<div class="note-icon"><i class="fa fa-inbox"></i></div>
								<div class="note-content">
									<h4><b>INFORMASI!</b></h4>
									<p>
                                                                       Admin BP akan mengirimkan Username & Password ke nomor Whatsapp yang telah di daftarkan.
Apabila dalam 1x24 jam belum menerima konfirmasi dari Admin BP silahkan hubungi : 
CS : <?= backend\models\TentangKami::find()->one()->telp_marketting;?> <br>
									</p>
								</div>
							</div>
        </div>
    </div>
 
   <p>
   <?php // Html::a('Simpan data Akun',['/data-anggota/print-data','no_acak'=>$dataReg['no_acak']],['class'=>'btn btn-md btn-warning']) ?>
    </p>
</div>
