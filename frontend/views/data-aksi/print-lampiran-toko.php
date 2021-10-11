<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
<style type="text/css">
.auto-style1 {
	width: 100%;
	border-top-width: 0px;
}
.auto-style2 {
	width: 152px;
	border-left-style: solid;
	border-left-width: 1px;
	border-top-style: solid;
	border-top-width: 1px;
}
.auto-style4 {
	width: 495px;
	border-bottom-style: solid;
	border-bottom-width: 1px;
}
.auto-style5 {
	width: 187px;
	border-top-style: none;
	border-top-width: medium;
	border-bottom-style: solid;
	border-bottom-width: 1px;
}
.auto-style6 {
	width: 100%;
	border-collapse: collapse;
}
.auto-style11 {
	border-style: solid;
	border-width: 1px;
}
.auto-style12 {
	width: 43px;
	border-style: solid;
	border-width: 1px;
}
.auto-style13 {
	width: 152px;
	border-left-style: solid;
	border-left-width: 1px;
	border-bottom-style: solid;
	border-bottom-width: 1px;
}
.auto-style14 {
	border-right-style: solid;
	border-right-width: 1px;
	border-top-style: none;
	border-top-width: medium;
	border-bottom-style: solid;
	border-bottom-width: 1px;
}
.auto-style15 {
	border-right-style: solid;
	border-right-width: 1px;
	border-top-style: solid;
	border-top-width: 1px;
}
</style>
</head>

<body>

<table id="table1" class="auto-style1">
	<tr>
		<td class="auto-style2">No Booking</td>
		<td colspan="3" class="auto-style15">:&nbsp;<?= $modelBooking['kd_booking']?></td>
	</tr>
	<tr>
		<td class="auto-style13">Tanggal Booking</td>
		<td class="auto-style4">:&nbsp;<?= $modelBooking['tgl_batas_book']?></td>
		<td class="auto-style5">Batas Pengambilan</td>
		<td class="auto-style14">:&nbsp;<?= $modelBooking['jam_batas_book']?> &nbsp;, Toleransi 10 Menit</td>
	</tr>
	</table>
<p><em>*jika barang belum di ambil sampai batas pengambilan, barang akan di 
kembalikan ke gudang, harap pesan ulang kembali</em></p>
<table id="table2" class="auto-style6">
    <tr>
		<td class="auto-style12">No</td>
		<td class="auto-style11">Nama Item</td>
		<td class="auto-style11">Qty</td>
		<td class="auto-style11">Jumlah</td>
	</tr>
    <?php 
    $id_tokoold=0;
    $no=1;
    foreach ($model as $value) { 
         //data barang
        $dataBarang = backend\models\DataBarang::find()->where(['id'=>$value['id_data_barang']])->one();
        $toko = backend\models\DataToko::find()->where(['id_data_agen'=>$dataBarang['id_data_agen']]);
        if($toko->exists()){
            $toko = $toko->one();
            $toko_d=$toko['no_toko'].', '.$toko['nama_toko'].', '.$toko['alamat'];
            $toko_id=$toko['id'];
        }else{
            $toko_id='';
            $toko_d="<i>Tidak ditemukan</i>";
        }
    if($toko_id!=$id_tokoold){
        ?>
    
	<tr>
		<td class="auto-style11" colspan="4">Toko Pesanan : <?=$toko_d ?></td>
	</tr>
    <?php }?>
	
	<tr>
		<td class="auto-style12"><?=$no++?></td>
		<td class="auto-style11"><?=$value['nama_item']?></td>
		<td class="auto-style11"><?=$value['qty']?></td>
		<td class="auto-style11"><?=$value['total']?></td>
	</tr>
	
    <?php 
    $id_tokoold=$toko_id;
    } ?>
</table>

</body>

</html>
