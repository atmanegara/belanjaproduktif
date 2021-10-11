<?php
use yii\helpers\Url;
use kartik\form\ActiveForm;
use kartik\file\FileInput;
use yii\bootstrap4\Html;
?>
   <div class="section-container" id="checkout-payment">
            <!-- BEGIN container -->
            <div class="container">
    <!-- BEGIN #checkout-payment -->
        <div class="panel panel-inverse">
            <!-- BEGIN container -->
            <div class="panel-heading"></div>
                <!-- BEGIN checkout -->
                <div class="panel-body">
                    
                      <?=
            yii\widgets\DetailView::widget([
                'model'=>$modelDetailPembayaran,
                'attributes'=>[
                    [
                       'label'=>'Metode Pembayaran',
                        'value'=>function($model){
                return $model->metodePembayaran->ket;
                        }
                    ],
                             
                            [
                                'label'=>'Jadwal Pengiriman (Tanggal - Jam)',
                                'value'=>function($model){
                        return $model['tgl_dikirim'] .', '.$model['jam_dikirim'];
                                }
                            ]
                ]
            ])
?>               
                    
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
                                            <td class="cart-price text-center"><?=number_format($item['harga_jual'],2,',','.')?></td>
                                            <td class="cart-qty text-center">
                                             
                                                  <?=$item['qty']?>
                                         
                                            </td>
                                            <td class="cart-total text-center">
                                               <?=number_format($item['total'],2,',','.')?>
                                            </td>
                                          
                                        </tr>
                                        <?php     
                                                		
                                        
                                    }?>
                                        <tr>
                                            <td class="" colspan="2">
                                               
                                            </td>
                                            <td class="cart-summary" colspan="2">
                                                <div class="summary-container">
                                                    <div class="summary-row">
                                                        <div class="field">Cart Subtotal</div>
                                                        <div class="value"><?php echo number_format($total,2,',','.');?></div>
                                                    </div>
                                            
                                                    <div class="summary-row total">
                                                        <div class="field">Total</div>
                                                        <div class="value"><?php 
                                              
                                                        echo number_format($total,2,',','.'); ?></div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                <?php 
                ActiveForm::begin([
                    'method'=>'POST',
                    'action'=> Url::to(['/data-aksi/simpan'])
                ]);
                echo Html::hiddenInput('no_invoice', $modelDetailPembayaran['no_invoice']);
                echo Html::hiddenInput('no_acak', $modelDetailPembayaran['no_acak']);
                echo Html::hiddenInput('nominal', $total);
                echo Html::submitButton('Konfirmasi',['class'=>'btn btn-lg btn-primary']);
                ActiveForm::end();
                ?>
  
                </div>
                <!-- END checkout -->
           
            <!-- END container -->
        </div>
            </div>
   </div>
        <!-- END #checkout-payment -->