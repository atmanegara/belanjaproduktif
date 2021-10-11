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
    body.receipt .sheet { width: 90mm; height: 100mm } /* sheet size */
    @media print { body.receipt { width: 90m } } /* fix for Chrome */
            * {
    font-size: 18px;
    font-family: 'Times New Roman';
}

td,
th,
tr,
table {
    border-top: 1px solid black;
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
        </style>
    </head>
    <body class="receipt" onload="setprint()">
        <section class="sheet">
            <p class="centered">STRUK BELANJA 
                <?=$dataToko['alamat']?>
                <br>
                #<?php echo $detailPembayaran['no_invoice']?>
              </p>
            <table>
                <thead>
                    <tr>
                        <th class="quantity">Q</th>
                        <th class="description">Item</th>
                        <th class="price">Rp</th>
                    </tr>
                </thead>
                <tbody>
                        <?php 
                                    $total=0;
                                    foreach ($dataItem as $item){
                                    $total += $item['total'];
                                        ?>
                    <tr>
                        <td class="quantity"> <?=$item['qty']?></td>
                        <td class="description"><?=$item['nama_item']?></td>
                        <td class="price"><?=number_format($item['harga_jual'],0,',','.')?></td>
                    </tr>
                                    <?php } ?>
                    <tr>
                        <td class="quantity"></td>
                        <td class="description">TOTAL</td>
                        <td class="price"> <?= number_format($total,0,',','.')?></td>
                    </tr>
                </tbody>
            </table>
        </section>
            <p class="centered">TERIMA KASIH TELAH BERBELANJA</p>
      </div>
    </body>
</html>
<script>
const setprint=()=>{
    window.focus();
    window.print();
  //  window.close();
}
</script>