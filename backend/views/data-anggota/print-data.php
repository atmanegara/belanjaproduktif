<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
<style type="text/css">
.auto-style1 {
	width: 100%;
	border-collapse: collapse;
	border-width: 0px;
}
.auto-style8 {
	width: 207px;
	border-left-style: solid;
	border-left-width: 1px;
	border-right-style: none;
	border-right-width: medium;
	border-top-style: solid;
	border-top-width: 1px;
	border-bottom-style: solid;
	border-bottom-width: 1px;
}
.auto-style9 {
	width: 9px;
	border-left-style: none;
	border-left-width: medium;
	border-right-style: none;
	border-right-width: medium;
	border-top-style: solid;
	border-top-width: 1px;
	border-bottom-style: solid;
	border-bottom-width: 1px;
}
.auto-style10 {
	border-left-style: none;
	border-left-width: medium;
	border-right-style: solid;
	border-right-width: 1px;
	border-top-style: solid;
	border-top-width: 1px;
	border-bottom-style: solid;
	border-bottom-width: 1px;
}

.auto-style11 {
	width: 100%;
}

.auto-style12 {
	width: 173px;
}

</style>
</head>

<body>

<p>Data akun pengguna aplikasi </p>
<table id="table1" class="auto-style1">
	<tr>
		<td class="auto-style8">No Registrasi</td>
		<td class="auto-style9">:</td>
		<td class="auto-style10"><?=$queryReg['no_reg']?></td>
	</tr>
	<tr>
		<td class="auto-style8">NIK / Nama</td>
		<td class="auto-style9">:</td>
		<td class="auto-style10"><?=$queryReg['nik'].' / '.$queryReg['nama']?></td>
	</tr>
	<tr>
		<td class="auto-style8">Username</td>
		<td class="auto-style9">:</td>
		<td class="auto-style10"><?=$query['username']?></td>
	</tr>
	<tr>
		<td class="auto-style8">Password</td>
		<td class="auto-style9">:</td>
		<td class="auto-style10"><?=$query['password_string']?></td>
	</tr>
</table>
<p>Jika anda sudah memiliki akun pengguna ini bisa lakukan login ke aplikasi kami di <b>http://belanjaproduktif.com/</b>, pastikan informasi ini dijaga dengan baik</p>
<p>Harap disimpan dengan baik</p>
<table id="table2" class="auto-style11">
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td class="auto-style12">&nbsp;</td>
		<td>By Admin BP ,<?=date('d-m-Y')?></td>
	</tr>
</table>

</body>

</html>
