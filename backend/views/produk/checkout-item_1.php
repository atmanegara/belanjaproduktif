
<?php

use yii\helpers\Url;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use kartik\grid\GridView;
?>


<div class="panel panel-inverse">

    <div class="panel-heading">
        Daftar Checkout
    </div>
    <div class='panel-body'>
        <?php
        $form = ActiveForm::begin([
                    'id' => 'checkoutitem',
                    'layout' => ActiveForm::LAYOUT_HORIZONTAL,
                        //	    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
        ]);
        ?>
        <div class="row row-space-10">
            <div class="col-md-12">
                <?= $form->field($model, 'id_metode_pembayaran')->dropdownList($modelMetodePembayaran, ['prompt' => 'Pilih salah satu..', 'onChange' => 'metodepembayaran(this.value)']) ?>
                <?= $form->field($model, 'id_ref_kurir')->dropdownList($modelRefKurir, ['prompt' => 'Pilih salah satu..']) ?>

                <?= $form->field($model, 'tgl_dikirim')->textInput(['type' => 'date']) ?>


                <?= $form->field($model, 'jam_dikirim')->textInput(['placeholder' => '24:00']) ?>

            </div>
        </div>
        <div class="row row-space-10">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-cart">
                        <thead>
                            <tr>
                                <th width='5.5%'>#</th>
                                <th width=''>Product Name</th>
                                <th width='' class="text-center">Price</th>
                                <th width='' class="text-center">Quantity</th>
                                <th width='' class="text-center">Total</th>
                                <th ></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            foreach ($dataItem as $item) {
                                $total += $item['total'];
                                ?>
                                <tr>
                                    <td><?php
                                        echo Html::checkbox('pilih[]', true, [
                                            'class' => 'form-control',
                                            'value' => $item['id'],
                                        ])
                                        ?></td>
                                    <td class="cart-product">
                                        <div class="product-img">
                                            <img src="<?php echo Url::to(Yii::getAlias('@sourcePathImg/') . $item['filename']) ?>" alt="" />
                                        </div>
                                        <div class="product-info">
                                            <div class="title"><?= $item['item_barang'] ?></div>
                                            <div class="desc">Tanggal Pesanan Masuk <?= $item['tgl_masuk'] ?></div>
                                            <div class="desc"><?php
                                                switch ($item['kode_status_qty']) {
                                                    case 'Y':
                                                        $html = "";
                                                        break;
                                                    case 'N':
                                                        $html = "<span class='label label-warning'>" . $item['status_qty'] . "</span>";
                                                        break;
                                                    case 'X':
                                                        $html = "<span class='label label-danger'>" . $item['status_qty'] . "</span>";
                                                        break;
                                                }

                                                echo $html;
                                                ?></div>
                                        </div>
                                    </td>
                                    <td class="cart-price text-center"><?= number_format($item['harga_jual'], 0, ',', '.') ?></td>
                                    <td class="cart-qty text-center">
                                        <div class="cart-qty-input">
                                            <input type="text" name="checkoutitem[qty]" value="<?= $item['qty'] ?>" disabled class="form-control" id="qty" />
                                        </div>
                                        <div class="qty-desc">Min : 1 pcs</div>
                                    </td>
                                    <td class="cart-total text-center">
                                        <?= number_format($item['total'], 0, ',', '.') ?>
                                    </td>
                                    <td>
                                        <?php
                                        $url = Url::to(['/addcart/edit-item', 'id' => $item['id']]);
                                        echo Html::button("<i class='fa fa-edit'></i>", ['class' => 'btn btn-md btn-success showModalButton', 'value' => $url]);
                                        ?>      
                                        <?php
                                        $url = Url::to(['/addcart/delete', 'id' => $item['id']]);
                                        echo Html::a("<i class='fa fa-trash'></i>", $url, ['class' => 'btn btn-md btn-danger ',
                                            'data' => [
                                                'confirm' => 'Yakin item ini mau dihapus?',
                                                'method' => 'post'
                                            ]
                                        ]);
                                        ?>
                                    </td>

                                </tr>
                            <?php } ?>

                            <?php
                            if ($item['kode_status_qty'] == 'N') {
                                echo '<div class="alert alert-danger fade show">ADA ITEM STOKNYA KURANG DARI PERMINTAAN</div>';
                            }
                            ?>                    <tr>
                                <td class="cart-summary" colspan="5">

                                    <div class="summary-container">
                                        <div class="summary-row">
                                            <div class="field">Subtotal</div>
                                            <div class="value"><?php echo number_format($total, 0, ',', '.') ?></div>
                                        </div>

                                        <div class="summary-row total">
                                            <div class="field">Total</div>
                                            <div class="value"><?php echo number_format($total, 0, ',', '.') ?></div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>


        <!-- END checkout-body -->
        <!-- BEGIN checkout-footer -->
        <div class="checkout-footer">

            <?php
            if ($item['kode_status_qty'] == 'N') {
                echo Html::button('Checkout', ['class' => 'btn btn-warning btn-lg p-l-30 p-r-30 m-l-10']);
            } else {
                echo Html::submitButton('Checkout', ['class' => 'btn btn-warning btn-lg p-l-30 p-r-30 m-l-10']);
            }
            ?>
        </div>
        <!-- END checkout-footer -->
        <?php ActiveForm::end() ?>
    </div>
</div>


<script>
    ambiljam = (jam) => {
        $('#checkoutitem-jam_dikirim').val(jam);
        return false;
    }

    const metodepembayaran = (id_metode_pembayaran) => {
        if (id_metode_pembayaran != '2') {
            $("#checkoutitem-id_ref_kurir").prop('disabled', true);
            $("#checkoutitem-id_ref_kurir").val('0');
        } else {
            $("#checkoutitem-id_ref_kurir").prop('disabled', false);

        }
    }
</script>