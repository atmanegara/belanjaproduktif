<?php

use yii\bootstrap4\Html;
?>
        <div class="section-container" id="checkout-payment">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN checkout -->
                <div class="checkout">
        <div class="panel panel-primary">
            <div class="panel-body">
                <?=
                $this->render('print-lampiran-toko', [
              'model'=>$model,'no_invoice'=>$no_invoice,'modelBooking'=>$modelBooking
                ])
                ?>
            </div>
            <div class="panel-body">
                <p>
<?= Html::a('Download PDF', ['print-lampiran-toko', 'no_invoice' => $no_invoice, 'export' => 'pdf'], ['class' => 'btn btn-md btn-warning']) ?>
                </p>
            </div>
        </div>
    </div>
</div>
        </div>