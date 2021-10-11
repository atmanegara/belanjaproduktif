<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
<style type="text/css">
.auto-style1 {
	border-collapse: collapse;
}
.auto-style7 {
	border-style: solid;
	border-width: 1px;
}
.auto-style8 {
	border-style: solid;
	border-width: 1px;
	background-color: #F1EBEB;
}
.auto-style9 {
	text-align: center;
}
</style>
</head>

<body>

   <table id="table5" class="auto-style1" style="width: 1227px">
                <tr>
                    <td rowspan="7" class="auto-style32" style="width: 168px">  
					<img src="<?= Yii::getAlias('@sourcePathImg/') . $modelFotoProfil['filename']; ?>" alt="" height="133" width="123" ></img></td>
                    <td class="auto-style9"><strong><?= $modelTentangKami['nama_cv'] ?>
                        </strong></td>
                    <td></td>
                </tr>
                <tr>
                    <td><?= $modelTentangKami['alamat_cv'] ?></td>
                    <td rowspan="6">
					</td>
                </tr>
                <tr>
                    <td>Marketing : <?= $modelTentangKami['telp_marketting'] ?></td>
                </tr>
                <tr>
                    <td>Email : <?= $modelTentangKami['email'] ?></td>
                </tr>
                <tr>
                    <td>Admin : <?= $modelTentangKami['telp_admin'] ?></td>
                </tr>
                <tr>
                    <td style="height: 11px"><?= $modelTentangKami['kontak_lainnya'] ?></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                </table>
                <hr />
<table id="table1" class="auto-style1" style="width: 100%">
	<tr>
		<td class="auto-style8">No</td>
		<td class="auto-style8">ID AGEN</td>
		<td class="auto-style8">Nama Agen</td>
		<td class="auto-style8">No Telp</td>
		<td class="auto-style8">Email</td>
		<td class="auto-style8">Alamat</td>
		<td class="auto-style8">Alamat Domisili</td>
		<td class="auto-style8">Nama Toko</td>
		<td class="auto-style8">Alamat Toko</td>
	</tr>
    <?php 
    $no=0;
    foreach($query as $valQuery){
        $no++;
        ?>
	<tr>
		<td class="auto-style7"><?=$no?></td>
		<td class="auto-style7"><?=$valQuery['id_agen']?></td>
		<td class="auto-style7"><?=$valQuery['nama_agen']?></td>
		<td class="auto-style7"><?=$valQuery['no_wa']?></td>
		<td class="auto-style7"><?=$valQuery['email']?></td>
		<td class="auto-style7"><?=$valQuery['alamat']?></td>
		<td class="auto-style7"><?=$valQuery['alamat_domisili']?></td>
		<td class="auto-style7"><?=$valQuery['nama_toko']?></td>
		<td class="auto-style7"><?=$valQuery['alamat_toko']?></td>
	</tr>
    <?php } ?>
</table>

</body>

</html>
