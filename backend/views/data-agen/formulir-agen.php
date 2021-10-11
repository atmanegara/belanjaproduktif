<?php

use backend\models\Franchice;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta content="en-us" http-equiv="Content-Language" />
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <title>Untitled 1</title>
        <style type="text/css">
            .auto-style2 {
                border-style: solid;
                border-width: 1px;
                text-align: center;
            }
            .auto-style3 {
                width: 100%;
                border-collapse: collapse;
            }
            .auto-style13 {
                border-left-style: none;
                border-left-width: medium;
                border-right-style: solid;
                border-right-width: 1px;
                border-top-style: solid;
                border-top-width: 1px;
                border-bottom-style: solid;
                border-bottom-width: 1px;
            }
            .auto-style15 {
                text-align: center;
            }
            body {
                margin-left: 60px;
                margin-right: 60px;
                margin-top: 20px;
                margin-bottom: 16px;
            }
            .auto-style19 {
                margin-left: 8px;
            }
            .auto-style25 {
                width: 295px;
                border-style: solid;
                border-width: 1px;
            }
            .auto-style27 {
                width: 259px;
                border-left-style: none;
                border-left-width: medium;
                border-right-style: none;
                border-right-width: medium;
                border-top-style: solid;
                border-top-width: 1px;
                border-bottom-style: solid;
                border-bottom-width: 1px;
            }
            .auto-style28 {
                border-style: solid;
                border-width: 1px;
            }
            .auto-style29 {
                width: 259px;
                border-left-style: none;
                border-left-width: medium;
                border-right-style: solid;
                border-right-width: 1px;
                border-top-style: solid;
                border-top-width: 1px;
                border-bottom-style: solid;
                border-bottom-width: 1px;
            }
            .auto-style30 {
                width: 100%;
            }
            .auto-style31 {
                height: 26px;
            }
            .auto-style32 {
                width: 171px;
            }
            .auto-style33 {
                width: 404px;
            }
            .auto-style34 {
                width: 404px;
                text-align: center;
            }
        .auto-style35 {
			border-left-style: none;
			border-left-width: medium;
			border-top-style: solid;
			border-top-width: 1px;
			border-bottom-style: solid;
			border-bottom-width: 1px;
                border-right-style: solid;
                border-right-width: 1px;
		}
        </style>
    </head>

    <body>
        <div class="page" style="height:950px; border: 1px solid #ddd; margin: auto; width: 100%; padding: 2%; margin: 0px 0">

            <table id="table5" class="auto-style3">
                <tr>
                    <td rowspan="7" class="auto-style32">  
					<img src="<?= Yii::getAlias('@sourcePathImg/') . $modelFotoProfil['filename']; ?>" alt="" height="133" width="123" ></img></td>
                    <td><strong><?= $modelTentangKami['nama_cv'] ?>
                        </strong></td>
                    <td><b><?= strtoupper(backend\models\RefAgen::findOne($modelDataAgen['id_ref_agen'])->nama_agen); ?></b></td>
                </tr>
                <tr>
                    <td><?= $modelTentangKami['alamat_cv'] ?></td>
                    <td rowspan="6">
					<img src="<?= Yii::getAlias('@sourcePathImg/') . $modelDataAgen['filename']; ?>" alt="" class="auto-style19" height="126" width="119"></img></td>
                </tr>
                <tr>
                    <td>Marketing : <?= $modelTentangKami['telp_marketting'] ?></td>
                </tr>
                <tr>
                    <td>Email : <?= $modelTentangKami['email'] ?></td>
                </tr>
                <tr>
                    <td>Admin : <?= $modelTentangKami['telp_admin'] ?></td>
                </tr>
                <tr>
                    <td style="height: 11px"><?= $modelTentangKami['kontak_lainnya'] ?></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                </table>

            <p class="auto-style15"><strong>FORMULIR PENDAFTARAN AGEN</strong></p>
            <table id="table2" class="auto-style3">
                <tr>
                    <td class="auto-style25"><strong>ID REFERNSI / NAMA</strong></td>
                    <td class="auto-style29"><?php
//                        $dataDetailAgen = frontend\models\DataDetailAgen::find()->where(['no_acak' => $no_acak]);
//                        if($dataDetailAgen->exists()){
//                            $detail = $dataDetailAgen->one();
//                            $id_refer = $detail['id_referensi_agen'];
//                        $dataAgenn = backend\models\DataAgen::find()->where(['id_agen' => $id_refer])->one();
//                        }else{
                            $datAnggota = \backend\models\DataAnggota::find()->where(['no_acak'=>$no_acak])->one();
                            $dataAgenn = \backend\models\DataAgen::find()->where(['no_acak'=>$datAnggota['no_acak_agen']])->one();
                            $id_refer = $dataAgenn['id_agen'];
