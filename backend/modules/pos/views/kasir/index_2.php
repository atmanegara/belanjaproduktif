<?php

use yii\bootstrap4\Html;
use yii\helpers\Url;

?>
<div style="width:auto;height: 100px;border: 1px;border-color: blueviolet;border-style:dashed">
    <div id="totalangka" style="text-align: right;font-size: 80px">0</div>

</div>
<hr />
<table border="0">
    <tr>
        <td style="width: 100%" colspan="5"><?=
            Html::textInput('kode_barcode', null, [
                'id' => 'kode_barcode',
                'style' => 'width:225px',
                    //  'onkeyd' => 'getBarangEnter(this.value)'
            ])
            ?></td>
        <td style="width: 10px"><?=
            Html::hiddenInput('nama_item', null, [
                'id' => 'nama_item',
                'style' => 'width:660px'
            ])
            ?>
            <?=
            Html::hiddenInput('qty', null, [
                'id' => 'qty'
            ])
            ?>
            <?=
            Html::hiddenInput('harga_satuan', null, [
                'id' => 'harga_satuan'
            ])
            ?>
            <?=
            Html::hiddenInput('jumlah', null, [
                'id' => 'jumlah'
            ])
            ?></td>
    </tr>


</table>
<table border="0">

    <tr>
        <td style="width: 100%"><?=
            Html::textInput('kode_barcodeold', null, [
                'id' => 'kode_barcodeold',
                'style' => 'width:225px',
                    //  'onkeyd' => 'getBarangEnter(this.value)'
            ])
            ?></td>
        <td style="width: 10px"><?=
            Html::textInput('nama_itemold', null, [
                'id' => 'nama_itemold',
                'style' => 'width:660px'
            ])
            ?></td>
        <td style="width: 10%"><?=
            Html::textInput('qtyold', null, [
                'id' => 'qtyold'
            ])
            ?></td>
        <td style="width: 10%"><?=
            Html::textInput('harga_satuanold', null, [
                'id' => 'harga_satuanold'
            ])
            ?></td>
        <td style="width: 10%"><?=
            Html::textInput('jumlahold', null, [
                'id' => 'jumlahold'
            ])
            ?></td>
    </tr>

</table>
<div style="margin-top: 10px;overflow-y: scroll; min-height: 390px;
  max-height: 390px;" >
    <table class="table table-bordered">

        <div >
        <tbody id="listtutukaran">  

        </tbody>
    </table>

</div>
         <table>
                <tr>
                    <td style="width: 80%"></td>
                    <td style="width: 4%">Total</td>
               
                    <td >:</td>
                    <td>aasdasdasd</td>
                </tr>
                <tr>
                    <td style=""></td>
                    <td style="">Bayar</td>
                 
                    <td >:</td>
                    <td>asdasdsada</td>
                </tr>
                <tr>
                    <td style=""></td>
                    <td style="">Kembali</td>
              
                    <td >:</td>
                    <td style="">asdasdasdasda</td>
                </tr>
            </table>
<?= Html::button('Bayar',['class'=>"btn btn-success showModalButton",'value'=> Url::to(['bayar-tunai']),'id'=>"bayar"])?>
<script>
    let nf = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    });
    var qty = 0;
    document.onkeyup = function (evt) {
//        console.log(evt);
//        console.log(evt.keyCode);
        //  document.getElementById("kode_barcode").value='';
        var kode_barcode = document.getElementById("kode_barcode");
        if (evt.keyCode == 13)// Enter key pressed
        {
            $.post({
                url: '<?= Url::to(['get-barang-barcode']) ?>',
                data: {
                    kode_barcode: kode_barcode.value
                },
                success: function (dataHtml) {
                    const item = JSON.parse(dataHtml);
                    const tgltransaksi = '<?= date('Ymd') ?>';
                    if (item['message'] == false) {
                        $("#nama_item").val('');
                        $("#qty").val(0);
                        $("#harga_satuan").val(0);
                        $("#jumlah").val(0);
                        return false;
                    } else {
console.log(localStorage.getItem(item['kode_barcode']));
                        if (localStorage.getItem(item['kode_barcode']+'|'+<?=$no_acak?>+'|'+tgltransaksi) === null) {
                            qty = 1;

                        } else {
                            let QtySimpan = localStorage.getItem(item['kode_barcode']+'|'+<?=$no_acak?>+'|'+tgltransaksi);
                            let jsonLama = JSON.parse(QtySimpan);
                            let QtyLama = jsonLama['qty'];
                            //        console.log(QtySimpan)
                            qty = parseInt(QtyLama) + 1;
//console.log(jsonLama['nama_barang']);
                        }

                        $("#nama_item").val(item['nama_barang']);
                        $("#qty").val(qty);
                        $("#harga_satuan").val(item['harga_satuan']);
                        harga_jual = qty * item['harga_satuan'];
                        $("#jumlah").val(harga_jual);
                        const itemtransaksi = {
                            kode_barcode: item['kode_barcode'],
                            nama_barang: item['nama_barang'],
                            qty: qty,
                            harga_jual: harga_jual
                        };
                        localStorage.setItem(item['kode_barcode']+'|'+<?=$no_acak?>+'|'+tgltransaksi, JSON.stringify(itemtransaksi));
                        kode_barcode.focus();
                        $("#kode_barcode").val('');
                        $("#nama_item").val('');
                        $("#qty").val(0);
                        $("#harga_satuan").val(0);
                        $("#jumlah").val(0);
                        ///
                        $("#kode_barcodeold").val(item['kode_barcode']);
                        $("#nama_itemold").val(item['nama_barang']);
                        $("#qtyold").val(qty);
                        $("#harga_satuanold").val(item['harga_satuan']);
                        harga_jual = qty * item['harga_satuan'];
                                  $("#jumlahold").val(nf.format(harga_jual));
                    }
                    tabeltutukaran();
                    tex();
                }

            })

        }
        
         if(evt.keyCode==119){
     $("#bayar").click();   
     $("#dynamicmodel-totalbayar").val('11212')
    }
    };
   
</script>
<script>

    tex = () => {
        let totalBatutukan = 0;
        for (let i = 0; i < localStorage.length; i++) {
            //       console.log(localStorage.length);
            let key = localStorage.key(i);
            let DataLama = JSON.parse(localStorage.getItem(key));
            totalBatutukan += DataLama['harga_jual'];
        }
        $("#totalangka").html(nf.format(totalBatutukan))
    }
</script>

<script>
    tabeltutukaran = () => {

        let htmltutukaran = 0;
        for (let i = 0; i < localStorage.length; i++) {
            //       console.log(localStorage.length);
            let key = localStorage.key(i);
            let DataLama = JSON.parse(localStorage.getItem(key));
            htmltutukaran += "<tr>" +
                    "<td>" + DataLama['nama_barang'] + "</td>" +
                    "<td>" + DataLama['qty'] + "</td>" +
                    "<td>" + nf.format(DataLama['harga_jual']) + "</td>" +
                    "</tr>";
        }
        $("#listtutukaran").html(htmltutukaran)
    }
</script>

