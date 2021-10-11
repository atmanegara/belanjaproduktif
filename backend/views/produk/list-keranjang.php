<?php
use yii\bootstrap4\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

?>

<?php 
$form = yii\bootstrap4\ActiveForm::begin([
    'options'=>[
 //   'onsubmit'=>"return submitResult()"
        ]
]);
echo GridView::widget([
    'dataProvider'=>$dataProvider,
    'showPageSummary'=>true,
    'columns'=>[
        [
            'class'=> '\kartik\grid\CheckboxColumn',
            'checkboxOptions' => function($model, $key, $index, $column) {
     return ['checked' => true];
 }
        ],
                 [
                     'width'=>'8.84%;',
                        'attribute' => 'filename',
                        'format' => "raw",
                        'value' => function($data) {
             $dataBarang = \backend\models\DataBarang::find()->where([
                'id'=>$data['id_data_barang']
            ]);
            $filename='';
            if($dataBarang->exists()){
                $filename = $dataBarang->one()->filename;
            }
                            return Html::img(Yii::getAlias('@sourcePathImg') . '/' . $filename, ['width' => '90px', 'height' => '90px']);
                        }
                    ],
        [
            'header'=>'Nama Item',
            'value'=>function($data){
            $dataBarang = \backend\models\DataBarang::find()->where([
                'id'=>$data['id_data_barang']
            ]);
            $namaItem='';
            if($dataBarang->exists()){
                $namaItem = $dataBarang->one()->item_barang;
            }
            return $namaItem;
            }
        ], 
                'qty',
                [
              'format' => 'decimal',
             'pageSummary'=>true,
            'header'=>'Jumlah',
            'value'=>function($data){
        
            return $data['qty']*$data['harga_jual'];
            }
        ],
       [
                    'class'=> '\kartik\grid\ActionColumn','width'=>'20%',
                    'template'=>'{batal} {update}',
                    'buttons'=>[
                         'update'=>function($url,$data,$key){
                          $url = Url::to(['/addcart/edit-item', 'id' => $key]);
                                        return Html::button("<i class='fa fa-edit'></i>", ['class' => 'btn btn-md btn-success showModalButton', 'value' => $url]);
                        },
                        'batal'=>function($url,$data,$key){
                            $url = ['hapus-keranjang','id'=>$key];
                            return Html::a('Hapus', $url, [
                                'class'=>'btn btn-md btn-danger',
                                'data'=>[
                                    'method'=>'post',
                                    'confirm'=>'Yakin item di hapus?'
                                ]
                            ]);
                        }
                    ]
                ]
                  
    ]
]);
echo Html::submitButton('Pilih Barang',['class'=>"btn btn-md btn-warning"]);
$form->end();
?>

<script>
function submitResult() {
   if ( confirm("Apakah Kamu Yakin dengan pilihanmu") == false ) {
      return false ;
   } else {
      return true ;
   }
}
</script>