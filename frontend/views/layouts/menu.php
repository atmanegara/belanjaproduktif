<?php
use yii\bootstrap4\Html;
use backend\models\Addcart;
?>
      <!-- BEGIN #header -->
        <div id="header" class="header">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN header-container -->
                <div class="header-container">
                    <!-- BEGIN navbar-header -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="header-logo">
                            <a href="/">
                                <img src="<?= Yii::getAlias('@web').'/image/logo-login.jpg' ?>" width="26%" height="98%">
                                <span>Belanja</span>Produktif
                            </a>
                        </div>
                    </div>
                    <!-- END navbar-header -->
                    <!-- BEGIN header-nav -->
                    <div class="header-nav">
                        <div class=" collapse navbar-collapse" id="navbar-collapse">
                            <ul class="nav">
                                <li class="active"><?= Html::a('Home',['/site'])?></li>
                         
                                <li><?= Html::a('Produk',['/produk'])?></li>
                             
                                        <li><?= Html::a('Kontak Kami',['/site/contact'])?></li>
                         
                             <li ><?= Html::a('Tentang Kami',['/site/about'])?></li>
                         
                             <li><?= Html::a('FAQ',['/site/faq'])?></li>
                            <?php if(!Yii::$app->user->isGuest){?>
                             <li ><?= Html::a('Data Pribadi',['/data-pribadi'])?></li>
                            <?php }?>
                            </ul>
                        </div>
                    </div>
                    <!-- END header-nav -->
                    <!-- BEGIN header-nav -->
                    <div class="header-nav">
                        <ul class="nav pull-right">
                        <?php 
                        
                        if(!Yii::$app->user->isGuest){
                            
                            $no_acak = Yii::$app->user->identity->no_acak;
                            ?>
                            <li>
                                <a href="<?=\yii\helpers\Url::to(['/produk/checkout','no_acak'=>$no_acak])?>" class="header-cart" >
                                    <i class="fa fa-shopping-bag"></i>
                                    <span class="total"><?= Addcart::getTotalByNoacak($no_acak);?></span>
                                    <span class="arrow top"></span>
                                </a>
                    
                              
                            </li>
                            <?php }?>
                            <li class="divider"></li>
                              <?php if(!Yii::$app->user->isGuest){?>
                                <li >
                                <a href="<?= \yii\helpers\Url::to(['/site/logout']) ?>" class="header-cart" data-method="POST">
                                    <img src=<?= Yii::getAlias('@web') ?>"/color-admin/assets/img/user/user-1.jpg" class="user-img" alt="" /> 
                                    <span class="hidden-md hidden-sm hidden-xs">Keluar</span>
							
                                </a>
								
                            </li>
                              <?php }else{?>
                                
            <li class="">
            <?= Html::a('          <i class="fa fa-key"></i>
                           Login',Yii::getAlias("@admin_backend").'/web/site/login',['class'=>'']) ?>
               

            </li>
            <li class="active">
            <?= Html::a('<i class="fa fa-users"></i> Registrasi',Yii::getAlias("@admin_frontend").'/web/registrasi-agen/create',['class'=>'']) ?>    
</li>
<?php }?>
                    
                        </ul>
                    </div>
                    <!-- END header-nav -->
                </div>
                <!-- END header-container -->
            </div>
            <!-- END container -->
        </div>
        <!-- END #header -->
    