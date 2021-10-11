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
}
.auto-style10 {
	border-style: solid;
	border-width: 1px;
	text-align: center;
	width: 129px;
	background-color: #EDEDED;
}
.auto-style11 {
	border-style: solid;
	border-width: 1px;
	width: 129px;
}
.auto-style12 {
	border-style: solid;
	border-width: 1px;
	background-color: #EDEDED;
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
		<td class="auto-style12" rowspan="2"><strong>NO</strong></td>
		<td class="auto-style12" rowspan="2"><strong>KETERANGAN</strong></td>
		<td class="auto-style12" rowspan="2"><strong>HAK KEPEMILIKAN ITEM</strong></td>
		<td class="auto-style10" rowspan="2"><strong>TANGGAL BARANG MASUK</strong></td>
		<td class="auto-style9" colspan="3"><strong>KETERANGAN</strong></td>
		<td class="auto-style9"><strong>TANGGAL</strong></td>
		<td class="auto-style9" colspan="2"><strong>(HPP)</strong></td>
		<td class="auto-style9" colspan="3"><strong>MARGIN</strong></td>
		<td class="auto-style9" colspan="2"><strong>PENJUALAN</strong></td>
		<td class="auto-style9" rowspan="2"><strong>PEMBELI</strong></td>
	</tr>
	<tr>
		<td class="auto-style12"><strong>MASUK</strong></td>
		<td class="auto-style12"><strong>KELUAR</strong></td>
		<td class="auto-style12"><strong>SISA</strong></td>
		<td class="auto-style12"><strong>SISA BARANG</strong></td>
		<td class="auto-style12"><strong>HARGA MODAL</strong></td>
		<td class="auto-style12"><strong>TOTAL</strong></td>
		<td class="auto-style12"><strong>%</strong></td>
		<td class="auto-style12"><strong>ITEM</strong></td>
		<td class="auto-style12"><strong>TOTAL</strong></td>
		<td class="auto-style12"><strong>HARGA JUAL</strong></td>
		<td class="auto-style12"><strong>TOTAL</strong></td>
	</tr>
    <?php 
    $no=1;
    $qty_in=0;
    $qty_out =0;
    $sisa_qty=0;
    $harga_modal=0;
    $margin_total=0;
    $total=0;
    
    foreach($query as $val){ ?>
	<tr>
		<td class="auto-style7"><?=$no++?></td>
		<td class="auto-style7"><?=$val['nama_barang']?></td>
		<td class="auto-style7"><?php
             
                $dataItemPasok =(new \yii\db\Query())
                        ->select('b.no_acak,c.nama_agen')
->from('data_barang a')
->innerJoin('data_item_barang_agen b','a.id=b.id_data_barang')
                        ->innerJoin('data_agen c','b.no_acak=c.no_acak')
                        ->where(['a.id'=>$val['id_data_barang'],
                            'b.id_data_barang'=>$val['id_data_barang']
                            ]);
               if($dataItemPasok->exists()){
                   $itemPasok = $dataItemPasok->one();
                   $namaAgen = $itemPasok['nama_agen'];
               }else{
                   $namaAgen = '-';
               }
                echo $namaAgen?></td>
		<td class="auto-style11"><?=$val['tgl_masuk']?></td>
		<td class="auto-style7"><?=$val['qty_in']?></td>
		<td class="auto-style7"><?=$val['qty_out']?></td>
		<td class="auto-style7"><?=$val['sisa_qty']?></td>
		<td class="auto-style7"><?=$val['tgl_keluar']?></td>
		<td class="auto-style7"><?=number_format($val['harga_satuan'],0,',','.')?></td>
		<td class="auto-style7"><?=number_format($val['harga_modal'],0,',','.')?></td>
		<td class="auto-style7"><?=$val['nilai']?></td>
		<td class="auto-style7"><?=number_format($val['margin_item'],0,',','.')?></td>
		<td class="auto-style7"><?=number_format($val['margin_total'],0,',','.')?></td>
		<td class="auto-style7"><?=number_format($val['harga_jual'],0,',','.')?></td>
		<td class="auto-style7"><?=number_format($val['total'],0,',','.')?></td>
                <td class="auto-style7"><?php
                $namaAgen='-';
                $dataAgen = \backend\models\DataAgen::find()->where(['no_acak'=>$val['no_acak_pembeli']]);
                if($dataAgen->exists()){
                    $dataAgen = $dataAgen->one();
                    $namaAgen = $dataAgen['nama_agen'];
                }
                echo $namaAgen;
                ?></td>
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
		<td class="auto-style13" colspan="4"><strong>TOTAL</strong></td>
                <td class="auto-style14"><strong><?= number_format($qty_in,0,',','.')?>
				</strong></td>
		<td class="auto-style14"><strong><?= number_format($qty_out,0,',','.')?>
		</strong></td>
		<td class="auto-style14"><strong><?= number_format($sisa_qty,0,',','.')?>
		</strong></td>
		<td class="auto-style14" colspan="2"><strong></strong></td>
		<td class="auto-style14"><strong><?= number_format($harga_modal,0,',','.')?>
		</strong></td>
		<td class="auto-style14" colspan="2"><strong></strong></td>
		<td class="auto-style14"><strong><?= number_format($margin_total,0,',','.')?>
		</strong></td>
		<td class="auto-style14"><strong></strong></td>
		<td class="auto-style14"><strong><?= number_format($total,0,',','.')?>
		</strong></td>
		<td class="auto-style14">&nbsp;</td>
	</tr>
</table>

</body>

</html>
