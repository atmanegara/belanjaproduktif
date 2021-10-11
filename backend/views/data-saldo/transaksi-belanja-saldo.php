<?php

use kartik\grid\GridView;
use yii\bootstrap4\Html;
use yii\helpers\Url;
?>


    <p>
           <?= Html::a('<i class="fa fa-backward"></i> Kembali', ['index-agen'], ['class' => 'btn btn-default']) ?>
     
    </p>
    
<?=
GridView::widget([
    'panel'=>[
        'type'=> \kartik\grid\GridView::TYPE_INFO,
        'heading'=>'Daftar Riwayat Belanja'
    ],
    'dataProvider'=>$dataProvider,
    'columns'=>[
        'no_invoice',
        'tgl_transaksi',
        [
            'attribute'=>'total_jual',
            'value'=>function($data){
    return number_format($data['total_jual'],0,',','.');
            }
        ],
                [
                    'class'=> 'kartik\grid\ActionColumn','template'=>'{detail}',
                    'buttons'=>[
                        'detail'=>function($url,$data){
                            return Html::button('Detail',['class'=>"btn btn-warning showModalButton",
                                'value'=>Url::to(['/belanja/detail-belanja-saldo','no_invoice'=>$data['no_invoice']])
                                ]);
                        }
                    ]
                ]
    ]
])
?>
