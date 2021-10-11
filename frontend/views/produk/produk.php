<?php

use yii\helpers\Url;
use yii\bootstrap4\Html;
use yii\bootstrap4\LinkPager;
?>
<!-- BEGIN search-results -->
<div id="search-results" class="section-container bg-silver">
    <!-- BEGIN container -->
    <div class="container">
        <!-- BEGIN search-container -->
        <div class="search-container">
            <!-- BEGIN search-content -->
            <div class="search-content">
                <!-- BEGIN search-toolbar -->
                <div class="search-toolbar">
                    <!-- BEGIN row -->
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Daftar Produk Barang</h4>
                        </div>
                        <!-- END col-6 -->
                        <!-- BEGIN col-6 -->

                        <!-- END col-6 -->
                    </div>
                    <!-- END row -->
                </div>
                <!-- END search-toolbar -->
                <!-- BEGIN search-item-container -->
                <div class="search-item-container">
                    <!-- BEGIN item-row -->
                    <div class="item-row">
                        <?php
                        $no = 0;
                        foreach ($dataBarang as $model) {
                            $no++;
                            if($model['id']){
                                ?>
                        
                            <!-- BEGIN item -->
                            <div class="item item-thumbnail">
                                <a href="<?php echo Url::to(['/produk/produk-detail', 'id' => $model['id']]) ?>" class="item-image">
                                    <img
                                        src="<?php echo Url::to(Yii::getAlias('@sourcePathImg/') . $model['filename']) ?>"
                                        alt="" />
                                    <div class="discount"><?php echo $model['stok_sisa'] ?></div>
                                </a>
                                <div class="item-info">
                                    <h4 class="item-title">
                                        <?= Html::a($model['item_barang'], ['/produk/produk-detail', 'id' => $model['id']]) ?>
                                    </h4>
                                    <p class="item-desc">Toko  : <?=$model['nama_toko']?></p>
                                    <div class="item-price"><?php echo $model['harga_jual']; ?></div>
                                    <div class="item-discount-price"></div>
                                </div>
                            </div>
                            <!-- END item -->
                        <?php }else{ ?>
                               
                            <!-- BEGIN item -->
                            <div class="item item-thumbnail">
                                <a href="#" class="item-image">
                                    <img
                                        src="<?php echo Url::to(Yii::getAlias('@sourcePathImg/') . $model['filename']) ?>"
                                        alt="" />
                                    <div class="discount"><?php echo $model['stok_sisa'] ?></div>
                                </a>
                                <div class="item-info">
                                    <h4 class="item-title">
                                        <?= Html::a($model['item_barang'], ['#']) ?>
                                    </h4>
                                    <p class="item-desc"><span class="label label-warning">PRODUK BELUM TERSEDIA DI AGEN TERDEKAT </span></p>
                                    <div class="item-price"><?php echo $model['harga_jual']; ?></div>
                                    <div class="item-discount-price"></div>
                                </div>
                            </div> 
                            <?php
                        }
                            }
                            ?>





                    </div>
                    <!-- END item-row -->
                    <!-- BEGIN item-row -->

                    <!-- END item-row -->
                    <!-- BEGIN item-row -->

                    <!-- END item-row -->
                </div>
                <!-- END search-item-container -->
                <!-- BEGIN pagination -->
                <div class="text-center">
                    <?php
                    echo LinkPager::widget([
                        'pagination' => $pages,
                    ]);
                    ?>
                </div>
                <!-- END pagination -->
            </div>
            <!-- END search-content -->
            <!-- BEGIN search-sidebar -->
            <div class="search-sidebar">
                <h4 class="title">Filter Wilayah</h4>
                <?php $form = \kartik\form\ActiveForm::begin() ?>
                  <div class="form-group">
                    <?=
                    $form->field($modelDynamic, 'nama_item')->label('Nama Item')->textInput()
                    ?>
                </div> 
                <div class="form-group">
                    <?=
                    $form->field($modelDynamic, 'id_kab')->label('Kabupaten')->widget(kartik\select2\Select2::class, [
                        'data'=>$modelKabupaten,
                             'bsVersion' => '3.x',
                        'options' => [
                        'placeholder'=>'Pilih Salah Satu...',
                        'onChange' => 'tampilkankecamatan(this.value)'
                            ],
                        'pluginOptions'=>[
                            'allowClear'=>true
                        ]
                    ])
                    ?>
                </div> 
                <div class="form-group">
                    <?=
                         $form->field($modelDynamic, 'id_kecamatan')->label('Kecamatan')->widget(kartik\select2\Select2::class, [
                        'data'=>[],
                             'bsVersion' => '3.x',
                        'options' => [
                        'placeholder'=>'Pilih Salah Satu...',
                        'onChange' => 'tampilkankelurahan(this.value)'
                            ],
                        'pluginOptions'=>[
                            'allowClear'=>true
                        ]
                    ])
                    
                    ?>   
                </div> 
                <div class="form-group">
                    <?=
                          $form->field($modelDynamic, 'id_kelurahan')->label('Kelurahan / Desa')->widget(kartik\select2\Select2::class, [
                        'data'=>[],
                             'bsVersion' => '3.x',
                        'options' => [
                        'placeholder'=>'Pilih Salah Satu...',
                             ],
                        'pluginOptions'=>[
                            'allowClear'=>true
                        ]
                    ])
                        
                   
                    ?>
                </div> 
                <div class="m-b-30">
                    <p>
<?= Html::submitButton('<i class="fa fa-search"></i> Filter', ['class' => 'btn btn-sm btn-inverse']) ?>
                        
<?= Html::a('Reset',['/produk'], ['class' => 'btn btn-sm btn-warning']) ?>
                    </p>
                </div>
<?php \kartik\form\ActiveForm::end() ?>
                <!--				<form action="product.html" method="POST" name="filter_form">
                                                        <div class="form-group">
                                                                <label class="control-label">Keywords</label> <input type="text"
                                                                        class="form-control input-sm" name="keyword"
                                                                        value="Mobile Phones" placeholder="Enter Keywords" />
                                                        </div>
                                                
                                                        <div class="m-b-30">
                                                                <button type="submit" class="btn btn-sm btn-inverse">
                                                                        <i class="fa fa-search"></i> Filter
                                                                </button>
                                                        </div>
                                                </form>-->

            </div>
            <!-- END search-sidebar -->
        </div>
        <!-- END search-container -->
    </div>
    <!-- END container -->
</div>
<!-- END search-results -->
<script>
    function tampilkankecamatan(id_kab) {
        $.get({
            url: "<?= Url::to(['/kecamatan/tampilkan-kecamatan-by-id-kab']) ?>",
            //type : 'get',
            data: {
                id_kab: id_kab
            },
            success: function (addhtml) {
                $("#dynamicmodel-id_kecamatan").html(addhtml)
            }
        })
    }

    function tampilkankelurahan(id_kec) {
        $.get({
            url: "<?= Url::to(['/kelurahan/tampilkan-kelurahan-by-id-kec']) ?>",
            //type : 'get',
            data: {
                id_kec: id_kec
            },
            success: function (addhtml) {
                $("#dynamicmodel-id_kelurahan").html(addhtml)
            }
        })
    }
</script>