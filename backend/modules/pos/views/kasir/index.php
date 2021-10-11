<?php

use yii\bootstrap4\Html;
use yii\helpers\Url;
use yii\bootstrap4\Modal;
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
</hr>
<div id='pesan'> </div>
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
<?php
Modal::begin([
    'title' => 'Pembayaran',
    'toggleButton' => ['label' => 'click me', 'id' => 'bayar'],
]);
?>
<?= Html::textInput('no_invoice', $no_invoice, ['id' => 'no_invoice', 'class' => 'form-control', 'readOnly' => true]); ?>
<?= Html::textInput('totalbayar', null, ['id' => 'totalbayar', 'class' => 'form-control', 'readOnly' => true]); ?>
<?= Html::textInput('totaltunai', null, ['id' => 'totaltunai', 'class' => 'form-control', 'onKeyUp' => "hitunglagi(this.value)"]); ?>
<?= Html::textInput('totalkembali', null, ['id' => 'totalkembali', 'class' => 'form-control', 'readOnly' => true]); ?>
<?= Html::button('SELESAI', ['class' => 'btn btn-success', 'onClick' => 'bayari()']) ?>
<?php
Modal::end();
?>
<script>
    var tabel = document.getElementById('listtutukaran'),
            kode_barcode = document.getElementById('kode_barcode'),
            nama_item = document.getElementById('nama_item'),
            qty = document.getElementById('qty'),
            harga_satuan = document.getElementById('harga_satuan'),
            jumlah = document.getElementById('jumlah'),
            pesan = document.getElementById('pesan'),
            db, totalharga_satuan = 0, totalqty = 0;
    function buatDatabase() {
        var request = window.indexedDB.open('dataitem', 1);
        request.onerror = kesalahanHandler;
        request.onupgradeneeded = function (e) {
            var db = e.target.result;
            db.onerror = kesalahanHandler;
            var objectstore = db.createObjectStore('transaksibarang', {keyPath: 'kode_barcode'});
            pesan.innerHTML += 'sukses.<br>';
        }
        request.onsuccess = function (e) {
            db = e.target.result;
            db.onerror = kesalahanHandler;
            pesan.innerHTML += 'Berhasil melakukan koneksi ke database!<br>';
            bacaDariDatabase();
        }
    }

    buatDatabase();
    function cetakPesanHandler(msg) {
        return function (e) {
            pesan.innerHTML = msg + '<br>';
        }
    }

    function buatTransaksi() {
        var transaction = db.transaction(['transaksibarang'], 'readwrite');
        transaction.onerror = kesalahanHandler;
        transaction.oncomplete = cetakPesanHandler('Transaksi baru saja diselesaikan.');
        return transaction;
    }

    function tambahKeDatabase(transaksibarang) {
        console.log(transaksibarang);
        var objectstore = buatTransaksi().objectStore('transaksibarang');
        var request = objectstore.add(transaksibarang);
        request.onerror = kesalahanHandler;
        request.onsuccess = cetakPesanHandler('transaksibarang [' + transaksibarang.kode_barcode + '] telah ditambahkan ke database lokal.');
    }
    function ubahKeDatabase(transaksibarang) {
        var objectstore = buatTransaksi().objectStore('transaksibarang');
        var request = objectstore.put(transaksibarang);
        request.onerror = kesalahanHandler;
        request.onsuccess = cetakPesanHandler('transaksibarang [' + transaksibarang.kode_barcode + '] telah diubah ke database lokal.');
    }
    // Menampilkan dari database
    function bacaDariDatabase() {
        $("#listtutukaran").empty();
        var objectstore = buatTransaksi().objectStore('transaksibarang');
        let totalBatutukan = 0;
        objectstore.openCursor().onsuccess = function (e) {
            var result = e.target.result;
            if (result) {
                //        pesan.innerHTML += 'Membaca Transaksi [' + result.value.nim + '] dari database.<br>';
                var baris = tabel.insertRow();
                baris.id = result.value.kode_barcode;
                baris.insertCell().appendChild(document.createTextNode(result.value.nama_item));
                baris.insertCell().appendChild(document.createTextNode(result.value.qty));
                baris.insertCell().appendChild(document.createTextNode(nf.format(result.value.harga_satuan)));
                baris.insertCell().appendChild(document.createTextNode(nf.format(result.value.jumlah)));
                console.log(result.value.jumlah);
                totalBatutukan += parseInt(result.value.jumlah);
                $("#totalangka").html(nf.format(totalBatutukan))

                $("#totalbayar").val(totalBatutukan)
                var btnHapus = document.createElement('input');
                btnHapus.type = 'button';
                btnHapus.value = 'Hapus';
                btnHapus.id = result.value.kode_barcode;
                baris.insertCell().appendChild(btnHapus);

                result.continue();
            }
        }
    }

    // Hapus dari database
    function hapusDariDatabase(kode_barcode) {
        var objectstore = buatTransaksi().objectStore('transaksibarang');
        var request = objectstore.delete(kode_barcode);
        request.onerror = kesalahanHandler;
        request.onsuccess = cetakPesanHandler('Item Kode [' + kode_barcode + '] berhasil dihapus dari database lokal.');
    }
    function hapusBaris(e) {
        if (e.target.type == 'button') {
            tabel.deleteRow(tabel.rows.namedItem(e.target.id).sectionRowIndex);
            hapusDariDatabase(e.target.id);
            bacaDariDatabase();
        }
    }

    tabel.addEventListener('click', hapusBaris, true);
    function kesalahanHandler(e) {
        pesan = 'Kesalahan Database: ' + e.target.errorCode + '<br>';
    }

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
                        if (localStorage.getItem(item['kode_barcode'] + '|' +<?= $no_acak ?> + '|' + tgltransaksi) === null) {
                            qty = 1;

                        } else {
                            let QtySimpan = localStorage.getItem(item['kode_barcode'] + '|' +<?= $no_acak ?> + '|' + tgltransaksi);
                            let jsonLama = QtySimpan;
                            let QtyLama = jsonLama;
                            //        console.log(QtySimpan)
                            qty = parseInt(QtyLama) + 1;
//console.log(jsonLama['nama_barang']);
                        }
                        console.log(qty)
                        localStorage.setItem(item['kode_barcode'] + '|' +<?= $no_acak ?> + '|' + tgltransaksi, qty);
                        ///
                        $("#nama_item").val(item['nama_barang']);
                        $("#qty").val(qty);
                        $("#harga_satuan").val(item['harga_satuan']);
                        harga_jual = qty * item['harga_satuan'];
                        $("#jumlah").val(harga_jual);

                        $("#kode_barcodeold").val(item['kode_barcode']);
                        $("#nama_itemold").val(item['nama_barang']);
                        $("#qtyold").val(qty);
                        $("#harga_satuanold").val(item['harga_satuan']);
                        harga_jual = qty * item['harga_satuan'];
                        $("#jumlahold").val(nf.format(harga_jual));

                        // Periksa apakah NIM sudah ada
                        if (tabel.rows.namedItem(kode_barcode.value)) {
                            ubahKeDatabase({
                                id_data_barang: item['id_data_barang'],
                                kode_barcode: kode_barcode.value,
                                nama_item: nama_item.value,
                                qty: qty,
                                harga_satuan: harga_satuan.value,
                                jumlah: jumlah.value
                            });
                            bacaDariDatabase()
                        } else {
                            // Tambah ke database
                            tambahKeDatabase({
                                id_data_barang: item['id_data_barang'],
                                kode_barcode: kode_barcode.value,
                                nama_item: nama_item.value,
                                qty: qty,
                                harga_satuan: harga_satuan.value,
                                jumlah: jumlah.value
                            });
                            bacaDariDatabase()

                        }
                    }

                }

            });



        };
        if (evt.keyCode == 119) {
            $("#bayar").click();
        }
    }
    bayari = () => {
    var totalbayar = $("#totalbayar").val();
    var totaltunai = $("#totaltunai").val();
    var totalkembali = $("#totalkembali").val();
//    console.log(totalkembali);
//    return false;
        var objectstore = buatTransaksi().objectStore('transaksibarang');
        objectstore.openCursor().onsuccess = function (e) {
            var result = e.target.result;
            if (result) {
                $.get({
                    url: '<?= Url::to(['/transaksi-barang/update-kasir']) ?>',
                    data: {
                        kode_barkode: result.value.kode_barcode,
                        qty: result.value.qty,
                        id_data_barang: result.value.id_data_barang,
                        total_jual: result.value.jumlah,
                        no_invoice: <?= $no_invoice ?>,
                              totalbayar: totalbayar,
                       totaltunai: totaltunai,
                        totalkembali: totalkembali
                    },
                    success: function (data) {
                        console.log(data);
                    }
                })

                result.continue();
            }
        };
 $.get({
                    url: '<?= Url::to(['/transaksi-barang/update-kasir-jual-beli']) ?>',
                    data: {
                        no_invoice: <?= $no_invoice ?>,
                        totalbayar: totalbayar,
                       totaltunai: totaltunai,
                        totalkembali: totalkembali
                    },
                    success: function (data) {
                        console.log(data);
                    }
                });

    };
    
    hitunglagi = (tottunai) => {

        const totBayar = $("#totalbayar").val();
        const totTunai = tottunai - totBayar;
        console.log(totBayar);
        console.log(totTunai);
        $("#totalkembali").val(totTunai);
    }
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

