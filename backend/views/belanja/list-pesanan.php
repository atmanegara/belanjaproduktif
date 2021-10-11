<div class="widget-list widget-list-rounded m-b-30" data-id="widget">
    <?php foreach ($dataProvider->getModels() as $val) { ?>
        <div class="widget-list-item">
            <div class="widget-list-media">
                <img src="../assets/img/user/user-12.jpg" alt="" class="rounded">
            </div>
            <div class="widget-list-content">
                <h4 class="widget-list-title">[ #<?= $val['no_invoice'] . ', Tgl Transaksi : ' . $val['tgl_masuk'] ?> ]</h4>
                <p class="widget-list-desc"> 
                    <?php
                    $itemAll = backend\models\CheckoutItem::find()->where(['no_invoice' => $val['no_invoice']])->all();
                    $listItem = '';
                    foreach ($itemAll as $valItem) {
                        $listItem .= "<li>" . $valItem['nama_item'] . ' : ' . number_format($valItem['total'], 0, ',', '.') . "</li>";
                    }
                    $orderList = "<ol>" . $listItem . "</ol>";
                    ?>
                    <?php
                    echo $orderList;
                 //   echo "<hr>";
                    echo 'Total : '.number_format($val['sum_total'], 0, ',', '.');
                    ?></p>
            </div>
            <div class="widget-list-action">
                <a href="<?= yii\helpers\Url::to(['search-invoice', 'no_invoice' => $val['no_invoice']]) ?>"  class="btn btn-md btn-warning"><i class="fa fa-search"></i> LACAK</a>

            </div>
        </div>
<?php } ?>

</div>