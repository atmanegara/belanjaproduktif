
<?php

use yii\helpers\Url;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use kartik\grid\GridView;
?>






<div class="panel panel-inverse">

    <div class="panel-heading">
        Daftar Pesanan
    </div>
    <div class='panel-body'>
        <?php
        switch ($model->id_metode_pembayaran) {
            case 1:
                $judul = "APLIKASI";
                $desc = "Pengiriman sesuai tanggal aplikasi, untuk jam pastikan tidak sampai jam toko tutup, <b>JADWAL TOKO HARI INI : ".$modelJadwalToko['jam_awal'].' s/d '.$modelJadwalToko['jam_akhir'].'</b>';
                $labelTgl = "Tanggal Di Kirim";
                $labelJam = "Jam Di Kirim";
                break;
            case 2:
                $judul = "COD";
                $desc = "Pilih Mitra Ojek, pastikan jam pengiriman tidak sampai jam toko tutup, <b>JADWAL TOKO HARI INI : ".$modelJadwalToko['jam_awal'].' s/d '.$modelJadwalToko['jam_akhir'].'</b>';
                $labelTgl = "Tanggal Di Kirim";
                $labelJam = "Jam Di Kirim";
                break;
            case 3:
                $judul = "DI TOKO";
                $desc = "Pastikan jam booking tidak sampai jam toko tutup, <b>JADWAL TOKO HARI INI : ".$modelJadwalToko['jam_awal'].' s/d '.$modelJadwalToko['jam_akhir'].'</b>';
                $labelTgl = "Tanggal Pesan";
                $labelJam = "Jam Pengambilan (Di Toko)";
        }
        ?>

        <dl class="dl-horizontal">
            <dt class="text-inverse"><?= $judul ?></dt>
            <dd><?= $desc ?></dd>
        </dl>
        <hr>
        <?php
        $form = ActiveForm::begin([
                    'id' => 'checkoutitem',
                    'layout' => ActiveForm::LAYOUT_HORIZONTAL,
                        //	    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
        ]);
        ?>
        <div class="row row-space-1">
            <div class="col-md-12">
                <?= $form->field($model, 'id_metode_pembayaran')->label(false)->hiddenInput() ?>
                <?= $form->field($model, 'ongkir')->label(false)->hiddenInput() ?>
                <?php
                if ($model->id_metode_pembayaran == 2) {
                    echo $form->field($model, 'id_ref_kurir')->dropdownList($modelRefKurir, ['prompt' => 'Pilih salah satu..', 'required' => true,]);
                }
                ?>

<?=
$form->field($model, 'tgl_dikirim')->label($labelTgl)->textInput(['type' => 'date',
    'value' => date('Y-m-d'),
    'readOnly' => in_array($model->id_metode_pembayaran, [1, 2,3]) ? true : false
])
?>

<?=
$form->field($model, 'jam_dikirim')->label($labelJam)->widget(yii\widgets\MaskedInput::class, [
    'mask' => '99:99',
    'options' => [
        'required' => true,
        'onChange' => in_array($model->id_metode_pembayaran, [ 2]) ? 'cektarif(this.value)' : 'return false']
])
?>
<i id="infokurir"></i>
            </div>
        </div>
        <div class="row row-space-1">
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
                                            'hidden'=>true
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
                                        <div class="qty-desc">Min : 1 <?=$item['nama_satuan']?></div>
                                    </td>
                                    <td class="cart-total text-center">
                                        <?= number_format($item['total'], 0, ',', '.') ?>
                                    </td>
                                    <td>
                                        <?php
//                                        $url = Url::to(['/addcart/edit-item', 'id' => $item['id']]);
//                                        echo Html::button("<i class='fa fa-edit'></i>", ['class' => 'btn btn-md btn-success showModalButton', 'value' => $url]);
//                                       
//                                        $url = Url::to(['/addcart/delete', 'id' => $item['id']]);
//                                        echo Html::a("<i class='fa fa-trash'></i>", $url, ['class' => 'btn btn-md btn-danger ',
//                                            'data' => [
//                                                'confirm' => 'Yakin item ini mau dihapus?',
//                                                'method' => 'post'
//                                            ]
//                                        ]);
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
                                      <div style='border: 0px solid black;width:auto;height:20px'>
                                    <?php
                                    if($model->id_metode_pembayaran==1){
                                        ?>
                                     <div class="widget widget-stats bg-gradient-blue col-md-4">
			<div class="stats-icon stats-icon-lg"><i class="fa fa-dollar-sign fa-fw"></i></div>
			<div class="stats-content">
				<div class="stats-title">SALDO S/D HARI INI</div>
				<div class="stats-number"><?=number_format($saldo['nominal_awal'],2,',','.')?></div>
			</div>
		</div>
                                    <?php
                                    }
                                    ?>
                                      </div>
                                    <div class="summary-container"> 
                                        <div class="summary-row">
                                            <div class="field">Ongkos Kirim</div>
                                            <div class="value" id="idongkir"><?php echo number_format(0, 0, ',', '.') ?></div>
                                        </div>

                                        <div class="summary-row">
                                            <div class="field">Subtotal</div>
                                            <div class="value"><?php echo number_format($total, 0, ',', '.') ?></div>
                                        </div>

                                        <div class="summary-row total">
                                            <div class="field">Total</div>
                                            <div class="value" id="idtotalongkir"><?php echo number_format($total, 0, ',', '.') ?></div>
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
            echo Html::button('Checkout', [ 'id'=>'btnsubmit1', 'class' => 'btn btn-warning btn-lg p-l-30 p-r-30 m-l-10']);
        } else {
            echo $form->field($model, 'total')->label(false)->hiddenInput(['value'=>$total]);
            echo Html::submitButton('Checkout', ['id'=>'btnsubmit2','class' => 'btn btn-warning btn-lg p-l-30 p-r-30 m-l-10']);
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

    const cektarif = (jamkirim) => {
        const tglhari = $("#checkoutitem-tgl_dikirim").val();
        const id_ref_kurir = $("#checkoutitem-id_ref_kurir").val();
        const total = "<?= $total ?>";
        $.get({
            url: '<?= Url::to(['/ref-kurir/cektarif']) ?>',
            data: {
                tglhari:tglhari,
                id_ref_kurir: id_ref_kurir,
                jam_kirim: jamkirim
            },
            success: function (data) {
                const dataonkir = JSON.parse(data)
            //    console.log(dataonkir.ongkir);
                if(dataonkir.ongkir==null){
                    $("#infokurir").html('Tidak beroperasi pada jam ini');
                        $("#idongkir").html('0');
                $("#checkoutitem-ongkir").val('0');
                    $("#btnsubmit2").attr('disabled',true);
        }else{
                    $("#infokurir").html('');
                    $("#btnsubmit2").attr('disabled',false);
                    
                $("#idongkir").html(dataonkir.ongkir);
                $("#checkoutitem-ongkir").val(dataonkir.ongkir);
                $("#idtotalongkir").html(parseInt(dataonkir.ongkir) + parseInt(total));
            }
            }
        })
    }
</script>