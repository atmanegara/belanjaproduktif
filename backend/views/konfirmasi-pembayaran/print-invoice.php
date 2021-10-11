<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
<style type="text/css">
.auto-style1 {
	text-align: center;
}
.auto-style2 {
	border-collapse: collapse;
}
.auto-style4 {
	text-align: center;
	text-decoration: underline;
}
.auto-style5 {
	background-color: #6DF345;
}
.auto-style6 {
	background-color: #EF2A1A;
}
</style>
</head>

<body>

<table id="table1" style="width: 100%" class="auto-style2">
	<tr>
		<td style="width: 3px"><img src="<?= Yii::getAlias('@sourcePathImg/').$modelFotoProfil['filename'];?>" alt="" height="171" width="163" ></img></td>
		<td class="auto-style1">
		<div><?=$modelTentangKami['nama_cv']?></div><div><?=$modelTentangKami['alamat_cv']?></div>
		<div>CP : <?= $modelTentangKami['telp_admin']?></div></td>
	</tr>
	</table>
<hr>
<p>No invoice <strong>#<?=$query['no_invoice']?></strong></p>
<p class="auto-style4"><strong>TANDA TERIMA</strong></p>
<table id="table2" style="width: 100%" class="auto-style2">
	<tr>
		<td style="width: 282px">SUDAH DITERIMA DARI</td>
		<td>:</td>
		<td><?=$namaAgen . ', dengan No. Registrasi : '. $dataAgen['no_reg']?></td>
	</tr>
    <tr>
		<td style="width: 282px">KEPADA </td>
		<td>:</td>
		<td>CV. Belanja Produktif</td>
	</tr>
	<tr>
		<td style="width: 282px">UANG SEBANYAK</td>
		<td>:</td>
                <td><?=" ".number_format($query['nominal'],0,',','.').' ( '.strtoupper(Yii::$app->setting->rupiah($query['nominal']))." )"?></td>
	</tr>
	<tr>
		<td style="width: 282px">UNTUK PEMBAYARAN</td>
		<td>:</td>
                <td>PENDAFTARAN <?= strtoupper(backend\models\RefAgen::findOne($dataAgen['id_ref_agen'])->nama_agen) ?></td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>

<hr />
<div>
	<strong>
	<?php  if($query['id_status_pembayaran']=='2'){ ?>
	STATUS : <span class="auto-style5"> PAID	</span>
	<?php }else{ ?>
		STATUS :<span class="auto-style6"> INVALID </span>	
	<?php }?>
	</strong>
</div>
<p>
<table id="table3" style="width: 100%">
	<tr>
		<td style="width: 655px">&nbsp;</td>
                <td>Banjarbaru, <?= date('d-m-Y',strtotime($query['tgl_konfirmasi']))?> </td>
	</tr>
	<tr>
		<td style="width: 655px">&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td style="width: 655px">&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td style="width: 655px">&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td style="width: 655px">&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td style="width: 655px"><?=$modelTandaTangan['nama']?></td>
		<td><?=$dataAgen['nama']?></td>
	</tr>
</table>
</p>
</body>

</html>
