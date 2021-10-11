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
}
.auto-style2 {
	border-style: solid;
	border-width: 1px;
}
.auto-style3 {
	text-align: center;
}
.auto-style4 {
	width: 33px;
	border-style: solid;
	border-width: 1px;
}
.auto-style6 {
	width: 64px;
	border-style: solid;
	border-width: 1px;
}
.auto-style8 {
	text-align: center;
	border-style: solid;
	border-width: 1px;
	background-color: #E4E4E4;
}
.auto-style9 {
	width: 144px;
	border-style: solid;
	border-width: 1px;
}
.auto-style12 {
	width: 64px;
	text-align: center;
	border-style: solid;
	border-width: 1px;
	background-color: #E4E4E4;
}
.auto-style14 {
	width: 144px;
	text-align: center;
	border-style: solid;
	border-width: 1px;
	background-color: #E4E4E4;
}
.auto-style15 {
	width: 33px;
	text-align: center;
	border-style: solid;
	border-width: 1px;
	background-color: #E4E4E4;
}
.auto-style16 {
	width: 370px;
	text-align: center;
	border-style: solid;
	border-width: 1px;
	background-color: #E4E4E4;
}
.auto-style17 {
	width: 370px;
	border-style: solid;
	border-width: 1px;
}
.auto-style18 {
	width: 59px;
	text-align: center;
	border-style: solid;
	border-width: 1px;
	background-color: #E4E4E4;
}
.auto-style19 {
	width: 59px;
	border-style: solid;
	border-width: 1px;
}
.auto-style20 {
	width: 77px;
	text-align: center;
	border-style: solid;
	border-width: 1px;
	background-color: #E4E4E4;
}
.auto-style21 {
	width: 77px;
	border-style: solid;
	border-width: 1px;
}
.auto-style22 {
	text-align: center;
	width: 168px;
	border-style: solid;
	border-width: 1px;
	background-color: #E4E4E4;
}
.auto-style23 {
	width: 168px;
	border-style: solid;
	border-width: 1px;
}
.auto-style24 {
	text-align: center;
	width: 220px;
	border-style: solid;
	border-width: 1px;
	background-color: #E4E4E4;
}
.auto-style25 {
	width: 220px;
	border-style: solid;
	border-width: 1px;
}
</style>
</head>

<body>

<div class="auto-style3">

LAPORAN TRANSAKSI PERTANGGAL <?= $tgl_awal ?> s/d <?= $tgl_akhir?>

</div>
    <?php foreach($dataAgen as $valAgen){ 
        $dataToko = \backend\models\DataToko::find()->where(['id_data_agen'=>$valAgen['id']]);
        if($dataToko->exists()){
            $toko = $dataToko->one();
            $namaToko=$toko['nama_toko'];
        }else{
            $namaToko ='-';
            continue;
        }
        ?>
    <br>
    <p>
        Nama Toko       : <?= $namaToko;?> <br>
        Nama Pemilik    : <?= $valAgen['nama_agen'].' / '.$valAgen['id_agen']; ?>
    </p>
<table id="table1" class="auto-style1">
	<tr>
		<td class="auto-style15" rowspan="2" valign="middle"><strong>NO</strong></td>
		<td class="auto-style14" rowspan="2" valign="middle"><strong>KODE</strong></td>
		<td class="auto-style16" rowspan="2" valign="middle"><strong>ITEM</strong></td>
		<td class="auto-style8" colspan="3" valign="middle"><strong>QTY</strong></td>
		<td class="auto-style8" valign="middle" rowspan="2"><strong>SATUAN</strong></td>
		<td class="auto-style8" colspan="2" valign="middle"><strong>HARGA</strong></td>
		<td class="auto-style8" rowspan="2" valign="middle"><strong>TOTAL JUAL</strong></td>
	</tr>
	<tr>
		<td class="auto-style12" valign="middle"><strong>MASUK</strong></td>
		<td class="auto-style18" valign="middle"><strong>KELUAR</strong></td>
		<td class="auto-style20" valign="middle"><strong>SISA</strong></td>
		<td class="auto-style24" valign="middle"><strong>DASAR</strong></td>
		<td class="auto-style22" valign="middle"><strong>JUAL</strong></td>
	</tr>
    <?php 
    $no=1;
    foreach($dataTransaksiBarang as $val){
        if($val['id_data_agen']==$valAgen['id']){
           
        ?>
	<tr>
		<td class="auto-style4"><?=$no++?></td>
		<td class="auto-style9"><?=$val['barkode']?></td>
		<td class="auto-style17"><?=$val['nama_barang']?></td>
		<td class="auto-style6"><?=$val['qty_in']?></td>
		<td class="auto-style19"><?=$val['qty_out']?></td>
		<td class="auto-style21"><?=$val['sisa_qty']?></td>
		<td class="auto-style21"><?=$val['nama_satuan']?></td>
                <td class="auto-style25"><?= number_format($val['harga_modal'],0,',','.')?></td>
		<td class="auto-style23"><?=number_format($val['harga_jual'],0,',','.')?></td>
		<td class="auto-style2"><?=number_format($val['total'],0,',','.')?></td>
	</tr>
    <?php }
    }?>
</table>

    <?php } ?>

</body>

</html>
