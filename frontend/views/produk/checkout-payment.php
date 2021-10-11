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
                      <?php 
					$form=	ActiveForm::begin([
							    'id' => 'login-form-horizontal',
						//	    'type' => ActiveForm::TYPE_HORIZONTAL,
							    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
							]); 
							?>
                        <!-- BEGIN checkout-header -->
                        <div class="checkout-header">
                            <!-- BEGIN row -->
                            <div class="row">
                                <!-- BEGIN col-3 -->
                                <div class="col-md-4 col-sm-4">
                                    <div class="step ">
                                        <a href="#">
                                            <div class="number">+</div>
                                            <div class="info">
                                                <div class="title"></div>
                                                <div class="desc">Daftar Pesanan dibuat tanggal <?php echo date('d-m-Y')?></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                         
                                <!-- END col-3 -->
                                <!-- BEGIN col-3 -->
                                <div class="col-md-4 col-sm-4">
                                    <div class="step active">
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
                                            <td class="cart-price text-center"><?='Rp '.number_format($item['harga_jual'],2,',','.')?></td>
                                            <td class="cart-qty text-center">
                                             
                                                  <?=$item['qty']?>
                                         
                                            </td>
                                            <td class="cart-total text-center">
                                               <?='Rp '.number_format($item['total'],2,',','.')?>
                                            </td>
                                          
                                        </tr>
                                        <?php     
                                        echo $form->field($model,'no_acak')->label(false)->hiddenInput(['value'=>$item['no_acak']]) ;
                                            	echo $form->field($model,'no_invoice')->label(false)->hiddenInput(['value'=>$item['no_invoice']]);
                                          echo $form->field($model,'no_virtual_akun')->label(false)->hiddenInput(['value'=>$item['no_acak']]) ;
                                                	echo $form->field($model,'no_berita')->label(false)->hiddenInput(['value'=>$item['no_invoice']]);
                                               		
                                        
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
                                                        <div class="value"><?php echo 'Rp '.number_format($total,2,',','.');?></div>
                                                    </div>
                                                   
                                                    <div class="summary-row total">
                                                        <div class="field">Total</div>
                                                        <div class="value"><?php 
                                                        echo 'Rp '.number_format($total,2,',','.'); ?></div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr />
                   <div class="row row-space-10">
            <div class="col-md-8">
                            <?= $form->field($model, 'id_metode_pembayaran')->dropDownList($listMetodePembayaran,[
                                'prompt'=>'Pilih Salah Satu Metode Pembayaran...',
                                'onChange'=>'metodepembayaran(this.value)'
                            ]) ?>
                                <?= $form->field($model, 'id_ref_kurir')->dropdownList($modelRefKurir, ['prompt' => 'Pilih salah satu..']) ?>
                                <?= $form->field($model, 'tgl_dikirim')->textInput(['type' => 'date']) ?>
                                 <div class="form-group row">
                    <label class="col-sm-5 col-form-label">Pilih Jam dikirim</label>
                    <div class="col-md-10">
                        <p>
                            <?php
                            foreach ($refJam as $valjam) {
                                $jam = $valjam['jam'];
                                echo Html::button( $jam , [
                                    'class'=>'btn btn-primary btn-xs',
                                    'value' => $jam,
                                    'onClick' => "ambiljam('" . $jam . "')",
                                ]);
                            }
                            ?>


                        </p>
                    </div>
                </div>

<?= $form->field($model, 'jam_dikirim')->textInput(['readOnly'=>true]) ?>
                            </div>
                   </div>
                        <!-- END checkout-body -->
                        <!-- BEGIN checkout-footer -->
                        <div class="checkout-footer">
                            
                           <?php 
                                           	echo $form->field($model,'total')->label(false)->hiddenInput(['value'=>$total]);
                              
                           echo Html::a('Batal',['bayar-batal'],['class'=>'btn btn-danger btn-lg p-l-30 p-r-30 m-l-10',
                               'data'=>[
                                   'method'=>'POST','confirm'=>'Anda Yakin Pesanan ini dibatalkan?'
                               ]
                               ])?>
                            <?php echo Html::submitButton('Konfirmasi Pembayaran',['class'=>'btn btn-inverse btn-lg p-l-30 p-r-30 m-l-10'])?>
                        
                        </div>
                        <!-- END checkout-footer -->
                   <?php 
                   ActiveForm::end();
                   ?>
                </div>
                <!-- END checkout -->
           
            </div>
            <!-- END container -->
        </div>
        <!-- END #checkout-payment -->
        
        
<script>
   const ambiljam = (jam) => {
        $('#pembayaranjualbeli-jam_dikirim').val(jam);
        return false;
    };
    
   const metodepembayaran =(id_metode_pembayaran)=>{
       if(id_metode_pembayaran != '2'){
           $("#pembayaranjualbeli-id_ref_kurir").prop('disabled',true);
            $("#pembayaranjualbeli-id_ref_kurir").val('0');
       }else{
           $("#pembayaranjualbeli-id_ref_kurir").prop('disabled',false);
           
       }
   }
</script>