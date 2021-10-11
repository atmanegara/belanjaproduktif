<?php
use yii\helpers\Url;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
?>
    <!-- BEGIN #checkout-cart -->
        <div class="section-container" id="checkout-cart">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN checkout -->
                <div class="checkout">
                   <?php 
							ActiveForm::begin([
							    'id' => 'checkoutitem',
						//	    'type' => ActiveForm::TYPE_HORIZONTAL,
						//	    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
							]); 
							?>
                        <!-- BEGIN checkout-header -->
                        <div class="checkout-header">
                            <!-- BEGIN row -->
                            <div class="row">
                                <!-- BEGIN col-3 -->
                                <div class="col-md-4 col-sm-4">
                                    <div class="step active">
                                        <a href="#">
                                            <div class="number">+</div>
                                            <div class="info">
                                                <div class="title">ID CUST #<?php echo $no_acak?></div>
                                                <div class="desc">Daftar Pesanan dibuat tanggal <?php echo date('d-m-Y')?></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                         
                                <!-- END col-3 -->
                                <!-- BEGIN col-3 -->
                                <div class="col-md-4 col-sm-4">
                                    <div class="step">
                                        <a href="#">
                                            <div class="number">2</div>
                                            <div class="info">
                                                <div class="title">Pembayaran</div>
                                                <div class="desc">Daftar Pembayaran</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <!-- END col-3 -->
                                <!-- BEGIN col-3 -->
                                <div class="col-md-4 col-sm-4">
                                    <div class="step ">
                                        <a href="#">
                                            <div class="number">3</div>
                                            <div class="info">
                                                <div class="title">Konfirmasi Pembayaran</div>
                                                <div class="desc">Pastikan bayar dengan pas dan benar yaa</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                
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
                                            <th width='5.5%'>#</th>
                                            <th width='40%'>Product Name</th>
                                            <th width='20%' class="text-center">Price</th>
                                            <th width='10%' class="text-center">Quantity</th>
                                            <th width='20%' class="text-center">Total</th>
                                            <th ></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $total=0;
                                    foreach ($dataItem as $item){
                                    $total += $item['total'];
                                        ?>
                                        <tr>
                                        <td><?php echo  Html::checkbox('pilih[]',true,[
                                            'class'=>'form-control',
                                            'value'=>$item['id'],
                                            
                                        ])?></td>
                                            <td class="cart-product">
                                                <div class="product-img">
                                                    <img src="<?php echo Url::to(Yii::getAlias('@sourcePathImg/').$item['filename'])?>" alt="" />
                                                </div>
                                                <div class="product-info">
                                                    <div class="title"><?=$item['item_barang']?></div>
                                                    <div class="desc">Tanggal Pesanan Masuk <?=$item['tgl_masuk']?></div>
                                                </div>
                                            </td>
                                            <td class="cart-price text-center"><?= 'Rp '.number_format($item['harga_jual'],2,',','.')?></td>
                                            <td class="cart-qty text-center">
                                                <div class="cart-qty-input">
                                                    <input type="text" name="checkoutitem[qty]" value="<?=$item['qty']?>" disabled class="form-control" id="qty" />
                                                </div>
                                                <div class="qty-desc">Min : 1 pcs</div>
                                            </td>
                                            <td class="cart-total text-center">
                                              <?='Rp '.number_format($item['total'],2,',','.')?>
                                            </td>
                                            <td>
                                            <?php 
                                            $url = Url::to(['edit-item','id'=>$item['id']]);
                                            echo Html::a("<i class='fa fa-edit'></i>",$url);
                                            ?>
                                            </td>
                                        </tr>
                                        <?php }?>
                                        <tr>
                                            <td class="cart-summary" colspan="5">
                                                <div class="summary-container">
                                                    <div class="summary-row">
                                                        <div class="field">Cart Subtotal</div>
                                                        <div class="value"><?php echo 'Rp '.number_format($total,2,',','.')?></div>
                                                    </div>
                                               
                                                    <div class="summary-row total">
                                                        <div class="field">Total</div>
                                                        <div class="value"><?php 
                                                        echo 'Rp '.number_format($total,2,',','.');?></div>
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
                          <?php 
                       //   $url=Url::to(['checkout-payment','no_invoice'=>'ad']);
                          echo Html::submitButton('Pembayaran',['class'=>'btn btn-inverse btn-lg p-l-30 p-r-30 m-l-10'])?>
                        </div>
                        <!-- END checkout-footer -->
                  <?php ActiveForm::end()?>
                </div>
                <!-- END checkout -->
            </div>
            <!-- END container -->
        </div>
        <!-- END #checkout-cart -->
    