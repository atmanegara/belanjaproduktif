<?php
use yii\helpers\Url;
use kartik\form\ActiveForm;
use kartik\file\FileInput;
use yii\bootstrap4\Html;
?>
    <!-- BEGIN #checkout-payment -->
        <div class="panel panel-inverse">
            <!-- BEGIN container -->
            <div class="panel-heading"></div>
                <!-- BEGIN checkout -->
                <div class="panel-body">
                    <div class="widget widget-stats bg-gradient-blue col-md-4">
			<div class="stats-icon stats-icon-lg"><i class="fa fa-dollar-sign fa-fw"></i></div>
			<div class="stats-content">
				<div class="stats-title">SALDO S/D HARI INI</div>
				<div class="stats-number"><?=number_format($saldo['nominal_awal'],2,',','.')?></div>
			</div>
		</div>
                    <p>
                        <?=  Html::a('<i class="fa fa-backward"></i> Kembali', ['/produk/list-checkout-payment'], ['class' => 'btn btn-default']); ?>
               
                    </p>
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
                       <div class="row row-space-1">
            <div class="col-md-12">
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
                                               <div style='border: 1px solid black;width:auto;height:70px'>
                                               		NO. VA : <b><?php echo '-'?></b>
                                               		<br>
                                                        <i>Pembayaran menggunakan via saldo, pastikan jumlah saldo yang anda miliki cukup</i>
                                               		<b><?php echo "No. Invoice : ". $item['no_invoice']?></b>
                                               </div>
                                            </td>
                                            <td class="cart-summary" colspan="2">
                                                <div class="summary-container">
                                                    <div class="summary-row">
                                                        <div class="field">Subtotal</div>
                                                        <div class="value"><?php echo $total?></div>
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
                </div>
            </div></div>
                    <p>   <?php 
                      $modelJualBeli = backend\models\PembayaranJualbeli::findOne(['no_invoice' => $modelDetailPembayaran['no_invoice']]);
                            if(in_array($modelJualBeli['id_status_pembayaran'],[1,2])){
                            echo yii\bootstrap4\Alert::widget([
                                'options'=>[
                                    'class'=>'alert-success',
                                    
                                ],
                                'body'=>'TERIMA KASIH SUDAH MELAKUKAN KONFIRMASI',
                                       'closeButton'=>false
                            ])    ;
                            }else{
                ActiveForm::begin([
                    'method'=>'POST',
                    'action'=> Url::to(['/transaksi-saldo/simpan'])
                ]);
                
                echo Html::hiddenInput('id_metode_pembayaran', $modelDetailPembayaran['id_metode_pembayaran']);
                echo Html::hiddenInput('no_invoice', $modelDetailPembayaran['no_invoice']);
                echo Html::hiddenInput('no_acak', $modelDetailPembayaran['no_acak']);
                echo Html::hiddenInput('nominal', $total);
                echo Html::submitButton('Konfirmasi',['class'=>'btn btn-lg btn-primary']);
                ActiveForm::end();
                            }
                ?>
                    </p>
                </div>
                <!-- END checkout -->
           
            <!-- END container -->
        </div>
        <!-- END #checkout-payment -->