<?php

use yii\helpers\Url;
use kartik\form\ActiveForm;
use kartik\file\FileInput;
use yii\bootstrap4\Html;
use kartik\detail\DetailView;
?>
<p>
    <?= Html::a('<i class="fa fa-backward"></i> Kembali', ['/produk/list-checkout-payment'], ['class' => 'btn btn-default']) ?>

</p>
<div class='panel panel-inverse'>
    <div class='panel-heading'>
        Daftar Invoice #<?=$no_invoice?>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <?=
                DetailView::widget([
                    'panel' => [
                        'heading' => 'Data Pesanan',
                        'type' => DetailView::TYPE_INFO
                    ],
                    'buttons1' => false,
                    'model' => $detailPembayaran,
                    'attributes' => [
                        [
                            'label' => 'Metode Pembayaran',
                            'attribute' => 'id_metode_pembayaran',
//                        'value'=>function($model){
//                return $model->id_metode_pembayaran;
//                        },
                            'value' => $detailPembayaran->metodePembayaran->ket
                        ],
                        [
                            'attribute' => 'id_ref_kurir',
                            'label' => 'Kurir',
                            'value' => function()use($detailPembayaran){
                            
                           $cekDataKurir =  backend\models\DetailPembayaranKurir::find()->where(['no_invoice'=>$detailPembayaran['no_invoice']]);
                           if($cekDataKurir->exists()){
                               $kurir = $cekDataKurir->one();
                               $dataKurir = (new \yii\db\Query())
                                       ->select('a.nama_kurir jns_kurir,b.nama_kurir')
                                       ->from('ref_kurir a')
                                       ->innerJoin('data_kurir b','a.id=b.id_ref_kurir')->where(['b.id'=>$kurir['id_data_kurir']])->one();
                               
                           }
                           return $dataKurir['nama_kurir'] .' ( '.$dataKurir['jns_kurir'].' )';
                            }
                        ],
                        [
                            'label' => 'Jadwal Pengiriman (Tanggal - Jam)',
                            'value' => $detailPembayaran['tgl_dikirim'] . ', ' . $detailPembayaran['jam_dikirim']
                        ]
                    ]
                ])
                ?>
            </div>
            <div class="col-md-6">
                <?=
                DetailView::widget([
                    'panel' => [
                        'heading' => 'Data Penerima',
                        'type' => DetailView::TYPE_INFO
                    ],
                    'buttons1' => false,
                    'model' => $dataAgenPenerima,
                    'attributes' => [
                        'id_agen', 'nama_agen', 'alamat'
                    ]
                ])
                ?> 
            </div>
        </div>
        <div class="checkout">

            <?php
            $form = ActiveForm::begin([
                        'id' => 'login-form-horizontal',
                        //	    'type' => ActiveForm::TYPE_HORIZONTAL,
                        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
            ]);
            ?>
            
            <!-- BEGIN checkout-header -->
            <div class="checkout-body">
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
                                ?>
                                <tr>

                                    <td class="cart-product">
                                        <?= $item['nama_item'] ?>
                                    </td>
                                    <td class="cart-price text-center"><?= number_format($item['harga_jual'], 0, ',', '.') ?></td>
                                    <td class="cart-qty text-center">

                                        <?= $item['qty'] ?>

                                    </td>
                                    <td class="cart-total text-center">
                                        <?= number_format($item['total'], 0, ',', '.') ?>
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

                                <td class="cart-summary" colspan="4">
                                    <div class="summary-container">


                                        <div class="summary-row total">
                                            <div class="field">Total</div>
                                            <div class="value"><?php echo number_format($total, 0, ',', '.'); ?></div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <hr />

            <!-- END checkout-body -->
            <!-- BEGIN checkout-footer -->
            <div class="checkout-footer">

                <?php
                if ($model['id_status_pembayaran'] == 2) {
                    echo \yii\bootstrap4\Alert::widget([
                        'options' => [
                            'class' => 'alert-success',
                        ],
                        'closeButton' => false,
                        'body' => 'Sudah dikonfirmasi',
                    ]);
                } else {
                   
                    ?>
                <div class="row">
                    <div class="col-md-6">
                         <?=  $form->field($model, 'nominal_ojek')->widget(kartik\number\NumberControl::class, [
                            'pluginEvents' => [
                "change " => "function(){
                   hitungan(this.value);
                }",
            ],
                        'options' => [
                            'required' => 'required'
                        ],
                        'maskedInputOptions' => [
                            'prefix' => 'Rp ',
                            'groupSeparator' => '.',
                            'radixPoint' => ',',
                            'rightAlign' => false
                        ],
                    ]); ?>  
                    </div>
                <div class="col-md-6">
                     <?=  $form->field($model, 'duit_kembali')->label('Sisa')->textInput(['readOnly'=>true])  ?>   
                    </div>
                </div>
                <?= $form->field($model, 'total_bayar')->label(false)->hiddenInput(['value' => $total]);?>
                <p>
                 <?php
                    echo Html::submitButton('Konfirmasi Pembayaran', ['class' => 'btn btn-inverse btn-lg p-l-30 p-r-30 m-l-10']);
                  echo Html::a('Batal',['batal-pesanan','no_invoice'=>$no_invoice], ['class' => 'btn btn-danger btn-lg p-l-30 p-r-30 m-l-10','data'=>[
            'method'=>'post',
            'confirm'=>'Anda Yakin Batalkan Pesanan'
        ]]) ;
                }
                ?>
                </p>
                <!-- END checkout-footer -->
                <?php
                ActiveForm::end();
                ?>
            </div>      
        </div>
    </div>            
    <!-- END #checkout-payment -->
    
    <script>
    hitungan = (duit) =>{
        const tunai = $("#pembayaranjualbeli-nominal_ojek-disp").val();
        const totalbayar = $("#pembayaranjualbeli-total_bayar").val();
   const kembali = duit-totalbayar;
     $("#pembayaranjualbeli-duit_kembali").val(kembali);
    }
    
    </script>