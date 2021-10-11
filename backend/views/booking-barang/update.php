<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\number\NumberControl;
use yii\widgets\MaskedInput;
/* @var $this yii\web\View */
/* @var $model backend\models\BookingBarang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="booking-barang-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
  <div class="col-md-4">
        
<?=$form->field($model,'duit_tunai')->widget(kartik\number\NumberControl::class, [
                            'pluginEvents' => [
                "change " => "function(){
                   hitung(this.value);
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
                    ]); ?>  ?>    
    </div>
        <div class="col-md-4">
        <?=$form->field($model,'total')->textInput(['value'=>$modelTotalInvoice,'readOnly'=>true])?>
    </div>
    
     <div class="col-md-4">
        
<?=$form->field($model,'duit_kembali')->textInput(['readOnly'=>true])?>    
    </div>
    </div>
    <?= $form->field($model, 'status_booking')->label(false)->hiddenInput(['value'=>2]) ?>
 
    <div class="form-group">
        <?= Html::submitButton('Simpan Selesai', ['class' => 'btn btn-success']) ?>
       
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
const hitung=(duittunai)=>{
    const total = $("#bookingbarang-total").val();
  //  const tunai = $("#bookingbarang-duit_tunai").val();
    const kembali = duittunai-total;
    $("#bookingbarang-duit_kembali").val(kembali)
}
</script>