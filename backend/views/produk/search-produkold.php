<?php

use yii\helpers\Url;
use yii\bootstrap4\Html;

$no_acak = Yii::$app->user->identity->no_acak;
?>
<!-- begin row -->
<div class="row">
    <!-- begin col-12 -->
    <div class="col-md-12">
        <div class ='panel panel-inverse'>
            <div class="panel-heading ui-sortable-handle">
                <div class="btn-group btn-group-toggle pull-right" data-toggle="buttons">
                    <?= Html::button('Cari Agen Promo lain', ['class' => "btn btn-info showModalButton", 'value' => Url::to(['cari-agen-promo-lain'])]) ?>

                </div>
                <h4 class="panel-title">Pencarian..</h4>
            </div>

            <div class='panel-body'>
                <?php
                $form = \yii\bootstrap4\ActiveForm::begin([
                            //     'type'=> kartik\form\ActiveForm::TYPE_HORIZONTAL,
                            'id' => 'search-form-inline',
                                //       'fieldConfig'=> ['options' => ['class' => 'form-group mr-2']]
                        ])
                ?>

                <?=
                $form->field($modelDynamic, 'nama_item')->label('Nama Item')->textInput()
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
                $url = \yii\helpers\Url::to(['/produk/checkout']);

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
            <!-- end pagination -->
            <!-- begin result-list -->
            <ul class="result-list">
                <?php foreach ($databarang as $model) { ?>
                    <li>
                        <a href="#" class="result-image" style="background-image: url(<?php echo \yii\helpers\Url::to(Yii::getAlias('@sourcePathImg/') . $model['filename']) ?>)"></a>
                        <div class="result-info" >
                            <h4 class="title"><a href="javascript:;"><?= $model['item_barang'] ?>.</a></h4>
                            <p class="location"><?= $model['tgl_masuk'] ?></p>
                            <p class="desc" style="width:100%">
                                Sisa Stok <span class='label label-warning'><?= $model['stok_sisa'] ?></span>

                            </p>

                        </div>
                        <div class="result-price ">
                            <?= ' '. number_format($model['harga_jual'],0,',','.') ?> <small>Min : 1 PCS</small>
                            <?=
                            yii\bootstrap4\Html::button('BELI', [
                                'class' => 'btn btn-yellow btn-block showModalButton',
                                'value' => \yii\helpers\Url::to(['add-cart', 'id_data_barang' => $model['id']])
                            ])
                            ?>
                        </div>
                    </li>

                <?php } ?>				



            </ul>
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