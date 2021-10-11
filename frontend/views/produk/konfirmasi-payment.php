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
							$form = ActiveForm::begin([
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
                                                <div class="title">NO. INVOICE #</div>
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
							<h4 class="checkout-title">Konfirmasi Barang Diterima dari Kurir</h4>
					<div class='row row-space-10'>
						<div class='col-md-6'>
				          <?= $form->field($model, 'no_invoice')->textInput(['disabled'=>true]) ?>
                		</div>
						
						
					</div>
					

                                                        
    <?=  $form->field($model, 'filedok')->widget(FileInput::className(),[
        
        'pluginOptions' => [
            
            'showUpload' => false,
            'browseClass' => 'btn btn-primary btn-block',
            'browseIcon' => '<i class="fa fa-camera"></i>',
    //        'browseLabel' =>  'Select Photo'
        ],
    ])
                                                                 
                                                                  ?>
                        </div>
                        <hr />
                            
                        <!-- END checkout-body -->
                        <!-- BEGIN checkout-footer -->
                        <div class="checkout-footer">
                           <?php echo Html::a('Batal',['bayar-batal'],['class'=>'btn btn-inverse btn-lg p-l-30 p-r-30 m-l-10'])?>
                            <?php echo Html::submitButton('Bayar',['class'=>'btn btn-inverse btn-lg p-l-30 p-r-30 m-l-10'])?>
                        
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