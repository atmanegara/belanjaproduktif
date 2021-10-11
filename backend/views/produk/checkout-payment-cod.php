<?php

use yii\helpers\Url;
use kartik\form\ActiveForm;
use kartik\file\FileInput;
use yii\bootstrap4\Html;
?>
<p>
    <?= Html::a("<i class='fa fa-home'></i> Kembali",['list-checkout-payment'],['class'=>'btn btn-default'])?>
</p>
<!-- BEGIN #checkout-payment -->
<div class='panel panel-inverse'>
    <div class='panel-heading'>

    </div>
    <div class="panel-body">
        <?=
        yii\widgets\DetailView::widget([
            'model' => $detailPembayaran,
            'attributes' => [
                [
                    'label' => 'Metode Pembayaran',
                    'value' => function($model) {
                        return $model->metodePembayaran->ket;
                    }
                ],
                [
                    'format' => 'raw',
                    'label' => 'Kurir',
                    'value' => function($model) {
                        if ($model['id_ref_kurir']) {
                            return $model->refKurir->nama_kurir;
                        } else {
                            return '-';
                        }
                    }
                ],
                [
                    'label' => 'Jadwal Pengiriman (Tanggal - Jam)',
                    'value' => function($model) {
                        return $model['tgl_dikirim'] . ', ' . $model['jam_dikirim'];
                    }
                ]
            ]
        ])
        ?>
        <?php
        $form = ActiveForm::begin([
                    'id' => 'login-form-horizontal',
                    //	    'type' => ActiveForm::TYPE_HORIZONTAL,
                    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
        ]);
        ?>
        <!-- BEGIN checkout-header -->
      <div class="row row-space-1">
            <div class="col-md-12">
                <div class="table-responsive"> 
        <table class="table table-cart">
            <thead>
                <tr>
                    <th width=''>Product Name</th>
                    <th width='' class="text-center">Price</th>
                    <th width='' class="text-center">Quantity</th>
                    <th width='' class="text-center">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($dataItem as $item) {
                    $total += $item['total'];
                                    $ongkir = $item['ongkir'];
                    ?>
                    <tr>

                        <td class="cart-product">
    <?= $item['nama_item'] ?>
                        </td>
                        <td class="cart-price text-center"><?= number_format($item['harga_jual'],0,',','.') ?></td>
                        <td class="cart-qty text-center">

    <?= $item['qty'] ?>

                        </td>
                        <td class="cart-total text-center">
    <?= number_format($item['total'],0,',','.') ?>
                        </td>

                    </tr>
                    <?php
//                                        echo $form->field($model,'id_metode_pembayaran')->label(false)->textInput(['value'=>$item['id_metode_pembayaran']]) ;
                    echo $form->field($model, 'no_acak')->label(false)->hiddenInput(['value' => $item['no_acak']]);
                    echo $form->field($model, 'no_invoice')->label(false)->hiddenInput(['value' => $item['no_invoice']]);
                    echo $form->field($model, 'no_virtual_akun')->label(false)->hiddenInput(['value' => $item['no_acak']]);
                    echo $form->field($model, 'no_berita')->label(false)->hiddenInput(['value' => $item['no_invoice']]);
                }
                ?>
                <tr>
                    <td class="" colspan="2">
                        <div style='border: 1px solid black;width:auto;height:70px'>
                            NO. VA : <b><?php echo str_pad($detailPembayaran['id'],'10',0,STR_PAD_LEFT)?></b>
                            <br>
                            <i>Jika transfer menggunakan Mobile Banking / internet Banking, masukkan berita dengan kode</i>
                            <b><?php echo $item['no_invoice'] ?></b>
                        </div>
                    </td>
                    <td class="cart-summary" colspan="2">
                        <div class="summary-container">
                          <div class="summary-row">
                                            <div class="field">Ongkos Kirim</div>
                                            <div class="value" id="idongkir"><?php echo number_format($ongkir, 0, ',', '.') ?></div>
                                        </div>

                                        <div class="summary-row">
                                            <div class="field">Subtotal</div>
                                            <div class="value"><?php echo number_format($total, 0, ',', '.') ?></div>
                                        </div>
  
                            <div class="summary-row total">
                                <div class="field">Total</div>
                                <div class="value"><?php
                                     echo number_format($total+$ongkir,0,',','.');
                                    ?></div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
                </div>
            </div>
      </div>

        <hr />

        <!-- END checkout-body -->
        <!-- BEGIN checkout-footer -->
        <div class="checkout-footer">

            <?php
            if ($modelDetailPembayaranKurir['status_pesanan_kurir'] == '1') {
                echo \yii\bootstrap4\Alert::widget([
                    'options' => [
                        'class' => 'alert-success',
                    ],
                    'closeButton'=>false,
                    'body' => 'Barang sudah diterima',
                ]);               
           //     echo Html::a('Print',['/belanja/print-faktur','no_invoice'=>$detailPembayaran['no_invoice']],['class'=>'btn btn-success btn-lg p-l-30 p-r-30 m-l-10']);
                $url= Url::to(['/belanja/print-thermal-faktur', 'no_invoice' => $detailPembayaran['no_invoice']]);
                    echo Html::a('Print Thermal ',$url,['class'=>'btn btn-default ',
          'onClick'=>
		                        "window.open('".$url."',
                         'newwindow',
                         'width=300,height=250');
              return false;"
        ]);        
            } else {
                echo $form->field($model, 'total_bayar')->label(false)->hiddenInput(['value' => $total]);

                echo Html::submitButton('DITERIMA', ['class' => 'btn btn-success btn-lg p-l-30 p-r-30 m-l-10']);
            }
            ?>


            <!-- END checkout-footer -->
            <?php
            ActiveForm::end();
            ?>
        </div>      
    </div>
</div>            
<!-- END #checkout-payment -->