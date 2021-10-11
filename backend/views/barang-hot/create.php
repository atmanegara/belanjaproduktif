<?php
use kartik\form\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
?>


<?php
$form = ActiveForm::begin();
?>
<?=
        
GridView::widget([
    'id'=>'data-barang-depan',
    'dataProvider'=>$dataProvider,
    'columns'=>[
        [
          'class'=> '\kartik\grid\CheckboxColumn',
            'checkboxOptions'=>[
                'onChange'=>'calculateNetto()'
            ]
        ],
        [
            'header'=>'Foto',
            'format'=>'raw',
            'value'=>function($data){
            return Html::img(Yii::getAlias('@sourcePathImg/').$data['filename'],['style'=>'width:60%;height:60%']);
            }
        ],
          'item_barang',
                'harga_satuan','harga_jual',
                [
                    'class'=> '\kartik\grid\ActionColumn',
                    'template'=>'{delete}{update}',
                    'buttons'=>[
                        'delete'=>function($url,$data,$key){
                            return Html::a('Delete', $url, [
                                'data'=>[
                                    'confirm'=>'Yakin dihapus?',
                                    'method'=>'GET'
                                ]
                            ]);
                        },
                                'update'=>function($url,$data,$key){
                                    return Html::button('Ganti No. Urutan',[
                                        'value'=>Url::to(['update','id'=>$key]),
                                        'class'=>'btn btn-warning'
                                    ]);
                                }
                    ]
                ]
    ]
])
        ?>
<div class="form-group">
    <?=$form->field($model, 'id_ref_barang')->textInput()?>
    <?=Html::submitButton('Simpan',['class'=>"btn btn-md btn-primary"])?>
</div>
<?php ActiveForm::end();?>
<script>

function calculateNetto() {
    var keys = $('#data-barang-depan').yiiGridView('getSelectedRows');
  
    
   if(keys.length>6){
       alert('Batas Max 6 untuk ditampilkan di halaman depan web, terima kasih')
       
return false;
   }
          $("#baranghot-id_ref_barang").val(keys);
}
</script>