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
	font-size: 10px;
}
.auto-style7 {
	border-style: solid;
	border-width: 1px;
}
.auto-style8 {
	text-align: center;
}
.auto-style9 {
	border-style: solid;
	border-width: 1px;
	text-align: center;
	background-color: #EDEDED;
	font-size: 8px;
}
.auto-style10 {
	border-style: solid;
	border-width: 1px;
	text-align: center;
	width: 129px;
	background-color: #EDEDED;
	font-size: 8px;
}
.auto-style11 {
	border-style: solid;
	border-width: 1px;
	width: 129px;
}
.auto-style13 {
	border-style: solid;
	border-width: 1px;
	text-align: center;
	background-color: #F0F6EF;
}
.auto-style14 {
	border-style: solid;
	border-width: 1px;
	background-color: #F0F6EF;
}
</style>
</head>

<body>

<p>No : <?=Yii::$app->request->get('no_acak')?></p>
<p class="auto-style8"><strong>LAPORAN PENJUALAN AGEN PROMO <?= strtoupper($dataToko['nama_toko']) ?></strong></p>
<table id="table1" class="auto-style1">
	<tr>
		<td class="auto-style9" rowspan="5"><strong>NO</strong></td>
		<td class="auto-style9" rowspan="5"><strong>TANGGAL TRANSAKSI</strong></td>
		<td class="auto-style9" rowspan="2" colspan="3"><strong>REFERENSI AGEN PASOK</strong></td>
		<td class="auto-style9" colspan="3"><strong>HAK KEPEMILIKAN ITEM</strong></td>
		<td class="auto-style9" colspan="2"><strong>PEMBELI</strong></td>
		<td class="auto-style10" rowspan="5"><strong>TANGGAL BARANG MASUK</strong></td>
		<td class="auto-style10" rowspan="5"><strong>ITEM BARANG</strong></td>
		<td class="auto-style9" colspan="3"><strong>KETERANGAN</strong></td>
		<td class="auto-style9"><strong>TANGGAL</strong></td>
		<td class="auto-style9" colspan="2"><strong>(HPP)</strong></td>
		<td class="auto-style9" colspan="3"><strong>MARGIN</strong></td>
		<td class="auto-style9" colspan="2"><strong>PENJUALAN</strong></td>
		<td class="auto-style9" rowspan="2" colspan="7"><strong>BAGI HASIL PENJUALAN 
		AGEN</strong></td>
	</tr>
	<tr>
		<td class="auto-style9" colspan="2"><strong>AGEN PASOK</strong></td>
		<td class="auto-style9" rowspan="4"><strong>ITEM BARANG</strong></td>
		<td class="auto-style9" rowspan="4"><strong>NAMA</strong></td>
		<td class="auto-style9" rowspan="4"><strong>ID</strong></td>
		<td class="auto-style9" rowspan="4"><strong>MASUK</strong></td>
		<td class="auto-style9" rowspan="4"><strong>KELUAR</strong></td>
		<td class="auto-style9" rowspan="4"><strong>SISA</strong></td>
		<td class="auto-style9" rowspan="4"><strong>SISA BARANG</strong></td>
		<td class="auto-style9" rowspan="4"><strong>HARGA MODAL</strong></td>
		<td class="auto-style9" rowspan="4"><strong>TOTAL</strong></td>
		<td class="auto-style9" rowspan="4"><strong>%</strong></td>
		<td class="auto-style9" rowspan="4"><strong>ITEM</strong></td>
		<td class="auto-style9" rowspan="4"><strong>TOTAL</strong></td>
		<td class="auto-style9" rowspan="4"><strong>HARGA JUAL</strong></td>
		<td class="auto-style9" rowspan="4"><strong>TOTAL</strong></td>
	</tr>
	<tr>
		<td class="auto-style9" rowspan="3"><strong>NAMA AGEN</strong></td>
		<td class="auto-style9" rowspan="3"><strong>ID</strong></td>
		<td class="auto-style9" rowspan="3"><strong>NAMA AGEN</strong></td>
		<td class="auto-style9" rowspan="3"><strong>ID</strong></td>
		<td class="auto-style9" rowspan="3"><strong>PROMO</strong></td>
		<td class="auto-style9" rowspan="2"><strong>PROMO</strong></td>
		<td class="auto-style9" rowspan="2"><strong>KANTOR BP </strong></td>
		<td class="auto-style9"><strong>PASOK</strong></td>
		<td class="auto-style9"><strong>NIAGA</strong></td>
		<td class="auto-style9"><strong>LAINNYA</strong></td>
		<td class="auto-style9" rowspan="2"><strong>TOTAL</strong></td>
	</tr>
	<tr>
		<td class="auto-style9"><strong>BP</strong></td>
		<td class="auto-style9"><strong>BP</strong></td>
		<td class="auto-style9"><strong>BP</strong></td>
	</tr>
	<tr>
		<td class="auto-style9"><strong>25%</strong></td>
		<td class="auto-style9"><strong>25%</strong></td>
		<td class="auto-style9" style="height: 17px"><strong>25%</strong></td>
		<td class="auto-style9" style="height: 17px"><strong>18%</strong></td>
		<td class="auto-style9" style="height: 17px"><strong>7%</strong></td>
		<td class="auto-style9"><strong>100%</strong></td>
	</tr>
    <?php 
    $no=1;
    $qty_in=0;
    $qty_out =0;
    $sisa_qty=0;
    $harga_modal=0;
    $margin_total=0;
    $total=0;
    
    foreach($query as $val){ 
             
                $dataItemPasok =(new \yii\db\Query())
                        ->select('b.no_acak,c.nama_agen,c.id_agen,a.item_barang,c.no_acak_ref')
->from('data_barang a')
->innerJoin('data_item_barang_agen b','a.id=b.id_data_barang')
                        ->innerJoin('data_agen c','b.no_acak=c.no_acak')
                        ->where(['a.id'=>$val['id_data_barang'],
                            'b.id_data_barang'=>$val['id_data_barang']
                            ]);
               if($dataItemPasok->exists()){
                   $itemPasok = $dataItemPasok->one();
                   $namaAgen = $itemPasok['nama_agen'];
                   $idAgen = $itemPasok['id_agen'];
                   $itemBarang = $itemPasok['item_barang'];
                   $no_acak_ref=$itemPasok['no_acak_ref'];
               }else{
                   $namaAgen = 'NON PASOK';
                                      $idAgen ='BP';
                   $itemBarang ='-';
                   $no_acak_ref='-';

               }
$dataAgenReferensi = \backend\models\DataAgen::find()->where([
    'no_acak'=>$no_acak_ref
]);
if($dataAgenReferensi->exists()){
    $dataAgenReferensi = $dataAgenReferensi->one();
      $namaAgenRef = $dataAgenReferensi['nama_agen'];
                   $idAgenRef = $dataAgenReferensi['id_agen'];
}else{
    $namaAgenRef='-';
    $idAgenRef = '-';
}

                $namaAgenPembeli ='-';
                $idAgenPembeli ='-';
                $dataAgen = \backend\models\DataAgen::find()->where(['no_acak'=>$val['no_acak_pembeli']]);
                if($dataAgen->exists()){
                    $dataAgen = $dataAgen->one();
                                        $idAgenPembeli = $dataAgen['id_agen'];
                    $namaAgenPembeli = $dataAgen['nama_agen'];
                }
             //   echo $namaAgen;
               
    ?>
	<tr>
		<td class="auto-style7" style="height: 27px"><?=$no++?></td>
		<td class="auto-style7" ><?=$val['tgl_transaksi']?></td>
		
		
		<td class="auto-style7"><?=$namaAgenRef?></td>
		
		<td class="auto-style7" style="height: 27px"><?=$idAgenRef?></td>
		
                <td class="auto-style7" style="height: 27px"><?=$namaAgen?></td>
		<td class="auto-style7" style="height: 27px"><?=$idAgen?></td>
		<td class="auto-style7" style="height: 27px"><?=$itemBarang ?></td>
		<td class="auto-style7" style="height: 27px"><?= $namaAgenPembeli?></td>
		<td class="auto-style7" style="height: 27px"><?= $idAgenPembeli?></td>
		<td class="auto-style11" style="height: 27px"><?=$val['tgl_masuk']?></td>
		<td class="auto-style11" style="height: 27px"><?=$val['nama_barang']?></td>
		<td class="auto-style7" style="height: 27px"><?=$val['qty_in']?></td>
		<td class="auto-style7" style="height: 27px"><?=$val['qty_out']?></td>
		<td class="auto-style7" style="height: 27px"><?=$val['sisa_qty']?></td>
		<td class="auto-style7" style="height: 27px"><?=$val['tgl_keluar']?></td>
		<td class="auto-style7" style="height: 27px"><?=$val['harga_satuan']?></td>
		<td class="auto-style7" style="height: 27px"><?=number_format($val['harga_modal'],0,',','.')?></td>
		<td class="auto-style7" style="height: 27px"><?=$val['nilai']?></td>
		<td class="auto-style7" style="height: 27px"><?=$val['margin_item']?></td>
		<td class="auto-style7" style="height: 27px"><?=number_format($val['margin_total'],0,',','.')?></td>
		<td class="auto-style7" style="height: 27px"><?=$val['harga_jual']?></td>
		<td class="auto-style7" style="height: 27px"><?=number_format($val['total'],0,',','.')?></td>
              

                <td class="auto-style7" style="height: 27px"><?=number_format($val['nominal1'],0,',','.')?></td>
                <td class="auto-style7" style="height: 27px"><?=number_format($val['nominal1'],0,',','.')?></td>
                <td class="auto-style7" style="height: 27px"><?=number_format($val['nominal1'],0,',','.')?></td>
                <td class="auto-style7" style="height: 27px"><?=number_format($val['nominal2'],0,',','.')?></td>                
                <td class="auto-style7" style="height: 27px"><?=number_format($val['nominal3'],0,',','.')?></td>
                <td class="auto-style7" style="height: 27px"><?=number_format($val['nominal1']+$val['nominal1']+$val['nominal1']+$val['nominal2']+$val['nominal3'],0,',','.')?></td>
	</tr>
    <?php 
    $qty_in +=$val['qty_in'];
    $qty_out +=$val['qty_out'];
    $sisa_qty +=$val['sisa_qty'];
    $harga_modal +=$val['harga_modal'];
    $margin_total +=$val['margin_total'];
    $total +=$val['total'];
    
               } ?>
	<tr>
		<td class="auto-style13" colspan="12"><strong>TOTAL</strong></td>
                <td class="auto-style14"><strong><?= number_format($qty_in,0,',','.')?>
				</strong></td>
		<td class="auto-style14"><strong><?= number_format($qty_out,0,',','.')?>
		</strong></td>
		<td class="auto-style14"><strong><?= number_format($sisa_qty,0,',','.')?>
		</strong></td>
		<td class="auto-style14" colspan="2">&nbsp;</td>
		<td class="auto-style14"><strong><?= number_format($harga_modal,0,',','.')?>
		</strong></td>
		<td class="auto-style14" colspan="2">&nbsp;</td>
		<td class="auto-style14"><strong><?= number_format($margin_total,0,',','.')?>
		</strong></td>
		<td class="auto-style14">&nbsp;</td>
		<td class="auto-style14"><strong><?= number_format($total,0,',','.')?>
		</strong></td>
		<td class="auto-style14" colspan="2">&nbsp;</td>
		<td class="auto-style14">&nbsp;</td>
		<td class="auto-style14">&nbsp;</td>
		<td class="auto-style14">&nbsp;</td>
		<td class="auto-style14">&nbsp;</td>
	</tr>
</table>

</body>

</html>
