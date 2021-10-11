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
</style>
</head>

<body>

<p>LIST PESANAN</p>
<p>
    NO PESANAN : <?=$no_acak?>
</p>
<table id="table1" class="auto-style1">
	
    <?php 
    $no=1;
    foreach($query as $val){
        echo "<tr><td  colspan='5'>".$val['nama_agen']."</td></tr>";
        echo "<tr>
		<td class='auto-style2'>NO</td>
		<td class='auto-style2'>NAMA ITEM BARANG</td>
		<td class='auto-style2'>QTY</td>
		<td class='auto-style2'>SATUAN</td>
		<td class='auto-style2'>SUPLIER</td>
	</tr>";
        $catatanBarang = \backend\models\CatatanBarang::find()->where(['no_acak'=>$no_acak])->all();
        foreach ($catatanBarang as $valcatatan){
        ?>
        
	<tr>
		<td class="auto-style2"><?=$no++?></td>
                <td class="auto-style2"><?php
                $cekBarang = backend\models\RefBarang::find()->where(['id'=>$valcatatan['id_ref_barang']]);
                        if($cekBarang->exists()){
                            $refBarang = $cekBarang->one();
                            $nama_barang = $refBarang['nama_barang'];
                        }else{
                            $nama_barang='-';
                        }
                  echo      $nama_barang?></td>
		<td class="auto-style2"><?=$valcatatan['qty']?></td>
                <td class="auto-style2"><?= backend\models\RefSatuanBarang::findOne($valcatatan['id_ref_satuan'])->nama_satuan?></td>
                <td class="auto-style2"><?= backend\models\RefSuplier::findOne($valcatatan['id_ref_suplier'])->nama_suplier?></td>
	</tr>
    <?php }}?>
</table>

</body>

</html>
