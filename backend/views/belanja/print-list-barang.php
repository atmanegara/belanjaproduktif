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
	width: 150px;
}
.auto-style3 {
	width: 8px;
}
.auto-style4 {
	width: 100%;
}
.auto-style5 {
	text-align: center;
}
.auto-style6 {
	border-style: solid;
	border-width: 1px;
}
</style>
</head>

<body>

<table id="table1" class="auto-style1">
	<tr>
		<td class="auto-style2">No Invoice</td>
		<td class="auto-style3">:</td>
		<td><?=$modelCheckOut['no_invoice']?></td>
	</tr>
	<tr>
		<td class="auto-style2">Tanggal Invoice</td>
		<td class="auto-style3">:</td>
		<td><?=$modelCheckOut['tgl_invoice']?></td>
	</tr>
    <tr>
		<td class="auto-style2">Tanggal Pesanan / Jam Pesanan</td>
		<td class="auto-style3">:</td>
		<td><?= $detailPembayaran['tgl_dikirim'].', '.$detailPembayaran['jam_dikirim'] ?></td>
	</tr>
	<tr>
		<td class="auto-style2">Pengirim</td>
		<td class="auto-style3">:</td>
		<td><?=$dataAgen['nama_agen'] .' / ID AGEN : '.$dataAgen['id_agen'] ?></td>
	</tr>
	<tr>
		<td class="auto-style2">Alamat</td>
		<td class="auto-style3">:</td>
		<td><?=$dataAgen['alamat_domisili'] ?></td>
	</tr>
	<tr>
		<td class="auto-style2">Telp</td>
		<td class="auto-style3">:</td>
		<td><?=$dataAgen['no_wa']?></td>
	</tr>
</table>
<hr noshade="noshade" />
<br>

<table id="table2" class="auto-style4">
	<tr>
		<td class="auto-style5"><?=$modelAgen['nama_toko']?></td>
	</tr>
	<tr>
            <td class="auto-style5"><?=$modelAgen['alamat']?><br><?=$modelAgen['telp']?></td>
	</tr>
</table>



<p>&nbsp;</p>
<table id="table3" class="auto-style1">
	<tr>
		<td class="auto-style6">No</td>
		<td class="auto-style6">Nama Item</td>
		<td class="auto-style6">Banyak</td>
		<td class="auto-style6">Jumlah</td>
		<td class="auto-style6">Total</td>
	</tr>
    <?php 
    $no=1;
    $totalJual=0;
    foreach($model as $valBarang){ ?>
	<tr>
		<td class="auto-style6"><?=$no++?></td>
		<td class="auto-style6"><?=$valBarang['nama_barang']?></td>
		<td class="auto-style6"><?=$valBarang['qty']?></td>
                <td class="auto-style6"> <?= number_format($valBarang['harga_jual'],0,',','.')?></td>
               
		<td class="auto-style6"> <?=number_format($valBarang['total_jual'],0,',','.')?></td>
	</tr>
    <?php 
    $totalJual +=$valBarang['total_jual']; 
    } ?>
    <tr>
        <td class="auto-style6" colspan="4">Total</td>
		
		<td class="auto-style6"> <?=number_format($totalJual,0,',','.')?></td>
	</tr>
</table>



</body>

</html>
