<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataSaldoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Saldos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-saldo-index">
    <h1 class="page-header">Halaman Daftar Saldo</h1>
    <div class="note note-primary m-b-15">
        <div class="note-icon"><i class="fas fa-info"></i></div>
        <div class="note-content">
            <h4><b>Informasi!</b></h4>
            <p>
                Halaman Daftar Saldo Agen
            </p>
        </div>
    </div>
<?php
if($cekBatal){
  echo yii\bootstrap4\Alert::widget([
      'options' => [
//          'close'
          'class' => 'alert-warning',
      ],
     'body' => 'ADA INVOICE YANG DIBATALKAN,CEK RIWAYAT SALDO',
  ]);
}
?>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-gradient-teal">
                <div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
                <div class="stats-content">
                    <div class="stats-title">DAFTAR PENGAJUAN SALDO</div>
                    <div class="stats-number"><?= $totalBelumKOnfirmasi ?></div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 100%;"></div>
                    </div>
                    <div class="stats-link">
                        <a href="<?php echo Url::to(['/konfirmasi-topup/detail']) ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
         <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-danger">
                <div class="stats-icon stats-icon-lg"><i class="fa fa-money-bill fa-fw"></i></div>
                <div class="stats-content">
                    <div class="stats-title">DAFTAR PEMBATALAN PENGAJUAN SALDO</div>
                    <div class="stats-number"><?= $totalBatalAgen ?></div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 100%;"></div>
                    </div>
                    <div class="stats-link">
                        <a href="<?php echo Url::to(['/konfirmasi-topup/detail-batal']) ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
<div class="col-lg-3 col-md-6">
			        <div class="widget widget-stats bg-gradient-blue">
			            <div class="stats-icon stats-icon-lg"><i class="fa fa-dollar-sign fa-fw"></i></div>
						<div class="stats-content">
							<div class="stats-title">NOMINAL</div>
                                                        <div class="stats-number"> <?= number_format($dataSaldo['nominal_awal'],0,',','.')?></div>
							<div class="stats-progress progress">
								<div class="progress-bar" style="width: 100%;"></div>
							</div>
							 <div class="stats-link">
                        <a href="<?php echo Url::to(['/konfirmasi-topup/detail']) ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                    </div>
						</div>
			        </div>
			    </div>
        <div class="col-lg-3 col-md-6">

        <div class="widget widget-stats bg-gradient-black">
			            <div class="stats-icon stats-icon-lg"><i class="fa fa-comment-alt fa-fw"></i></div>
			        	<div class="stats-content">
							<div class="stats-title">TOTAL TRANSAKSI BELANJA VIA SALDO  </div>
							<div class="stats-number"><?=$totalTransaksiBarangViaSaldo?></div>
							<div class="stats-progress progress">
								<div class="progress-bar" style="width: 100%;"></div>
							</div>
					 <div class="stats-link">
                        <a href="<?php echo Url::to(['transaksi-belanja-saldo', 'no_acak' => $no_acak]) ?>">View Riwayat <i class="fa fa-arrow-alt-circle-right"></i></a>
                    </div>
						</div>
			        </div>
        </div>
    </div>

    <p>
        <?php
        if (in_array(Yii::$app->user->identity->role_id, ['2', '3', '4'])) {
            echo Html::button('Top Up', ['class' => 'btn btn-lg btn-success showModalButton',
                'value' => Url::to(['/konfirmasi-topup/create'])
            ]);
        } else {
            echo Html::button('Top Up', ['class' => 'btn btn-lg btn-success showModalButton',
                'value' => Url::to(['/konfirmasi-topup/create-saldo'])
            ]);
        }
        ?>
        <?php if (in_array(Yii::$app->user->identity->role_id, ['2', '3', '4','6'])) { ?>
            <?=
            Html::button('Pencairan Saldo', ['class' => 'btn btn-lg btn-primary showModalButton',
                'value' => \yii\helpers\Url::to(['transfer-kebank', 'no_acak' => $no_acak])
            ])
            ?>
                   <?=
            Html::button('Pencairan Saldo ke Agen Lainnya', ['class' => 'btn btn-lg btn-warning showModalButton',
                'value' => \yii\helpers\Url::to(['transfer-keagen', 'no_acak' => $no_acak])
            ])
            ?>
            <?= Html::a('Riwayat Saldo', \yii\helpers\Url::to(['/transaksi-saldo', 'no_acak' => $no_acak]), ['class' => 'btn btn-lg btn-info ']) ?>
<?php } ?>
    </p>




</div>
