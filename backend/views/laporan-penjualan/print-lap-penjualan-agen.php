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
                mso-number-format:'\@';
            }
            .auto-style8 {
                text-align: center;
            }
            .auto-style9 {
                border-style: solid;
                border-width: 1px;
                text-align: center;
                background-color: #70D950;
                font-size: 8px;
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
                mso-number-format:'\@';
            }
            .auto-style15 {
                border-style: solid;
                border-width: 1px;
                text-align: center;
                background-color: #B0F87E;
                font-size: 8px;
            }
            .auto-style16 {
                border-style: solid;
                border-width: 1px;
                text-align: center;
                background-color: #CBD2FA;
                font-size: 8px;
            }
            .auto-style17 {
                border-style: solid;
                border-width: 1px;
                text-align: center;
                background-color: #C3A159;
                font-size: 8px;
            }
            .auto-style18 {
                border-style: solid;
                border-width: 1px;
                text-align: center;
                background-color: #ECFC70;
                font-size: 8px;
            }
            .auto-style19 {
                border-style: solid;
                border-width: 1px;
                text-align: center;
                background-color: #FCD570;
                font-size: 8px;
            }
            .auto-style20 {
                border-style: solid;
                border-width: 1px;
                text-align: center;
                background-color: #FC70A9;
                font-size: 8px;
            }
        </style>
    </head>

    <body>

        <p>No : <?= Yii::$app->request->get('no_acak') ?></p>
        <p class="auto-style8"><strong>LAPORAN PENJUALAN AGEN PROMO <?= strtoupper($dataToko['nama_toko']) ?></strong></p>
        <table id="table1" class="auto-style1">
            <tr>
                <td class="auto-style15" rowspan="5"><strong>NO</strong></td>
                <td class="auto-style15" rowspan="5"><strong>NO TRANSAKSI</strong></td>
                <td class="auto-style15" rowspan="5"><strong>TANGGAL TRANSAKSI</strong></td>
                <td class="auto-style15" rowspan="5"><strong>METODE PEMBAYARAN</strong></td>
                <td class="auto-style15" rowspan="2" colspan="2"><strong>REFERENSI AGEN PASOK</strong></td>
                <td class="auto-style15" colspan="3" style="height: 17px"><strong>HAK KEPEMILIKAN ITEM</strong></td>
                <td class="auto-style15" colspan="2" style="height: 17px">
				<strong>REFERENSI PEMBELI</strong></td>
                <td class="auto-style15" colspan="2" style="height: 17px"><strong>PEMBELI</strong></td>
                <td class="auto-style16" rowspan="5" style="width: 32px"><strong>TANGGAL BARANG MASUK</strong></td>
                <td class="auto-style16" rowspan="5"><strong>ITEM BARANG</strong></td>
                <td class="auto-style16" colspan="3" style="height: 17px"><strong>KETERANGAN</strong></td>
                <td class="auto-style16" style="height: 17px"><strong>TANGGAL</strong></td>
                <td class="auto-style17" colspan="3" style="height: 17px"><strong>(HPP)</strong></td>
                <td class="auto-style18" colspan="3" style="height: 17px"><strong>MARGIN</strong></td>
                <td class="auto-style19" colspan="2" style="height: 17px"><strong>PENJUALAN</strong></td>
                <td class="auto-style20" rowspan="2" colspan="6"><strong>BAGI HASIL PENJUALAN 
                        AGEN</strong></td>
                <td class="auto-style9" rowspan="2"><strong>NP</strong></td>
            </tr>
            <tr>
                <td class="auto-style15" colspan="2" style="height: 14px"><strong>AGEN PASOK</strong></td>
                <td class="auto-style15" rowspan="4"><strong>ITEM BARANG</strong></td>
                <td class="auto-style15" rowspan="4"><strong>NAMA</strong></td>
                <td class="auto-style15" rowspan="4"><strong>ID</strong></td>
                <td class="auto-style15" rowspan="4"><strong>NAMA</strong></td>
                <td class="auto-style15" rowspan="4" style="width: 29px"><strong>ID</strong></td>
                <td class="auto-style16" rowspan="4"><strong>MASUK</strong></td>
                <td class="auto-style16" rowspan="4"><strong>KELUAR</strong></td>
                <td class="auto-style16" rowspan="4"><strong>SISA</strong></td>
                <td class="auto-style16" rowspan="4"><strong>SISA BARANG</strong></td>
                <td class="auto-style17" rowspan="4"><strong>HARGA MODAL</strong></td>
                <td class="auto-style17" rowspan="2" colspan="2"><strong>TOTAL</strong></td>
                <td class="auto-style18" rowspan="4"><strong>%</strong></td>
                <td class="auto-style18" rowspan="4"><strong>ITEM</strong></td>
                <td class="auto-style18" rowspan="4"><strong>TOTAL</strong></td>
                <td class="auto-style19" rowspan="4"><strong>HARGA JUAL</strong></td>
                <td class="auto-style19" rowspan="4" style="width: 48px"><strong>TOTAL</strong></td>
            </tr>
            <tr>
                <td class="auto-style15" rowspan="3"><strong>NAMA</strong></td>
                <td class="auto-style15" rowspan="3"><strong>ID</strong></td>
                <td class="auto-style15" rowspan="3"><strong>NAMA</strong></td>
                <td class="auto-style15" rowspan="3"><strong>ID</strong></td>
                <td class="auto-style20" rowspan="2"><strong>PROMO</strong></td>
                <td class="auto-style20" rowspan="2"><strong>KANTOR BP</strong></td>
                <td class="auto-style20" style="width: 33px"><strong>PASOK</strong></td>
                <td class="auto-style20"><strong>NIAGA</strong></td>
                <td class="auto-style20"><strong>LAINNYA</strong></td>
                <td class="auto-style20" rowspan="2" style="width: 38px"><strong>TOTAL</strong></td>
                <td class="auto-style9">P/N/L</td>
            </tr>
            <tr>
                <td class="auto-style17" rowspan="2"><strong>TARGET</strong></td>
                <td class="auto-style17" rowspan="2"><strong>REALISASI</strong></td>
                <td class="auto-style20" style="width: 33px"><strong>BP</strong></td>
                <td class="auto-style20"><strong>BP</strong></td>
                <td class="auto-style20"><strong>BP</strong></td>
                <td class="auto-style9">LAINNYA</td>
            </tr>
            <tr>
                <td class="auto-style20"><strong>25%</strong></td>
                <td class="auto-style20"><strong>25%</strong></td>
                <td class="auto-style20" style="height: 17px; width: 33px;"><strong>25%</strong></td>
                <td class="auto-style20" style="height: 17px"><strong>18%</strong></td>
                <td class="auto-style20" style="height: 17px"><strong>7%</strong></td>
                <td class="auto-style20" style="width: 38px">100%</td>
                <td class="auto-style9">50%</td>
            </tr>

            <tr>
                <td class="auto-style15">&nbsp;</td>
                <td class="auto-style15" colspan="12"><strong>(I)</strong></td>
                <td class="auto-style16" colspan="6"><strong>(II)</strong></td>
                <td class="auto-style17" colspan="3"><strong>(III)</strong></td>
                <td class="auto-style18" colspan="3"><strong>(IV)</strong></td>
                <td class="auto-style19" colspan="2"><strong>(V)</strong></td>
                <td class="auto-style20" colspan="6"><strong>(VI)</strong></td>
                <td class="auto-style9"><strong>(VII)</strong></td>
            </tr>
            <?php
            $no = 1;
            $qty_in = 0;
            $qty_out = 0;
            $sisa_qty = 0;
            $harga_modal = 0;
            $margin_total = 0;
            $total = 0;

            foreach ($query as $val) {

                $dataItemPasok = (new \yii\db\Query())
                        ->select('b.no_acak,c.nama_agen,c.id_agen,a.item_barang,c.no_acak_ref')
                        ->from('data_barang a')
                        ->innerJoin('data_item_barang_agen b', 'a.id=b.id_data_barang')
                        ->innerJoin('data_agen c', 'b.no_acak=c.no_acak')
                        ->where(['a.id' => $val['id_data_barang'],
                    'b.id_data_barang' => $val['id_data_barang']
                ]);
                $pemilik=false;
                if ($dataItemPasok->exists()) { //pemiliik item
                    $itemPasok = $dataItemPasok->one();
                    $namaAgen = $itemPasok['nama_agen'];
                    $idAgen = $itemPasok['id_agen'];
                    $itemBarang = $itemPasok['item_barang'];
                    $no_acak_ref = $itemPasok['no_acak_ref'];
                    $pemilik=true;
                } else {
                    $namaAgen = 'NON PASOK';
                    $idAgen = 'BP';
                    $itemBarang = '-';
                    $no_acak_ref = '-';
                }
                $dataAgenReferensi = \backend\models\DataAgen::find()->where([
                    'no_acak' => $no_acak_ref
                ]);
                if ($dataAgenReferensi->exists()) {
                    $dataAgenReferensi = $dataAgenReferensi->one();
                    $namaAgenRef = $dataAgenReferensi['nama_agen'];
                    $idAgenRef = $dataAgenReferensi['id_agen'];
                } else {
                    $namaAgenRef = '-';
                    $idAgenRef = '-';
                }

                $namaAgenPembeli = '-';
                $idAgenPembeli = '-';
                $dataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $val['no_acak_pembeli']]);
                $namaAgenRefPembeli ='';
                $IdAgenRefPembeli ='';
                
                if ($dataAgen->exists()) {
                    $dataAgen = $dataAgen->one();
                    $idAgenPembeli = $dataAgen['id_agen'];
                    $namaAgenPembeli = $dataAgen['nama_agen'];
                    
                    $no_acak_refPem = $dataAgen['no_acak_ref'];
                    $dataCekAgen = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak_refPem]);
                    if($dataCekAgen->exists()){
                        $dataAgenRefPem = $dataCekAgen->one();
                        $namaAgenRefPembeli =$dataAgenRefPem['nama_agen'];;
                $IdAgenRefPembeli =$dataAgenRefPem['id_agen'];;
                    }
                
                }
                //  cek metode pembayaran
                $detailPembayaran = \backend\models\DetailPembayaran::find()
                        ->alias('a')
                        ->select('a.*,b.ket as nama_metode_pembayaran')
                       ->innerJoin('metode_pembayaran b','a.id_metode_pembayaran=b.id')
                        ->where(['a.no_invoice'=>$val['no_invoice']])->one();
                ?>
                <tr>		
                    <td class="auto-style7" style="height: 27px"><?= $no++ ?></td>
                    <td class="auto-style7" style="height: 27px"><?= $val['no_invoice'] ?></td>

                    <td class="auto-style7" ><?= $val['tgl_transaksi'] ?></td>


                    <td class="auto-style7" ><?=$detailPembayaran['nama_metode_pembayaran']?></td>


                    <td class="auto-style7"><?= $namaAgenRef ?></td>

                    <td class="auto-style7" style="height: 27px"><?= $idAgenRef ?></td>
                    <td class="auto-style7" style="height: 27px"><?= $namaAgen ?></td>
                    <td class="auto-style7" style="height: 27px"><?= $idAgen ?></td>
                    <td class="auto-style7" style="height: 27px"><?= $itemBarang ?></td>
                    <td class="auto-style7" style="height: 27px"><?=$namaAgenRefPembeli?></td>
                    <td class="auto-style7" style="height: 27px"><?=$IdAgenRefPembeli?></td>
                    <td class="auto-style7" style="height: 27px"><?= $namaAgenPembeli ?></td>
                    <td class="auto-style7" style="height: 27px; width: 29px;"><?= $idAgenPembeli ?></td>
                    <td class="auto-style7" style="height: 27px; width: 32px;"><?= $val['tgl_masuk'] ?>
                    </td>
                    <td class="auto-style7" style="height: 27px"><?= $val['nama_barang'] ?>
                    </td>
                    <td class="auto-style7" style="height: 27px"><?= $val['qty_in'] ?></td>
                    <td class="auto-style7" style="height: 27px"><?= $val['qty_out'] ?></td>
                    <td class="auto-style7" style="height: 27px"><?= $val['sisa_qty'] ?></td>
                    <td class="auto-style7" style="height: 27px"><?= $val['tgl_keluar'] ?></td>
                    <td class="auto-style7" style="height: 27px"><?= number_format($val['harga_satuan'], 0, ',', '.') ?>
                    </td>
                    <td class="auto-style7" style="height: 27px"><?= number_format($val['harga_modal'], 0, ',', '.') ?>
                    </td>
                    <td class="auto-style7" style="height: 27px"><?= number_format((int) $val['harga_satuan'] * (int) $val['qty_out'], 0, ',', '.') ?>
                    </td>
                    <td class="auto-style7" style="height: 27px"><?= $val['nilai'] ?></td>
                    <td class="auto-style7" style="height: 27px"><?= number_format($val['margin_item'], 0, ',', '.') ?></td>
                    <td class="auto-style7" style="height: 27px"><?= number_format($val['margin_total'], 0, ',', '.') ?>
                    </td>
                    <td class="auto-style7" style="height: 27px"><?= number_format($val['harga_jual'], 0, ',', '.') ?>
                    </td>
                    <td class="auto-style7" style="height: 27px; width: 48px;"><?= number_format($val['total'], 0, ',', '.') ?>
                    </td>
                    <td class="auto-style7" style="height: 27px"><?= number_format($val['nominal1'], 0, ',', '.') ?>
                    </td>
                    <td class="auto-style7" style="height: 27px"><?= number_format($val['nominal1'], 0, ',', '.') ?></td>
                    <td class="auto-style7" style="height: 27px; width: 33px;"><?= number_format($val['nominal1'], 0, ',', '.') ?>
                    </td>
                    <td class="auto-style7" style="height: 27px"><?= number_format($val['nominal2'], 0, ',', '.') ?>
                    </td>
                    <td class="auto-style7" style="height: 27px"><?= number_format($val['nominal3'], 0, ',', '.') ?>
                    </td>
                    <td class="auto-style7" style="height: 27px; width: 38px;">
    <?= number_format($val['nominal1'] + $val['nominal1'] + $val['nominal1'] + $val['nominal2'] + $val['nominal3'], 0, ',', '.') ?></td>
                    <td class="auto-style7" style="height: 27px">
                        <?php
                        if($pemilik){
                            $totallainnya =  $val['nominal2'] + $val['nominal3'];
                        }else{
                            $totallainnya = $val['nominal1'] + $val['nominal2'] + $val['nominal3'];
                        }
                        echo number_format($totallainnya, 0, ',', '.') ?></td>

                </tr>
    <?php
    $qty_in += $val['qty_in'];
    $qty_out += $val['qty_out'];
    $sisa_qty += $val['sisa_qty'];
    $harga_modal += $val['harga_modal'];
    $margin_total += $val['margin_total'];
    $total += $val['total'];
}
?>
            <tr>
                <td class="auto-style13">&nbsp;</td>
                <td class="auto-style13" colspan="14"><strong>TOTAL</strong></td>
                <td class="auto-style14"><strong><?= number_format($qty_in, 0, ',', '.') ?>
                    </strong></td>
                <td class="auto-style14"><strong><?= number_format($qty_out, 0, ',', '.') ?>
                    </strong></td>
                <td class="auto-style14"><strong><?= number_format($sisa_qty, 0, ',', '.') ?>
                    </strong></td>
                <td class="auto-style14">&nbsp;</td>
                <td class="auto-style14">&nbsp;</td>
                <td class="auto-style14" colspan="2"><strong><?= number_format($harga_modal, 0, ',', '.') ?>
                    </strong></td>
                <td class="auto-style14">&nbsp;</td>
                <td class="auto-style14">&nbsp;</td>
                <td class="auto-style14"><strong><?= number_format($margin_total, 0, ',', '.') ?>
                    </strong></td>
                <td class="auto-style14">&nbsp;</td>
                <td class="auto-style14" style="width: 48px"><strong><?= number_format($total, 0, ',', '.') ?>
                    </strong></td>
                <td class="auto-style14">&nbsp;</td>
                <td class="auto-style14">&nbsp;</td>
                <td class="auto-style14" style="width: 33px">&nbsp;</td>
                <td class="auto-style14">&nbsp;</td>
                <td class="auto-style14">&nbsp;</td>
                <td class="auto-style14" style="width: 38px">&nbsp;</td>
                <td class="auto-style14">&nbsp;</td>
            </tr>
        </table>

    </body>

</html>
