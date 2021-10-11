<?php
use yii\helpers\Url;
use yii\bootstrap4\Html;
?>


<!-- begin breadcrumb -->
<ol class="breadcrumb hidden-print pull-right">
	<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
	<li class="breadcrumb-item active">Invoice</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header hidden-print">Invoice <small>#<?=$no_invoice ?></small></h1>
<!-- end page-header -->

<!-- begin invoice -->
<div class="invoice">
	<!-- begin invoice-company -->
	<div class="invoice-company text-inverse f-w-600">
		<span class="pull-right hidden-print">
                    <?= Html::button('<i class="fa fa-file-pdf t-plus-1 text-danger fa-fw fa-lg"></i> Export as PDF', ['class'=>'btn btn-sm btn-white m-b-10 p-l-5',
                        'onClick'=>'window.print()'
                        ])?>
			<?= Html::button("<i class='fa fa-print t-plus-1 fa-fw fa-lg'></i> Konfirmasi Pembayaran",['class'=>'btn btn-sm btn-success m-b-10 p-l-5 showModalButton',
			    'value'=>Url::to(['konfirmasi-pembayaran/konfirmasi','no_acak'=>$no_acak,'no_invoice'=>$no_invoice]),
			    
			]) ?>
		</span>
		BELANJA PRODUKTIF 
		<p>
		<span class="text-inverse"> INVOICE #<?=$no_invoice ?></span>
		</p>
	</div>
	<!-- end invoice-company -->
<div class="invoice-header">
                    <div class="invoice-from">
                        <small>Dari </small>
                        <address class="m-t-5 m-b-5">
                            <strong class="text-inverse"><?=$cekAgenReg['no_reg']?>.</strong><br>
                            <?=$cekAgenReg['nik']?><br>
                        </address>
                    </div>
                    <div class="invoice-to">
                        <small>to</small>
                        <address class="m-t-5 m-b-5">
                            <strong class="text-inverse">Detail Perusahaan</strong><br>
                            <?=$tentangkami['alamat_cv']?><br>
                            Admin : <?= $tentangkami['telp_admin']?><br>
                              Marketing : <?= $tentangkami['telp_marketting']?>
                        </address>
                    </div>
                    <div class="invoice-date">
                        <small>Invoice / <?=date('M') ?> period</small>
                        <div class="date text-inverse m-t-5"><?=date('d-m-Y') ?></div>
                        <div class="invoice-detail">
                            #<?=$no_invoice ?><br>
                            Pendaftaran Agen
                        </div>
                    </div>
                </div>
	<!-- begin invoice-content -->
	<div class="invoice-content">
		<!-- begin table-responsive -->
		<table class="table table-invoice">
                            <thead>
                                <tr>
                                    <th width="40%">KETERANGAN</th>
                                    <th class="text-center" width="10%">DISKON</th>
                                    <th class="text-center" width="10%">PEMBAYARAN KE-</th>
                                    <th class="text-right" width="20%">TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="text-inverse">PENDAFTARAN <?= strtoupper(\backend\models\RefAgen::findOne(['id'=>$cekAgenReg['id_ref_agen']])->nama_agen) ?></span><br>
                                      
                                    </td>
                                    <td class="text-center"><?php echo number_format($franchice['diskon'])?></td>
                                    <td class="text-center">1</td>
                                    <td class="text-right"><?php echo number_format($franchice['nominal'])?></td>
                                </tr>
                               
                            </tbody>
                        </table>
		<!-- end table-responsive -->
		<!-- begin invoice-price -->
		<div class="invoice-price">
			<div class="invoice-price-left">
				<div class="invoice-price-row">
					Informasi No Rekening Perusahaan <?=$tentangkami['kontak_lainnya']?>
				</div>
			</div>
			<div class="invoice-price-right">
				<small>TOTAL</small> <span class="f-w-600"> <?php echo number_format($franchice['total'])?></span>
			</div>
		</div>
		<!-- end invoice-price -->
	</div>
	<!-- end invoice-content -->
	<!-- begin invoice-note -->
	
	<!-- end invoice-note -->
	<!-- begin invoice-footer -->
	
	<!-- end invoice-footer -->
</div>