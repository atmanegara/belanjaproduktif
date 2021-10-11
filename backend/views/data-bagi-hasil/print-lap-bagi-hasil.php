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
                text-align: center;
                border-style: solid;
                border-width: 1px;
            }
            .auto-style3 {
                border-style: solid;
                border-width: 1px;
            }
        </style>
    </head>

    <body>

        <p>Laporan Bagi Hasil</p>
        <p>&nbsp;</p>
        <table id="table1" class="auto-style1">
            <tr>
                <td class="auto-style2" colspan="6">BAGI HASIL PENJUALAN AGEN&nbsp;</td>
            </tr>
            <tr>
                <td class="auto-style3">KANTOR</td>
                <td class="auto-style3">PROMO</td>
                <td class="auto-style3">STOKIS</td>
                <td class="auto-style3">PASOK</td>
                <td class="auto-style3">NIAGA</td>
                <td class="auto-style3">LAINNYA</td>
                <td class="auto-style3">TOTAL</td>
            </tr>
            <?php foreach ($queryAtur as $val) { ?>
                <tr>
                    <td class="auto-style3"><?= $val['nilai1'] ?></td>
                    <td class="auto-style3"><?= $val['nilai2'] ?></td>
                    <td class="auto-style3"><?= $val['nilai7'] ?></td>
                    <td class="auto-style3"><?= $val['nilai3'] ?></td>
                    <td class="auto-style3"><?= $val['nilai4'] ?></td>
                    <td class="auto-style3"><?= $val['nilai5'] ?></td>
                    <td class="auto-style3"><?= $val['nilai6'] ?></td>
                </tr>
            <?php
            }
            $tothasil1 = 0;
            $tothasil2 = 0;
            $tothasil3 = 0;
            $tothasil4 = 0;
            $tothasil5 = 0;
            $tothasil6 = 0;
            $tothasil7 = 0;
            $tot = 0;
            $totAll=0;
             $value['hasil1']=0;
             $value['hasil2']=0;
             $value['hasil3']=0;
             $value['hasil4']=0;
             $value['hasil5']=0;
             $value['hasil6']=0;
             $value['hasil7']=0;
           //        
            foreach ($query as $value) {
                   
            
              
                ?>

                <tr>
                    <td class="auto-style3"><?= $value['id_ref_agen']==5 ? $value['hasil'] : 0; //BP ?></td>
                    <td class="auto-style3"><?= $value['id_ref_agen']==1 ? $value['hasil'] : 0;  //PROMO ?></td>
                    <td class="auto-style3"><?= $value['id_ref_agen']==7 ? $value['hasil'] : 0; ?></td>
                    <td class="auto-style3"><?= $value['id_ref_agen']==2 ? $value['hasil'] : 0; ?></td>
                    <td class="auto-style3"><?=  $value['id_ref_agen']==3 ? $value['hasil'] : 0;  ?></td>
                    <td class="auto-style3"><?= $value['id_ref_agen']==6 ? $value['hasil'] : 0; ?></td>
                    <td class="auto-style3"><?php
                    $totAll = $value['hasil']; //+ $value['hasil2'] + $value['hasil3'] + $value['hasil4'] + $value['hasil5'] + $value['hasil6'] + $value['hasil7'];
                    echo $totAll;
                ?></td>
                </tr>
                <?php
//                $tothasil1 += $value['hasil1'];
//                $tothasil2 += $value['hasil2'];
//                $tothasil3 += $value['hasil3'];
//                $tothasil4 += $value['hasil4'];
//                $tothasil5 += $value['hasil5'];
//                $tothasil6 += $value['hasil6'];
//                $tothasil7 += $value['hasil7'];
                $tot += $totAll;
              //    }
            }
            ?>
            <tr>
                <td class="auto-style3"><?= $tothasil5 ?></td>
                <td class="auto-style3"><?= $tothasil1 ?></td>
                <td class="auto-style3"><?= $tothasil7 ?></td>
                <td class="auto-style3"><?= $tothasil2 ?></td>
                <td class="auto-style3"><?= $tothasil3 ?></td>
                <td class="auto-style3"><?= $tothasil6 ?></td>
                <td class="auto-style3"><?= $tot ?></td>
            </tr>
        </table>

    </body>

</html>

