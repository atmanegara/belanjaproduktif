<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
<style type="text/css">
.auto-style6 {
	width: 100%;
	border-collapse: collapse;
}
.auto-style11 {
	border-style: solid;
	border-width: 1px;
        mso-number-format:'\@';
}
.auto-style12 {
	width: 43px;
	border-style: solid;
	border-width: 1px;
}
.auto-style27 {
	border-collapse: collapse;
}
</style>
</head>

<body>

<table id="table3" style="width: 100%" class="auto-style27">
	<tr>
		<td style="width: 143px">No Invoice</td>
		<td style="width: 17px">:</td>
		<td style="width: 680px"><?= $modelBooking['no_invoice']?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td style="width: 143px">No Booking</td>
		<td style="width: 17px">:</td>
		<td style="width: 680px"><?= $modelBooking['kd_booking']?></td>
		<td>&nbsp;</td>
		<td>Nama Pembeli</td>
		<td>:</td>
		<td><?=$dataAgenPembeli['id_agen'] . ' / '.$dataAgenPembeli['nama_agen'] ?></td>
	</tr>
	<tr>
		<td style="width: 143px; height: 26px;">Tanggal Booking</td>
		<td style="width: 17px; height: 26px;">:</td>
		<td style="height: 26px; width: 680px;"><?= $modelBooking['tgl_batas_book']?></td>
		<td style="height: 26px"></td>
		<td style="height: 26px">Batas Pengambilan</td>
		<td style="height: 26px">:</td>
		<td style="height: 26px"><?= $modelBooking['jam_batas_book']?> &nbsp;, Toleransi 10 Menit</td>
	</tr>
</table>
	
<p><em>*jika barang belum di ambil sampai batas pengambilan, barang akan di 
kembalikan ke gudang, harap pesan ulang kembali</em></p>
<table id="table2" class="auto-style6">
    <tr>
		<td class="auto-style12">No</td>
		<td class="auto-style11">Nama Item</td>
		<td class="auto-style11">Qty</td>
		<td class="auto-style11" >Jumlah</td>
	</tr>
    <?php 
    $id_tokoold=0;
    $no=1;
    $total=0;
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
                <td class="auto-style11"><?= number_format($value['total'],0,',','.')?></td>
	</tr>
	
    <?php 
    $id_tokoold=$toko_id;
    $total += $value['total'];
    } ?>
	
	<tr>
		<td class="auto-style11" colspan="3">&nbsp;</td>
                <td class="auto-style11"><?=     number_format($total,0,',','.')?></td>
	</tr>
	
    </table>

</body>

</html>