//                        }
                        echo $id_refer;
                        $namaagenref = $dataAgenn['nama_agen'];
                        ?></td>
                    <td class="auto-style28" colspan="2"><?php echo $namaagenref ?></td>
                </tr>
                <tr>
                    <td class="auto-style25"><strong>ID AGEN / NAMA</strong></td>
                    <td class="auto-style29"><?php echo $modelDataAgen['id_agen'] ?></td>
                    <td class="auto-style28" colspan="2"><?php echo $modelDataAgen['nama_agen'] ?></td>
                </tr>
                <tr>
                    <td class="auto-style25"><strong></strong></td>
                    <td class="auto-style29">&nbsp;</td>
                    <td class="auto-style28" colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td class="auto-style2" colspan="4"><strong>DATA PRIBADI</strong></td>
                </tr>
                <tr>
                    <td class="auto-style25"><strong>NAMA</strong></td>
                    <td class="auto-style27"><?php echo $modelDataAgen['nama_agen'] ?></td>
                    <td class="auto-style13" colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td class="auto-style25"><strong>NIK</strong></td>
                    <td class="auto-style27"><?php echo $modelDataAgen['nik'] ?></td>
                    <td class="auto-style13" colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td class="auto-style25"><strong>ALAMAT</strong></td>
                    <td class="auto-style27"><?php echo $modelDataAgen['alamat'] ?></td>
                    <td class="auto-style13" colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td class="auto-style25"><strong>RT / RW</strong></td>
                    <td class="auto-style27"><?php echo $modelDataAgen['rt'] . '/' . $modelDataAgen['rw'] ?></td>
                    <td class="auto-style13" colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td class="auto-style25"><strong>KELURAHAN</strong></td>
                    <td class="auto-style27"><?php echo $modelDataAgen->kelurahan->nama ?></td>
                    <td class="auto-style13" colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td class="auto-style25"><strong>KECAMATAN</strong></td>
                    <td class="auto-style27"><?php echo $modelDataAgen->kecamatan->nama ?></td>
                    <td class="auto-style13" colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td class="auto-style25"><strong>TEMPAT DAN TANGGAL LAHIR</strong></td>
                    <td class="auto-style27"><?php echo $modelDataAgen['tmpt_lahir'] ?></td>
                    <td class="auto-style13" colspan="2"><?php echo $modelDataAgen['tgl_lahir'] ?></td>
                </tr>
                <tr>
                    <td class="auto-style25"><strong>STATUS PERKAWINAN</strong></td>
                    <td class="auto-style27"><?php echo $modelDataAgen->refStatusSipil->nama_status_sipil ?></td>
                    <td class="auto-style13" colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td class="auto-style25"><strong>PEKERJAAN</strong></td>
                    <td class="auto-style27"><?php echo $modelDataAgen['pekerjaan'] ?></td>
                    <td class="auto-style13" colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td class="auto-style25"><strong>NO TELP / WA </strong> </td>
                    <td class="auto-style27"><?php echo $modelDataAgen['no_wa'] ?></td>
                    <td class="auto-style13" colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td class="auto-style25"><strong>EMAIL</strong></td>
                    <td class="auto-style27">&nbsp;</td>
                    <td class="auto-style13" colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td class="auto-style25"><strong>ALAMAT DOMISILI</strong></td>
                    <td class="auto-style27"><?php echo $modelDataAgen['alamat_domisili'] ?></td>
                    <td class="auto-style13" colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td class="auto-style25"><strong>RT / RW </strong> </td>
                    <td class="auto-style27"><?php echo $modelDataAgen['rt_domisili'] . ' / ' . $modelDataAgen['rw_domisili'] ?></td>
                    <td class="auto-style13" colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td class="auto-style25"><strong>KELURAHAN</strong></td>
                    <td class="auto-style27">&nbsp;</td>
                    <td class="auto-style13" colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td class="auto-style25"><strong>KECAMATAN / KODE POS</strong></td>
                    <td class="auto-style27"><?php echo $modelDataAgen->kecamatanDomisili->nama ?></td>
                    <td class="auto-style13">&nbsp;</td>
                    <td class="auto-style13"><?php echo $modelDataAgen['kode_post'] ?></td>
                </tr>
            
                <tr>
                    <td class="auto-style2" colspan="4"><strong>NO REKENING 
					PENDAFTAR</strong></td>
                </tr>
                <tr>
                    <td class="auto-style25"><strong>JENIS BANK / ATAS NAMA</strong></td>
                    <?php
                    $cekrek = backend\models\RefBank::find()->where(['id'=>$modelRekening['id_ref_bank']]);
                    if($cekrek->exists()){
                    $Bank = $cekrek->one();    
                        $namaBank = $Bank['nm_bank'];
                    $norek = $modelRekening['no_rek'];
                        $atasnama=$modelRekening['atas_nama'];
                    }else{
                        $namaBank='';
                        $norek = '';
                        $atasnama='';
                    }
