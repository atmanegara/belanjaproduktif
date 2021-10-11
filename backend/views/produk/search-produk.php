<?php

use yii\helpers\Url;
use yii\bootstrap4\Html;

$no_acak = Yii::$app->user->identity->no_acak;
?>
<!-- begin row -->
<div class="row">
    <!-- begin col-12 -->
    <div class="col-md-12">
    <?php 
          \yii\widgets\Pjax::begin(['id' => 'grid', 'timeout' => 0]); ?>
        <div class ='panel panel-inverse' >
            <div class="panel-heading ui-sortable-handle">
                <div class="btn-group btn-group-toggle pull-right" data-toggle="buttons">
                    <?= Html::button('Cari Agen Promo lain', ['class' => "btn btn-info showModalButton", 'value' => Url::to(['cari-agen-promo-lain'])]) ?>

                </div>
                <h4 class="panel-title">Daftar Item Belanja</h4>
            </div>

            <div class='panel-body'>
                <?php
                $form = \yii\bootstrap4\ActiveForm::begin([
                    
 'method'=>'get',    
                    
                            'id' => 'search-form-inline',
                            'options' => [
                                'data-pjax' => 1
                            ],
                        ])
                ?>

                <?=
                $form->field($modelDynamic, 'nama_item')->label('Cari Berdasarkan Nama Item / Kode Item / Kode Barcode Item')->textInput()
                ?>
                <?=
                $form->field($modelDynamic, 'id_data_agen')->label(false)->hiddenInput(['value' => $id_data_agen])
                ?>

                <?= Html::submitButton('<i class="fa fa-search"></i> Filter', ['class' => 'btn btn-md btn-inverse mr-1']) ?>

                <?= Html::a('Reset', ['/produk/search-produk'], ['class' => 'btn btn-md btn-warning']) ?>
                <?php \yii\bootstrap4\ActiveForm::end() ?>	 
            </div>
        </div>

        <div class="result-container">
            <div class="btn-group m-b-20">

                <a href="javascript:;" class="btn btn-white btn-white-without-border"><?= backend\models\Addcart::getTotalByNoacak($no_acak); ?></a> 
                <?php
                $url = \yii\helpers\Url::to(['/produk/list-keranjang']);

                echo Html::a("<i class='fa fa-cart-arrow-down'></i> Keranjang", $url, ['class' => 'btn btn-default m-r-5']);
                //    echo Html::a("<i class='fa fa-cart-arrow-down'></i> Keranjang", $url, ['class'=>'btn btn-default m-r-5']);
                ?>
            </div>
            <!-- end btn-group -->
            <!-- begin pagination -->
            <?php
            echo yii\bootstrap4\LinkPager::widget([
                'pagination' => $pages,
            ]);
            ?>
            <div class="col-md-12">
                <!-- end pagination -->
                <!-- begin result-list -->
                <div id="gallery" class="gallery isotope">
                    <div class='row row-space-10 m-b-20'>
                    <?php foreach ($databarang as $model) { ?>
                    
                        <div class="image gallery-group-1 isotope-item">
                            <div class="image-inner">
                                <a href="#" class="result-image" data-lightbox="gallery-group-1" >
                                <?= Html::img(\yii\helpers\Url::to(Yii::getAlias('@sourcePathImg/')) . $model['filename'],[
                                        'style'=>'width:100%'
                                    ]) ?>
                                </a>

                                <p class="image-caption" style="top: -1px;left:-11px;background: none">
                                    <?php
                                    if($model['stok_sisa']<=0  ){
                                      echo yii\bootstrap4\Html::button('STOK HABIS', [
                                        'class' => 'btn btn-danger ',
                                    ]);   
                                    }else{
                                    echo yii\bootstrap4\Html::button('BELI', [
                                        'class' => 'btn btn-yellow btn-block showModalButton',
                                        'value' => \yii\helpers\Url::to(['add-cart', 'id_data_barang' => $model['id']])
                                    ]);
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="image-info">
                                <h6 ><?='[ '.$model['kode_barcode'].' ] '. $model['item_barang'] ?></h6> 
                                <h5>Sisa Stok : <span class="label label-success"><?php echo $model['stok_sisa'] ?></span></h5>
                               

                                <div class="desc">
                                    <b><h5 class="title"><?=number_format($model['harga_jual'], 0, ',', '.') ?></b>, Min : 1 <?= strtoupper($model['nama_satuan']) ?></h5> ,
                              <div class="pull-right" >
                                    <small>Toko : </small><?=$model['nama_toko']?>
                                </div>
                                </div>
                            </div>
                        </div>


                    <?php } ?>				
                </div>
                </div>
            </div>

            <!-- end result-list -->
            <!-- begin pagination -->
            <div class="clearfix m-t-20">
                <?php
                echo yii\bootstrap4\LinkPager::widget([
                    'pagination' => $pages,
                ]);
                ?>
            </div>
            <!-- end pagination -->
        </div>
        <!-- end result-container -->
    </div>
    <?php 
               \yii\widgets\Pjax::end();?>
    <!-- end col-12 -->
</div>
<!-- end row -->

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