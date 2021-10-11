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
.auto-style6 {
	border-style: solid;
	border-width: 1px;
	background-color: #E8E8E8;
}
.auto-style7 {
	border-style: solid;
	border-width: 1px;
}
.auto-style8 {
	border-style: none;
	border-width: medium;
	background-color: #E8E8E8;
}
.auto-style14 {
	border-style: none;
	border-width: medium;
}
.auto-style15 {
	text-align: center;
}
.auto-style16 {
	margin-right: 141px;
}
</style>
</head>

<body>

   <table id="table5" class="auto-style1">
                <tr>
                    <td rowspan="7" class="auto-style32">  
					<img src="<?= Yii::getAlias('@sourcePathImg/') . $modelFotoProfil['filename']; ?>" alt="" height="133" width="140" class="auto-style16" ></img></td>
                    <td class="auto-style15" style="width: 767px"><strong><?= $modelTentangKami['nama_cv'] ?>
                        </strong></td>
                    <td style="width: 331px"></td>
                </tr>
                <tr>
                    <td style="width: 767px"><?= $modelTentangKami['alamat_cv'] ?></td>
                    <td rowspan="6" style="width: 331px">
	       </tr>
                <tr>
                    <td style="width: 767px">Marketing : <?= $modelTentangKami['telp_marketting'] ?></td>
                </tr>
                <tr>
                    <td style="width: 767px">Email : <?= $modelTentangKami['email'] ?></td>
                </tr>
                <tr>
                    <td style="width: 767px">Admin : <?= $modelTentangKami['telp_admin'] ?></td>
                </tr>
                <tr>
                    <td style="height: 11px; width: 767px;"><?= $modelTentangKami['kontak_lainnya'] ?></td>
                </tr>
                <tr>
                    <td style="width: 767px">&nbsp;</td>
                </tr>
                </table>
                <hr />
    <?php foreach($query as $queryVal){ ?>
<table id="table2" style="width: 100%" class="auto-style1">
	<tr>
		<td style="height: 24px; width: 149px;" class="auto-style8">NAMA AGEN</td>
		<td style="height: 24px; width: 19px;" class="auto-style14">:</td>
		<td style="height: 24px" class="auto-style14"><?=$queryVal['nama_agen']?></td>
		<td style="height: 24px; width: 82px;" class="auto-style8">ID AGEN</td>
		<td style="height: 24px" class="auto-style14">:</td>
		<td style="height: 24px" class="auto-style14"><?=$queryVal['id_agen']?></td>
	</tr>
	<tr>
		<td class="auto-style8" style="width: 149px">AGEN</td>
		<td style="width: 19px" class="auto-style14">:</td>
		<td class="auto-style14"><?=$queryVal['ket_nama']?></td>
		<td colspan="3" class="auto-style14">&nbsp;</td>
	</tr>
</table>
<?php 
$cekAnggota = backend\models\DataAnggota::find()->where(['no_acak_agen'=>$queryVal['no_acak']]);
if(!$cekAnggota->exists()){
    $htmlKet ="<span class='label label-danger'> TIDAK ADA ANGGOTA </span> <hr />";
    $ada = false;
}else{
    $htmlKet = "Total Anggota ".$cekAnggota->count()." Orang";
    $ada = true;
    $queryAnggota = (new yii\db\Query())
            ->select('b.id_agen,a.nama_agen,a.alamat,a.nope,a.nik,b.nama_agen as ket_agen')
            ->from('data_anggota a')
            ->innerJoin('data_agen b','a.no_acak=b.no_acak')
            ->innerJoin('ref_agen c','b.id_ref_agen=c.id')
            ->where(['a.no_acak_agen'=>$queryVal['no_acak']])->all();
    
}
?>
<p>

</p> 
<p>
    <?=$htmlKet?>
</p>
<?php if($ada){ ?>
<table id="table1" style="width: 100%" class="auto-style1">
	<tr>
		<td class="auto-style6" style="width: 47px">No</td>
		<td class="auto-style6">ID</td>
		<td class="auto-style6">Nama</td>
		<td class="auto-style6">Telp</td>
		<td class="auto-style6">alamat</td>
	</tr>
    <?php 
    $nourut=0;
    foreach($queryAnggota as $valAnggota){ 
        $nourut++;
?>
	<tr>
		<td style="width: 47px" class="auto-style7"><?=$nourut?></td>
		<td class="auto-style7"><?=$valAnggota['id_agen']?></td>
		<td class="auto-style7"><?=$valAnggota['nama_agen']?></td>
		<td class="auto-style7"><?=$valAnggota['nope']?></td>
		<td class="auto-style7"><?=$valAnggota['alamat']?></td>
	</tr>
    <?php } ?>
</table><hr />
    <?php }
    }?>
</body>

</html>
