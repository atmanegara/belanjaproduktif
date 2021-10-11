<?php

use yii\helpers\Url;
use yii\bootstrap4\Html;

/* @var $this yii\web\View */

$this->title = '.:. Belanja Produktif';
?>
 <!-- BEGIN #slider -->
        <div id="slider" class="section-container p-0 bg-black-darker">
            <!-- BEGIN carousel -->
            <div id="main-carousel" class="carousel slide" data-ride="carousel">
                <!-- BEGIN carousel-inner -->
                <div class="carousel-inner"> 
                    <?php 
                    $no=0;
                    foreach ($dataContent as $contenSlide){
                        $no++;
                        ?>
                <!-- BEGIN carousel-inner -->
             
                    <!-- BEGIN item -->
                    <div class="item <?php 
                    if($no=="1"){
                        echo 'active';
                    }
                    ?>">
                        <img src="<?php echo Url::to(Yii::getAlias('@sourcePathImg/').$contenSlide['latar'])?>" class="bg-cover-img" alt="" />
                        <div class="container">
                            <img src="<?php echo Url::to(Yii::getAlias('@sourcePathImg/').$contenSlide['filename'])?>" class="product-img right bottom fadeInRight animated" alt="" />
                        </div>
                        <div class="carousel-caption carousel-caption-left">
                            <div class="container">
                                <h3 class="title m-b-5 fadeInLeftBig animated"><?php echo $contenSlide['judul']; ?></h3> 
<!--                                 <p class="m-b-15 fadeInLeftBig animated">The vision is brighter than ever.</p> -->
<!--                                 <div class="price m-b-30 fadeInLeftBig animated"><small>from</small> <span>$2299.00</span></div> -->
<!--                                 <a href="product_detail.html" class="btn btn-outline btn-lg fadeInLeftBig animated">Buy Now</a> -->
                            </div>
                        </div>
                    </div>
                    <!-- END item -->
                  
                 <?php }?>
                </div>
                <!-- END carousel-inner -->
                <a class="left carousel-control" href="#main-carousel" data-slide="prev"> 
                    <i class="fa fa-angle-left"></i> 
                </a>
                <a class="right carousel-control" href="#main-carousel" data-slide="next"> 
                    <i class="fa fa-angle-right"></i> 
                </a>
            </div>
            <!-- END carousel -->
        </div>
        <!-- END #slider -->
    
        <!-- BEGIN #promotions -->
        <div id="promotions" class="section-container bg-silver">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN section-title -->
               <h4 class="section-title clearfix">
                    Temukan yang Anda Inginkan
                </h4>
                <!-- END section-title -->
                <!-- BEGIN row -->
                <div class="row row-space-10">
                    <!-- BEGIN col-6 -->
                    
                    <!-- END col-6 -->
                    <!-- BEGIN col-3 -->
