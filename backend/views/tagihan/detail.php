<?php
use yii\helpers\Url;
use kartik\form\ActiveForm;
use kartik\file\FileInput;
use yii\bootstrap4\Html;
?>
<p>
<?= Html::a('<i class="fa fa-home"></i> Kembali',['index'],['class'=>'btn btn-default']) ?>
</p>
    <!-- BEGIN #checkout-payment -->
    <div class='panel panel-inverse'>
        <div class='panel-heading'>
            
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                       <?=
            yii\widgets\DetailView::widget([
                'model'=>$dataAgen,
                'attributes'=>[
   'nik','nama_agen',[
       'attribute'=>'id_ref_agen',
       'value'=>function($model){
                return $model->refAgen->nama_agen;
       }
   ],'alamat','no_wa'
                ]
            ])
?>  
                </div>
                <div class="col-md-6">
                        <?=
            yii\widgets\DetailView::widget([
                'model'=>$detailPembayaran,
                'attributes'=>[
                    [
                       'label'=>'Metode Pembayaran',
                        'value'=>function($model){
                if($model->id_metode_pembayaran){
                return $model->metodePembayaran->ket;
                }
                        }
                    ],
                             [
                        'label'=>'Kurir',
                        'value'=>function($model){
                          if($model->id_ref_kurir){
                return $model->refKurir->nama_kurir;
                }
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
                </div>
                
            </div>
                   
            
      

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
                                                            		
                                        
                                    }?>
                                        <tr>
                                            <td class="" colspan="2">
                                               <div style='border: 1px solid black;width:auto;height:70px'>
                                               		NO. VA : <b><?php echo $item['no_acak']?></b>
                                               		<br>
                                               		<i>Jika transfer menggunakan Mobile Banking / internet Banking, masukkan berita dengan kode</i>
                                               		<b><?php echo $item['no_invoice']?></b>
                                               </div>
                                            </td>
                                            <td class="cart-summary" colspan="2">
                                                <div class="summary-container">
                                                    <div class="summary-row">
                                                        <div class="field">Cart Subtotal</div>
                                                        <div class="value"><?php echo $total?></div>
                                                    </div>
                                                    <div class="summary-row text-danger">
                                                        <div class="field">Pajak 10%</div>
                                                        <div class="value"><?php 
                                                        $pajak=$total *(10/100);
                                                        echo $pajak; ?></div>
                                                    </div>
                                                    <div class="summary-row total">
                                                        <div class="field">Total</div>
                                                        <div class="value"><?php 
                                                        $total = $total+$pajak;
                                                        echo $total; ?></div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                   
                 
                        <hr />
                            <div class="m-b-5"><b>Data Pengiriman</b></div>
                            <ul class="checkout-info-list">
                                <li>Signature may be required for delivery</li>
                                <li>We do not ship to P.O. boxes</li>
                                <li>Delivery estimates below include item preparation and shipping time</li>
                                <li>We do not ship directly to APO/FPO addresses.</li>
                            </ul>
                        <!-- END checkout-body -->
                        <!-- BEGIN checkout-footer -->
                        <div class="checkout-footer">
                            
             
                        
                     
                        <!-- END checkout-footer -->
                 
                </div>      
        </div>
            </div>            
        <!-- END #checkout-payment -->