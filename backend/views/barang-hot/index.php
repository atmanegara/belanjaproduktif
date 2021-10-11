<?php
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap4\Html;


?>


<?php
if($tombolDisable){
    $url='#';
}else{
    $url=Url::to(['create']);
}
echo Html::a('Tambah Baru',$url, [
    'class'=>'btn btn-primary',
])
?>

<?=
        
GridView::widget([
    'id'=>'data-barang-depan',
    'dataProvider'=>$dataProvider,
    'columns'=>[
        [
          'class'=> '\kartik\grid\CheckboxColumn',
//            'checkboxOptions'=>[
//                'onChange'=>'calculateNetto()'
//            ]
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
            $key = $data['id_hot']; 
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
<script>

function calculateNetto() {
    var keys = $('#data-barang-depan').yiiGridView('getSelectedRows');
  
    
   if(keys.length>6){
       alert('Batas Max 6 untuk ditampilkan di halaman depan web, terima kasih')
       
return false;
   }
          $("#dataitembarangagen-id_ref_barang").val(keys);
}
</script>