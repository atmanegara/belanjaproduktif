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

    <?= DetailView::widget([
        'panel'=>[
            'heading'=>"DATA PENGGUNA",
            'type'=>DetailView::TYPE_PRIMARY
            ],
        'buttons1'=>false,
        'model' => $dataReg,
        'attributes' => [
            'no_reg',
            'nik',
        ],
    ]) ?>

 

</div>
