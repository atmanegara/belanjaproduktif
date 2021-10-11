<?php
use yii\helpers\Url;
use kartik\form\ActiveForm;
use kartik\file\FileInput;
use yii\bootstrap4\Html;
?>
    <!-- BEGIN #checkout-payment -->
        <div class="section-container" id="checkout-payment">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN checkout -->
                <div class="checkout">
                   
                        <!-- BEGIN checkout-header -->
                        <div class="checkout-header">
                            <!-- BEGIN row -->
                            <div class="row">
                                <!-- BEGIN col-3 -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="step ">
                                        <a href="#">
                                            <div class="number">+</div>
                                            <div class="info">
                                                <div class="title">INFORMASI</div>
                                                <div class="desc"></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                         
                                <!-- END col-3 -->
                                <!-- BEGIN col-3 -->
                               
                                <!-- END col-3 -->
                                <!-- BEGIN col-3 -->
                            
                                
                                <!-- END col-3 -->
                               
                              
                            </div>
                            <!-- END row -->
                        </div>
                        <!-- END checkout-header -->
                        <!-- BEGIN checkout-body -->
                        <div class="checkout-body">
		 <div class="table-responsive">
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
                                               		
                                        
                                    }?>
                                        <tr>
                                            <td class="" colspan="2">
                                               <div style='border: 2px solid green;width:auto;height:70px'>
                                                   TERIMA KASIH ANDA SUDAH MELAKUKAN PEMBAYARAN DENGAN NO INVOICE <b>#<?php echo $item['no_invoice']?></b>
                                               		<br>
                                               		<i>Barang tidak bisa di batalkan , jika ada keluhan bisa hubungi kami di no kontak tertera</i>
                                               		<b></b>
                                               </div>
                                            </td>
                                            <td class="cart-summary" colspan="2">
                                                <div class="summary-container">
                                                    <div class="summary-row">
                                                        <div class="field">Cart Subtotal</div>
                                                        <div class="value"><?php echo $total?></div>
                                                    </div>
                                                  
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
                            </div>
                        </div>
                            
                        <!-- END checkout-body -->
                        <!-- BEGIN checkout-footer -->
                        <div class="checkout-footer">
                            
                              
                        </div>
                        <!-- END checkout-footer -->
                
                </div>
                <!-- END checkout -->
           
            </div>
            <!-- END container -->
        </div>
        <!-- END #checkout-payment -->