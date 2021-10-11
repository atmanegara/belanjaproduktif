<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
<style type="text/css">
.auto-style2 {
	width: 392px;
	border-left-style: solid;
	border-left-width: 1px;
	border-top-style: solid;
	border-top-width: 1px;
	border-bottom-style: solid;
	border-bottom-width: 1px;
	text-align: center;
}
.auto-style3 {
	text-align: center;
	border-right-style: solid;
	border-right-width: 1px;
	border-top-style: solid;
	border-top-width: 1px;
}
.auto-style4 {
	width: 324px;
	border-left-style: solid;
	border-left-width: 1px;
	border-bottom-style: solid;
	border-bottom-width: 1px;
}
.auto-style5 {
	width: 12px;
}
.auto-style6 {
	text-align: right;
}
.auto-style7 {
	width: 100%;
	border-collapse: collapse;
}
.auto-style8 {
	border-left-style: none;
	border-left-width: medium;
	border-right-style: solid;
	border-right-width: 1px;
	border-bottom-style: solid;
	border-bottom-width: 1px;
	text-align: center;
}
.auto-style9 {
	width: 324px;
	border-left-style: solid;
	border-left-width: 1px;
}
.auto-style10 {
	border-right-style: solid;
	border-right-width: 1px;
}
.auto-style11 {
	border-right-style: solid;
	border-right-width: 1px;
	border-bottom-style: solid;
	border-bottom-width: 1px;
}
.auto-style12 {
	width: 12px;
	border-bottom-style: solid;
	border-bottom-width: 1px;
}
.auto-style13 {
	width: 324px;
	border-left-style: solid;
	border-left-width: 1px;
	border-top-style: none;
	border-top-width: medium;
	height: 26px;
}
.auto-style14 {
	width: 12px;
	border-top-style: none;
	border-top-width: medium;
	height: 26px;
}
.auto-style15 {
	border-right-style: solid;
	border-right-width: 1px;
	border-top-style: none;
	border-top-width: medium;
	height: 26px;
}
.auto-style16 {
	border-right-style: solid;
	border-right-width: 1px;
	border-top-style: none;
	border-top-width: medium;
	border-bottom-style: none;
	border-bottom-width: medium;
}
.auto-style17 {
	width: 324px;
	border-left-style: solid;
	border-left-width: 1px;
	border-top-style: solid;
	border-top-width: 1px;
	height: 26px;
	border-bottom-style: none;
	border-bottom-width: medium;
}
.auto-style18 {
	width: 12px;
	border-top-style: solid;
	border-top-width: 1px;
	height: 26px;
	border-bottom-style: none;
	border-bottom-width: medium;
}
.auto-style19 {
	border-right-style: solid;
	border-right-width: 1px;
	border-top-style: solid;
	border-top-width: 1px;
	height: 26px;
	border-bottom-style: none;
	border-bottom-width: medium;
}
</style>

<body>
<div class="auto-style6">Tanggal Cetak : <?= date('Y-m-d') ?></div>
<table id="table1" class="auto-style7">
	<tr>
		<td class="auto-style2" rowspan="2" style="width: 173px"><img src="<?= Yii::getAlias('@sourcePathImg/').$modelFotoProfil['filename'];?>" alt="" height="171" width="163" ></img></td>
		<td class="auto-style3"><strong><?= $modelTentangKami['nama_cv'] ?>
		</strong></td>
	</tr>
	<tr>
		<td class="auto-style8"><?= $modelTentangKami['alamat_cv'] ?><br>Admin Marketing : <?= $modelTentangKami['telp_marketting'] ?><br>No. Rekening : <?= $modelTentangKami['kontak_lainnya'] ?></td>
	</tr>
</table>
<table id="table2" class="auto-style7">
	<tr>
		<td class="auto-style17" style="width: 252px">NO. REGISTRASI</td>
		<td class="auto-style18">:</td>
		<td colspan="2" class="auto-style19"><?=$model['no_reg']?></td>
	</tr>
    <tr>
		<td class="auto-style13" style="width: 252px">USERNAME</td>
		<td class="auto-style14">:</td>
		<td colspan="2" class="auto-style15"><?=$username = \common\models\User::find()->where(['no_acak'=>$model['no_acak']])->one()->username;?></td>
	</tr>
	<tr>
		<td class="auto-style9" style="width: 252px">NIK </td>
		<td class="auto-style5">:</td>
		<td><?=$model['nik']?></td>
		<td class="auto-style16"></td>
	</tr>
    <tr>
		<td class="auto-style9" style="width: 252px">NO WA  </td>
		<td class="auto-style5">:</td>
		<td><?=$model['nope']?></td>
		<td class="auto-style16"></td>
	</tr>
	<tr>
		<td class="auto-style4" style="width: 252px">AGEN YANG TERDAFTAR</td>
		<td class="auto-style12">:</td>
		<td colspan="2" class="auto-style11"><?=$model->refAgen->nama_agen?></td>
	</tr>
	</table>
<p>*<i>Pastikan no. telpon / WA anda aktif dan email anda valid, setiap 
informasi akan kita sampaikan melalui media telpon/email, harap simpan No 
Registrasi Ini</i></p>

</body>

</html>
