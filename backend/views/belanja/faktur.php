
<head>
<style type="text/css">
.auto-style18 {
	text-align: right;
}
.auto-style20 {
	border-collapse: collapse;
	border-width: 0px;
}
.auto-style22 {
	border-left-style: solid;
	border-left-width: 1px;
	border-right-style: solid;
	border-right-width: 1px;
}
.auto-style24 {
	border-left-style: solid;
	border-left-width: 1px;
	border-right-style: solid;
	border-right-width: 1px;
	border-bottom-style: solid;
	border-bottom-width: 1px;
}
.auto-style25 {
	border-left-style: solid;
	border-left-width: 1px;
	border-right-style: solid;
	border-right-width: 1px;
	border-top-style: solid;
	border-top-width: 1px;
}
.auto-style26 {
	border-collapse: collapse;
}
.auto-style27 {
	border-style: solid;
	border-width: 1px;
	border: 1px #808080;
}
</style>
</head>

<?php
use yii\helpers\Url;
use kartik\form\ActiveForm;
use kartik\file\FileInput;
use yii\bootstrap4\Html;
?>
    <!-- BEGIN #checkout-payment -->
         <div class='auto-style18'>
            
        	#<?= $detailPembayaran['no_invoice'] ?></div>
                   <table id="table1" style="width: 100%" class="auto-style20">
	<tr>
		<td style="height: 26px; width: 171px;" class="auto-style25">Metode Pembayaran</td>
		<td style="height: 26px" class="auto-style25"><?= $detailPembayaran->metodePembayaran->ket ?></td>
	</tr>
	<tr>
		<td class="auto-style22" style="width: 171px">Kurir</td>
		<td class="auto-style22"><?php
                         if($detailPembayaran['id_ref_kurir']){
                               $cekKurir = \backend\models\DataKurir::find()->where(['id'=>$detailPembayaran['id_ref_kurir']]);
                                if($cekKurir->exists()){
                                    $nama_kurir = $cekKurir->one()->nama_kurir;
                                }else{
                                    $nama_kurir="<span class='label label-danger'>Kurir tidak aktif </span>";
                                }
                        echo $nama_kurir;
                        }else{
                        echo '-';   
                        }
                        ?></td>
	</tr>
	<tr>
		<td class="auto-style24" style="width: 171px">Jadwal Pengiriman </td>
		<td class="auto-style24"><?= $detailPembayaran['tgl_dikirim'].', '.$detailPembayaran['jam_dikirim'] ?></td>
	</tr>
</table>

		           <hr />
		                 <table class="auto-style26">
                                    <thead>
                                        <tr>
                                            <th class="auto-style27" style="height: 25px" >
											No</th>
                                            <th class="auto-style27" style="height: 25px" >Product Name</th>
                                            <th class="auto-style27" style="height: 25px">Price</th>
                                            <th class="auto-style27" style="height: 25px">Quantity</th>
                                            <th class="auto-style27" style="height: 25px">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $jumItem=0;
                                    $total=0;
                                    foreach ($dataItem as $item){
                                    $total += $item['total'];
                                    $jumItem++;
                                        ?>
                                        <tr>
                                       
                                            <td class="auto-style27">
                                           <?=$jumItem?></td>
                                       
                                            <td class="auto-style27">
                                          <?=$item['nama_item']?>
                                            </td>
                                            <td class="auto-style27"><?=number_format($item['harga_jual'],0,',','.')?></td>
                                            <td class="auto-style27">
                                             
                                                  <?=$item['qty']?>
                                         
                                            </td>
                                            <td class="auto-style27">
                                               <?=number_format($item['total'],0,',','.')?>
                                            </td>
                                          
                                        </tr>
                                        <?php     
//                                  
                                        
                                    }?>
                                        <tr>
                                            <td class="auto-style27">
                                               &nbsp;</td>
                                            <td colspan="2" class="auto-style27">
                                               <div >
                                            </div>
                                            </td>
                                            <td class="auto-style27">
                                               
                                            Total</td>
                                            <td class="auto-style27">
                                               <?= number_format($total,0,',','.')?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                   
                        <!-- END checkout-body -->
                        <!-- BEGIN checkout-footer -->
                  
        <!-- END #checkout-payment -->
<p>&nbsp;</p>

