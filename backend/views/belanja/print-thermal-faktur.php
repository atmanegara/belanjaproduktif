<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
        <title>Receipt example</title>
        <style>
            
  @page { size: 90mm 100mm } /* output size */
    body.receipt .sheet { width: 90mm;  } /* sheet size */
    @media print { body.receipt { width: 90m } } /* fix for Chrome */
            * {
    font-size: 18px;
    font-family: 'Times New Roman';
}

td,
th,
tr,
table {
    border-top: 0px solid black;
    border-collapse: collapse;
}

td.description,
th.description {
    width: 30%;
}

td.quantity,
th.quantity {
    width: 10%;
    word-break: break-all;
    text-align: center;
    align-content: center;
}

td.price,
th.price {
    width: 10%;
    word-break: break-all;
}

.centered {
    text-align: center;
    align-content: center;
}

.ticket {
    width: 155px;
    max-width: 155px;
}

img {
    max-width: inherit;
    width: inherit;
}
@media print {
    .hidden-print,
    .hidden-print * {
        display: none !important;
    }
}
        </style>
    </head>
    <body class="receipt" onload="setprint()">
        <section class="sheet">
            
                <br><br><br>
                <br><br><br>
            <div style="text-align: center">
            <img src="<?= Yii::getAlias('@web/poto') ?>/logo.png" alt="Logo" style="width:100px;height: 100px;">
            </div>
                 <p class="centered">   
<?=$dataToko['nama_toko']?>   
                <br>
               <?=$dataToko['alamat']?>
                </p>
            <table>
                <hr>
                </table>
				<table id="table1" style="width: 100%">
					<tr>
                                            <td class="price"><?= date('d-m-Y')?></td>
						<td class="quantity"><?=date('h:i:s')?></td>
					</tr>
					<tr>
						<td class="price">Transaksi</td>
						<td class="quantity">#<?php echo $detailPembayaran['no_invoice']?></td>
					</tr>
					<tr>
						<td class="price">Kasir</td>
						<td class="quantity"><?=$kasir?></td>
					</tr>

				</table>
									<hr />
				<table>
                <tbody>
                
                        <?php 
                                    $total=0;
                                    $jumItem=0;
                                    foreach ($dataItem as $item){
                                    $jumItem++;
                                    $total += $item['total'];
                                        ?>
                    <tr>
                        <td colspan="3"><?=$item['nama_item']?></td>
                    </tr>
                    <tr>
                              <td class="price"><?=number_format($item['harga_jual'],0,',','.')?></td>
                        <td class="quantity"> X <?=$item['qty']?></td>
                           <td class="price"><?=number_format($item['total'],0,',','.')?></td>
                       </tr>
                        <tr>
                            <td colspan="3"></td>
                    </tr>
                                    <?php } ?>
                    <tr>
                     <tr>
                            <td colspan="3"><small>Jumlah Item : <?=$jumItem?></small></td>
                    </tr>
 <tr>
                            <td colspan="3"><br></td>
                    </tr>

                       <td class="description">TOTAL BELANJA</td>
                        <td class="quantity"></td>
                         <td class="price"> <?= number_format($total,0,',','.')?></td>
                    </tr>
                     <tr>
                        <td class="description">TUNAI</td>
                        <td class="quantity"></td>
                        <td class="price"> <?= number_format($dataTransaksiPembayaran['duit_tunai'],0,',','.')?></td>
                    </tr>
                      <tr>
                       <td class="description">KEMBALI</td>
                         <td class="quantity"></td>
                        <td class="price"> <?= number_format($dataTransaksiPembayaran['duit_kembali'],0,',','.')?></td>
                    </tr>
                </tbody>
            </table>
               <p class="centered">TERIMA KASIH
                <br>
                
                </p>
                <br><br><br>
                <br><br><br>
                <br><br><br>
        </section>
      </div>
    </body>
</html>
<script>
const setprint=()=>{
    window.print();
    window.focus();
 // window.close();
}
</script>