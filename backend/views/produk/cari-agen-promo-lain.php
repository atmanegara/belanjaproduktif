<?php
use yii\helpers\Url;
use yii\bootstrap4\Html;

?>
<h4 class="title">Filter Wilayah</h4>
                <?php $form = \kartik\form\ActiveForm::begin() ?>
                
                <div class="form-group">
                    <?=
                    $form->field($modelDynamic, 'id_kab')->label('Kabupaten')->dropDownList($modelKabupaten, [
                        'prompt' => 'Pilih Salah Satu...',
                        'onChange' => 'tampilkankecamatan(this.value)'
                    ])
                    ?>
                </div> 
                <div class="form-group">
                    <?=
                    $form->field($modelDynamic, 'id_kecamatan')->label('Kecamatan')->dropDownList([], [
                        'prompt' => 'Pilih Kecamatan..',
                        'onChange' => 'tampilkankelurahan(this.value)'
                    ])
                    ?>   
                </div> 
                <div class="form-group">
                    <?=
                    $form->field($modelDynamic, 'id_kelurahan')->label('Kelurahan / Desa')->dropDownList([], [
                        'prompt' => 'Pilih Kelurahan..',
                         'onChange' => 'tampilkanagen(this.value)'
                    ])
                    ?>
                </div> 
  <div class="form-group">
                    <?=
                    $form->field($modelDynamic, 'id_data_agenx')->label('Nama Agen Promo')->dropDownList([], [
                        'prompt' => 'Pilih Agen...',
           //             'onChange' => 'tampilkankecamatan(this.value)'
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
      function tampilkanagen(id_kel) {
        $.get({
            url: "<?= Url::to(['/data-toko/tampilkan-toko-by-id-kel']) ?>",
            //type : 'get',
            data: {
                id_kel: id_kel
            },
            success: function (addhtml) {
                console.log(addhtml);
                $("#dynamicmodel-id_data_agenx").html(addhtml)
            }
        })
    }
</script>