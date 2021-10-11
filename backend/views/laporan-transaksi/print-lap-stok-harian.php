<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
<style type="text/css">
.auto-style2 {
	border-collapse: collapse;
}
.auto-style3 {
	text-align: center;
}
.auto-style4 {
	border-style: solid;
	border-width: 1px;
	background-color: #E9E8E8;
}
.auto-style5 {
	border-style: solid;
	border-width: 1px;
}
</style>
</head>

<body>
<div class="auto-style3">

LAPORAN STOK OPNAME PERTANGGAL <?= date('d-m-Y') ?> 
</div>
    <?php
        $dataToko = \backend\models\DataToko::find()->where(['id_data_agen'=>$dataAgen['id']]);
        if($dataToko->exists()){
            $toko = $dataToko->one();
            $namaToko=$toko['nama_toko'];
        }else{
            $namaToko ='-';
     
        }
        ?>
    <br>
    <p>
        Nama Toko       : <?= $namaToko;?> <br>
        Nama Pemilik    : <?= $dataAgen['nama_agen'].' / '.$dataAgen['id_agen']; ?>
    </p>
<table id="table1" class="auto-style2" style="width: 100%">
	<tr>
		<td class="auto-style4" style="width: 21px"><strong>No</strong></td>
		<td class="auto-style4" style="width: 106px"><strong>Kode Barkode</strong></td>
		<td class="auto-style4" style="width: 125px"><strong>Kode Item</strong></td>
		<td class="auto-style4" style="width: 441px"><strong>Nama Item</strong></td>
		<td class="auto-style4" style="width: 54px"><strong>QTY</strong></td>
		<td class="auto-style4"><strong>Satuan</strong></td>
		<td class="auto-style4"><strong>Harga Satuan</strong></td>
		<td class="auto-style4"><strong>Harga Jual</strong></td>
	</tr>
    <?php 
    $no=0;
    foreach($dataStokBarang as $val){ 
        $no++;
        ?>
	<tr>
		<td style="width: 21px" class="auto-style5"><?=$no?></td>
		<td style="width: 106px" class="auto-style5"><?=$val['barkode']?></td>
		<td style="width: 125px" class="auto-style5"><?=$val['kode']?></td>
		<td style="width: 441px" class="auto-style5"><?=$val['item_barang']?></td>
		<td style="width: 54px" class="auto-style5"><?=$val['stok_sisa']?></td>
		<td class="auto-style5"><?=$val['nama_satuan']?></td>
                <td class="auto-style5"><?= number_format($val['harga_satuan'],0,',','.')?></td>
		<td class="auto-style5"><?=number_format($val['harga_jual'],0,',','.')?></td>
	</tr>
    <?php } ?>
</table>

</body>

</html>
