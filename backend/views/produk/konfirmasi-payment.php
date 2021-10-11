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
                      <?php 
							$form = ActiveForm::begin([
							    'id' => 'login-form-horizontal',
						//	    'type' => ActiveForm::TYPE_HORIZONTAL,
							    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
							]); 
							?>
                    
                        <!-- END checkout-header -->
                        <!-- BEGIN checkout-body -->
                        <div class="checkout-body">
							<h4 class="checkout-title">Form Pembayaran</h4>
					<div class='row row-space-10'>
						<div class='col-md-6'>
				          <?= $form->field($model, 'no_invoice')->textInput(['disabeld'=>true]) ?>
                		</div>
						<div class='col-md-6'>
				                <?= $form->field($model,'total_bayar')->textInput(['disabeld'=>true]) ?>
   		
                 	</div>
						
					</div>
					<div class='row row-space-10'>
						<div class='col-md-6'>
					                         <?= $form->field($model,'id_ref_bank')->dropDownList($modelBank,['prompt'=>"Pilih salah satu.."]) ?>
   	
						</div>
						<div class='col-md-6'>
				         	         <?= $form->field($model, 'tgl_transfer')->textInput(['type'=>'date']) ?>
						</div>
					</div>

                                                        
    <?= $form->field($model, 'filedok')->widget(FileInput::className(),[
        
        'pluginOptions' => [
            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'browseClass' => 'btn btn-primary btn-block',
            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
            'browseLabel' =>  'Select Photo'
        ],
    ]) ?>
                        </div>
                        <hr />
                           
                        <!-- END checkout-body -->
                        <!-- BEGIN checkout-footer -->
                        <div class="checkout-footer">
                           <?php echo Html::a('Batal',['bayar-batal'],['class'=>'btn btn-danger btn-lg p-l-30 p-r-30 m-l-10'])?>
                            <?php echo Html::submitButton('Bayar',['class'=>'btn btn-success btn-lg p-l-30 p-r-30 m-l-10'])?>
                        
                        </div>
                        <!-- END checkout-footer -->
                   <?php 
                   ActiveForm::end();
                   ?>
                </div>
                <!-- END checkout -->
           
            <!-- END container -->
        </div>
        <!-- END #checkout-payment -->