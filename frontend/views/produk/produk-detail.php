<?php
use yii\helpers\Url;
use yii\bootstrap4\Html;
?>
          <div id="page-container">    
          <div id="product" class="section-container p-t-20">   
              <div class="container">
          <div class="product">
                    <!-- BEGIN product-detail -->
                    <div class="product-detail">       <!-- BEGIN product-info -->
                      <div class="product-image">
                            <!-- BEGIN product-thumbnail -->
                
                            <!-- END product-thumbnail -->
                            <!-- BEGIN product-main-image -->
                            <div class="product-main-image" data-id="main-image">
                                <img
								src="<?php 
                                                                  $filename=$modelBarang['filename'];
            
                
                                                                echo Url::to(Yii::getAlias('@sourcePathImg/').$filename)?>"
								alt="" />
                            </div>
                            <!-- END product-main-image -->
                        </div>
                        <div class="product-info">
                            <!-- BEGIN product-info-header -->
                            <div class="product-info-header">
                                <h1 class="product-title"><span class="label label-success"><?php echo $modelBarang['stok_sisa']?></span> 
                                <?php echo $modelBarang['item_barang']?></h1>
                       
                            </div>
                            <!-- END product-info-header -->
                            <!-- BEGIN product-warranty -->
                            <div class="product-warranty">
                                <div class="pull-right">Availability: <?php echo $modelBarang['stok_sisa']=='0' ? 'Habis' : 'In stock' ?></div>
                                <div></div>
                            </div>
                            <!-- END product-warranty -->
                            <!-- BEGIN product-info-list -->
                            <div class="product-info-list">
                                <?php echo $modelBarang['ket']?>
                            </div>
                            <!-- END product-info-list -->
                            <!-- BEGIN product-social -->
                           
                            <!-- END product-social -->
                            <!-- BEGIN product-purchase-container -->
                            <div class="product-purchase-container">
                               
                                <div class="product-price">
                                    <div class="price">Rp. <?php echo number_format($modelBarang['harga_jual'],0,',','.')?></div>
                                </div>
                                <?= Html::button('ADD TO CART',['class'=>'btn btn-inverse btn-lg showModalButton',
                                    'value'=>Url::to(['add-cart','id_data_barang'=>$modelBarang['id']])
                                    ])?>
<!--                                 <a class="btn btn-inverse btn-lg" type="submit">ADD TO CART</button> -->
                            </div>
                            <!-- END product-purchase-container -->
                        </div>
                        <!-- END product-info -->
                        </div>
                        </div>
                        </div>
                        </div></div>
                        
  