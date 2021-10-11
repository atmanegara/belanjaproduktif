<?php
use kartik\grid\GridView;

?>
<div class="col-md-12">
    <?=GridView::widget([
    'dataProvider'=>$dataProvider,
    'columns'=>[
        'no_invoice',
        ['header'=>'status',
            'value'=>function($data){
        return backend\models\StatusPembayaran::findOne($data['id_status_pembayaran'])->status_pembayaran;
            }
            ],
                    ['class'=> '\kartik\grid\ActionColumn','template'=>'{view}',
                        'buttons'=>[
                            'view'=>function($url,$data){
                                $url= yii\helpers\Url::to(['konfirmasi-payment','no_invoice'=>$data['no_invoice']]);
                                return yii\bootstrap4\Html::a('View', $url,['class'=>'btn btn-warning']);
                            }
                        ]
                        ]
    ]
])?>
</div>

