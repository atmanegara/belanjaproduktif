<?php
use yii\helpers\Url;
use kartik\form\ActiveForm;
use kartik\file\FileInput;
use yii\bootstrap4\Html;
?>
    <!-- BEGIN #checkout-payment -->
    <div class='panel panel-inverse'>
        <div class='panel-heading'>
            
        </div>
        <div class="panel-body">
            <table border="1">
           
                <tbody>
                    <tr>
                        <td>Metode Pembayaran</td>
                        <td><?= $detailPembayaran->metodePembarayan->ket ?></td>
                    </tr>
                    <tr>
                        <td>Kurir</td>
                        <td><?php
                        $cekKurir = \backend\models\RefKurir::find()->where(['id'=>$detailPembayaran['id_ref_kurir']]);
                                if($cekKurir->exists()){
                                    $nama_kurir = $cekKurir->one()->nama_kurir;
                                }else{
                                    $nama_kurir='Kurir tidak aktif';
                                }
                        echo $nama_kurir; ?></td>
                    </tr>
                    <tr>
                        <td>Jadwal Pengiriman </td>
                        <td><?= $detailPembayaran['tgl_dikirim'].', '.$detailPembayaran['jam_dikirim'] ?></td>
                    </tr>
                   
                </tbody>
            </table>

          
          
                        <!-- BEGIN checkout-header -->
                    
		                 <table class="table table-cart">
                                    <thead>
                                        <tr>
                                            <th width=''>Product Name</th>
                                            <th width='' class="text-center">Price</th>
                                            <th width='' class="text-center">Quantity</th>
                                            <th width='' class="text-center">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $total=0;
                                    foreach ($dataItem as $item){
                                    $total += $item['total'];
                                        ?>
                                        <tr>
                                       
                                            <td class="cart-product">
                                          <?=$item['nama_item']?>
                                            </td>
                                            <td class="cart-price text-center"><?=$item['harga_jual']?></td>
                                            <td class="cart-qty text-center">
                                             
                                                  <?=$item['qty']?>
                                         
                                            </td>
                                            <td class="cart-total text-center">
                                               <?=$item['total']?>
                                            </td>
                                          
                                        </tr>
                                        <?php     
//                                  
                                        
                                    }?>
                                        <tr>
                                            <td class="" colspan="2">
                                               <div style='border: 1px solid black;width:auto;height:70px'>
                                               		NO. VA : <b><?php echo $detailPembayaran['no_acak']?></b>
                                               		<br>
                                               		<i>Jika transfer menggunakan Mobile Banking / internet Banking, masukkan berita dengan kode</i>
                                               		<b><?php echo $detailPembayaran['no_invoice']?></b>
                                               </div>
                                            </td>
                                            <td class="cart-summary" colspan="2">
                                                <div class="summary-container">
                                               
                                                    <div class="summary-row total">
                                                        <div class="field">Total</div>
                                                        <div class="value"><?php 
                                                         echo $total; ?></div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                   
                 
                        <hr />
                            
                        <!-- END checkout-body -->
                        <!-- BEGIN checkout-footer -->
                      
        </div>
            </div>            
        <!-- END #checkout-payment -->