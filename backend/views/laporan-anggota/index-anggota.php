<?php
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;
?>

<?php
$form = ActiveForm::begin([
    'id'=>'form-laporan-anggota-detail'
]);
?>
<div class="row row-space-10">
  
      <div class="col-md-4">
        <?= $form->field($modelDynamic,'id_ref_agen')->label('Agen')->widget(\kartik\select2\Select2::class,[
                'data'=>$items,
                'options'=>[
            'placeholder'=>'Pilih Jenis Agen yang ditampilkan..'
                    ],
            'pluginOptions'=>[
                'multiple'=>true
            ]
        ]) ?>
    </div>
</div>
<div class="form-group">
    <?=  Html::button('Preview',['class'=>'btn btn-md btn-success','onClick'=>'getdataanggota()']) ?>
</div>

<div id="preview-laporan">
    
</div>

<script>
getdataanggota=()=>{
    const refagen = $("#dynamicmodel-id_ref_agen").val();
//    console.log(refagen);
//    return true
    const tglawal = $("#dynamicmodel-tgl_awal").val();
    const tglakhir = $("#dynamicmodel-tgl_akhir").val();
    $.post({
        
          url :  "<?=Url::to(['preview-laporan-agen-detail'])?>",
          data : {
              refagen : refagen,
              tgl_awal : tglawal,
      tgl_akhir : tglakhir
          },
                  success:function(data){
                      $("#preview-laporan").html(data)
                  }
})
}
</script>