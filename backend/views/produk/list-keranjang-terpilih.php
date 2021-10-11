<?php
use yii\bootstrap4\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

?>

<?php 

echo GridView::widget([
    'dataProvider'=>$dataProvider,
    'showPageSummary'=>true,
    'pjax'=>true,
    'columns'=>[
        [
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
        ],    'qty', 
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
                    'template'=>'{batal}',
                    'buttons'=>[
                       
                        'batal'=>function($url,$data,$key){
                            $url = ['batal-keranjang','id'=>$key];
                            return Html::a('Batal', $url, [
                                'class'=>'btn btn-md btn-danger',
                                'data'=>[
                                    'method'=>'post',
                                    'confirm'=>'Yakin dibatalkan?'
                                ]
                            ]);
                        }
                    ]
                ]
            
    ]
]);
echo Html::button('Pilih Metode Pembayaran',['class'=>'btn btn-md btn-warning showModalButton',
    'value'=> Url::to(['pilih-metode-pembayaran-ajax'])
    ])
?>