<!--                    <div class="col-md-6 col-sm-6">
                         BEGIN promotion 
                        <div class="promotion bg-blue">
                            <div class="promotion-image promotion-image-overflow-bottom promotion-image-overflow-top">
                               <i class="fa fa-dollar-sign fa-fw"></i>
                            </div>
                            <div class="promotion-caption promotion-caption-inverse text-right">
                                <h4 class="promotion-title">BERLANGGANAN</h4>
                               
                                <a href="<?= Url::to(['site/contact'])?>" class="promotion-btn">View More</a>
                            </div>
                        </div>
                         END promotion 
                         BEGIN promotion 
                       
                         END promotion 
                    </div>-->
                     <div class="col-md-6 col-sm-6">
                        <!-- BEGIN promotion -->
                        <div class="promotion bg-blue">
                            <div class="promotion-image promotion-image-overflow-bottom promotion-image-overflow-top">
                                <img src="<?= Yii::getAlias('@web').'/image/Join-us.png' ?>" alt="" />
                            </div>
                            <div class="promotion-caption promotion-caption-inverse text-right">
                                <h4 class="promotion-title">JOIN WITH US</h4>
                                <a href="<?= Yii::getAlias("@admin_frontend").'/web/registrasi-agen/create' ?>" class="promotion-btn">View More</a>
                            </div>
                            
                        </div>
                       
                        <!-- END promotion -->
                        <!-- BEGIN promotion -->
                       
                        <!-- END promotion -->
                    </div>
              <div class="col-md-3 col-sm-6">
                        <!-- BEGIN promotion -->
                        <div class="promotion bg-blue">
                            <div class="promotion-image promotion-image-overflow-bottom promotion-image-overflow-top">
                                <img src="../assets/img/product/product-apple-watch-sm.png" alt="">
                            </div>
                            <div class="promotion-caption promotion-caption-inverse text-center">
                                <h4 class="promotion-title">TOTAL AGEN TERDAFTAR</h4>
                                <hr>
                                <div class="promotion-price"><?=$totalAgen?> ORANG</div>
                             
                            </div>
                        </div>
                     
                        <!-- END promotion -->
                    </div>
 <div class="col-md-3 col-sm-6">
                        <!-- BEGIN promotion -->
                        <div class="promotion bg-green">
                            <div class="promotion-image promotion-image-overflow-bottom promotion-image-overflow-top">
                                <img src="../assets/img/product/product-apple-watch-sm.png" alt="">
                            </div>
               <div class="promotion-caption promotion-caption-inverse text-center">
                                <h4 class="promotion-title">TOTAL MITRA TOKO</h4>
                            <hr>       <div class="promotion-price"><?=$totalToko?> TOKO</div>
                             
                            </div>
                        </div>
                     
                        <!-- END promotion -->
                    </div>
                    <!-- END col-3 -->
                   
                </div>
                <!-- END row -->
            </div>
            <!-- END container -->
        </div>
        <!-- END #promotions -->
    <div class="about-us-content">
             <div class="container">           <h2 class="title text-center clearfix">VISI & MISI</h2>
        
                    <!-- BEGIN row -->
                    <div class="row">
                        <!-- begin col-4 -->
                        <div class="col-md-12 col-sm-12">
                            <div class="service">
                                <div class="info">
                                    <p class="desc"><?= $visimisi['visi'] ?></p>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                    <!-- END row -->
                    <hr>

                </div>
    </div>
        <!-- BEGIN #trending-items -->
        <div id="trending-items" class="section-container bg-silver">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN section-title -->
                <h4 class="section-title clearfix">
                   
                    <a href="<?= Url::to(['/produk'])?>" class="pull-right">SHOW ALL</a>
                    Produk Item
                    <small>List item yang terdapat pada agen agen kami!</small>
                </h4>
                    
                <!-- END section-title -->
            
                <!-- BEGIN row -->
                <div class="row row-space-10">
            <?php foreach ($dataBarang as $model){
                    $filename=$model['filename'];
                if($model['filename']=='0'){
                    $filename='no-product-image.jpg';
                }
                ?>
                    <!-- BEGIN col-2 -->
                    <div class="col-md-2 col-sm-4">
                        <!-- BEGIN item -->
                        <div class="item item-thumbnail">
                            <a href="<?= Url::to(['/produk/produk-detail','id'=>$model['id']])?>" class="item-image">
                                <img src="<?php echo Url::to(Yii::getAlias('@sourcePathImg/').$filename)?>" alt="" />
                                <div class="discount"><?php echo $model['stok_sisa']?></div>
                            </a>
                            <div class="item-info">
                                <h4 class="item-title">
                                  <?= Html::a($model['item_barang'],['/produk/produk-detail','id'=>$model['id']])?>
                                </h4>
                                <div class="item-price"><?php echo number_format($model['harga_jual'],0,',','.');?></div>
                                <div class="item-discount-price">-</div>
                            </div>
                        </div>
                        <!-- END item -->
                    </div>
                    <!-- END col-2 -->
                    <?php }?>
                </div>
                <!-- END row -->
            </div>
            <!-- END container -->
        </div>
        <!-- END #trending-items -->
    
   
    
        <!-- BEGIN #policy -->
        <div id="policy" class="section-container p-t-30 p-b-30">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN row -->
                <div class="row">
                   <?php foreach($berita as $valBerita){?>
                    <div class="col-md-4 col-sm-4">
                        <!-- BEGIN policy -->
                        <div class="policy">
                            <div class="policy-icon"><i class="<?=$valBerita['icon']?>"></i></div>
                            <div class="policy-info">
                                <h4><?=$valBerita['title']?></h4>
                                <p><?=$valBerita['isi']?></p>
                            </div>
                        </div>
                        <!-- END policy -->
                    </div>
                   <?php }?>
                    <!-- END col-4 -->
                    <!-- BEGIN col-4 -->
                   
                    <!-- END col-4 -->
                    <!-- BEGIN col-4 -->
                  
                    <!-- END col-4 -->
                </div>
                <!-- END row -->
            </div>
            <!-- END container -->
        </div>
        <!-- END #policy -->
    
         
    
       
    </div>
    <!-- END #page-container -->