?>
                    <td class="auto-style27"><?=$namaBank?></td>
                    
                    <td class="auto-style13" colspan="2"><?=$atasnama?></td>
                </tr>
                <tr>
                    <td class="auto-style25"><strong>NO. REKENING BANK</strong></td>
                    <td class="auto-style35" colspan="3"><?=$norek?></td>
                </tr>
                <tr>
                    <td class="auto-style2" colspan="4"><strong>DATA AHLI WARIS</strong></td>
                </tr>
                <tr>
                    <td class="auto-style25"><strong>NAMA AHLI WARIS / NO HAPE</strong></td>
                    <td class="auto-style27"><?php echo $modelDataWaris['nama_waris'] ?></td>
                    <td class="auto-style13" colspan="2"><?php echo $modelDataWaris['nope_waris'] ?></td>
                </tr>
                <tr>
                    <td class="auto-style25"><strong>JENIS BANK / ATAS NAMA</strong></td>
                    <td class="auto-style27"><?php echo $modelDataWaris['jns_bank'] ?></td>
                    <td class="auto-style13" colspan="2"><?php echo $modelDataWaris['atas_nama_bank'] ?></td>
                </tr>
                <tr>
                    <td class="auto-style25"><strong>NO REKENING</strong></td>
                    <td class="auto-style27"><?php echo $modelDataWaris['norek_bank'] ?></td>
                    <td class="auto-style13" colspan="2">&nbsp;</td>
                </tr>
              
                <tr>
                    <td class="auto-style2" colspan="4"><strong>PEMBAYARAN FRENCHISE</strong></td>
                </tr>
                <tr>
                    <td class="auto-style25"><strong>NOMINAL</strong></td>
                    <td class="auto-style27"><?php
                        $nominal = Franchice::find()->where(['id_ref_agen' => $modelDataAgen['id_ref_agen']])->one();
                        echo number_format($nominal['nominal'],0,',','.');
                        ?></td>
                    <td class="auto-style13" colspan="2"><strong>STATUS PEMBAYARAN</strong> : <?php
                        $status_pembayaran_dp = \backend\models\StatusDp::find()->where(['id' => $modelDataPembayaran['id_status_dp']]);
                        $status_pembayaran = " ";
                        if ($status_pembayaran_dp->exists()) {
                            $status_pembayaran = $status_pembayaran_dp->one()->inisial;
                        }
                        echo $status_pembayaran;
                        ?></td>
                </tr>
                <tr>
                    <td class="auto-style25"><strong>METODE PEMBAYARAN</strong></td>
                    <td class="auto-style27"><?php
                        $metode_pembayaran_dp = \backend\models\MetodeTransfer::find()->where(['id' => $modelDataPembayaran['id_metode_transfer']]);
                        $metode_pembayaran = "";
                        if ($metode_pembayaran_dp->exists()) {
                            $metode_pembayaran = $metode_pembayaran_dp->one()->nm_metode_transfer;
                            ;
                        }
                        echo $metode_pembayaran;
                        ?></td>

                    <td class="auto-style13" colspan="2"><?= $modelDataPembayaran['tgl_konfirmasi'] ?></td>
                </tr>
            </table>

        </div>
        <div class="page" style="height:842px; border: 1px solid #ddd; margin: auto; width: 100%; padding: 2%; margin: 0px 0">
            <br>


                <table id="table5" class="auto-style3">
                    <tr>
                        <td rowspan="7" class="auto-style32">  
						<img src="<?= Yii::getAlias('@sourcePathImg/') . $modelFotoProfil['filename']; ?>" alt="" height="133" width="138" ></img></td>
                        <td><strong><?= $modelTentangKami['nama_cv'] ?>
                            </strong></td>
                        <td><b><?= strtoupper(backend\models\RefAgen::findOne($modelDataAgen['id_ref_agen'])->nama_agen); ?></b></td>
                    </tr>
                    <tr>
                        <td><?= $modelTentangKami['alamat_cv'] ?></td>
                        <td rowspan="6">
						<img src="<?= Yii::getAlias('@sourcePathImg/') . $modelDataAgen['filename']; ?>" alt="" class="auto-style19" height="126" width="134"></img></td>
                    </tr>
                    <tr>
                        <td>Marketing : <?= $modelTentangKami['telp_marketting'] ?></td>
                    </tr>
                    <tr>
                        <td>Email : <?= $modelTentangKami['email'] ?></td>
                    </tr>
                    <tr>
                        <td>Admin : <?= $modelTentangKami['telp_admin'] ?></td>
                    </tr>
                    <tr>
                        <td><?= $modelTentangKami['kontak_lainnya'] ?></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    </table>

                <table id="table4" class="auto-style30">
                    <tr>
                        <td class="auto-style15"><strong>SYARAT DAN KETENTUAN AGEN
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td><?= $modelSyaratWajibHak['syarat_daftar'] ?></td>
                    </tr>
                         <tr>
                        <td class="auto-style15"><strong>SYARAT DAN KETENTUAN PEMBAGIAN KOMISI
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td><?= $modelSyaratWajibHak['syarat_komisi'] ?></td>
                    </tr>
                    <tr>
                        <td class="auto-style15"><strong>HAK DAN KEWAJIBAN AGEN
                            </strong>
                        </td>


                    </tr>
                    <tr>
                        <td class="auto-style31"><?= $modelSyaratWajibHak['hak_wajib'] ?></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                </table>

                <br><br><br>
                            <table id="table6" class="auto-style3">
                                <tr>
                                    <td>&nbsp;</td>
                                    <td style="width: 190px">&nbsp;</td>
                                    <td class="auto-style33" style="width: 211px">&nbsp;</td>
                                    <td class="auto-style33" rowspan="3" style="width: 163px">
                                    <?php if(in_array($modelDataAgen['id_ref_agen'],['1','7'])){ ?>    <div class="auto-style15" style="border: 2px solid #000000; width: 160px; position: static;">
                                            Materai<br><br><br><br>6000</div>
                                            </div>
                                            <?php } ?>
                                            </td>
                                                            <td class="auto-style15" style="width: 13px">Banjarbaru,..............................</td>
                                                            <td class="auto-style15">&nbsp;</td>
                                                            <td class="auto-style15">&nbsp;</td>
                                                            <td class="auto-style15">&nbsp;</td>
                                                            <td class="auto-style15">&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td style="width: 190px">&nbsp;</td>
                                                                <td class="auto-style34" style="width: 211px">Mengetahui</td>
                                                                <td class="auto-style15" style="width: 13px">Menyetujui</td>
                                                                <td class="auto-style15">&nbsp;</td>
                                                                <td class="auto-style15">&nbsp;</td>
                                                                <td class="auto-style15">&nbsp;</td>
                                                                <td class="auto-style15">&nbsp;</td>
                                                            </tr>
                             
                                                            <tr>
                                                                <td style="height: 93px"></td>
                                                                <td style="height: 93px; width: 190px;"></td>
                                                                <td class="auto-style33" style="width: 211px; height: 93px"></td>
                                                                <td style="height: 93px; width: 13px;"></td>
                                                                <td style="height: 93px"></td>
                                                                <td style="height: 93px"></td>
                                                                <td style="height: 93px"></td>
                                                                <td style="height: 93px"></td>
                                                            </tr>
                          
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td style="width: 190px">&nbsp;</td>
                                                                <td class="auto-style34" style="width: 211px">(......................................)</td>
                                                                <td class="auto-style33" style="width: 163px">&nbsp;</td>
                                                                <td class="auto-style15" style="width: 13px">(......................................)</td>
                                                                <td class="auto-style15">&nbsp;</td>
                                                                <td class="auto-style15">&nbsp;</td>
                                                                <td class="auto-style15">&nbsp;</td>
                                                                <td class="auto-style15">&nbsp;</td>
                                                            </tr>
                                                            </table>
                                                            <br><br>

                                                                    </div>
                                                                    </body>

                                                                    </html>
