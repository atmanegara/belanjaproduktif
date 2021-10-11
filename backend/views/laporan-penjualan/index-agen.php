<?php
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\bootstrap4\Html;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?=
GridView::widget([
    'dataProvider'=>$dataProvider,
     'panel'=>[
            'type'=> GridView::TYPE_INFO,
            'heading'=>'Daftar Penjualan'
        ],
    'columns'=>[
        [
            'width'=>'3%',
            'format'=>'raw',
            'header'=>'Agen',
            'value'=>function($data){
             $dataAgen = (new yii\db\Query())
                     ->select('b.*')->from('data_agen a')
                     ->leftJoin('data_toko b','a.id=b.id_data_agen')
                     ->where(['a.no_acak'=>$data['no_acak_user']])->one();
             return $dataAgen['nama_toko'];
            }
        ],
               
        [
              'width'=>'3%',
            'format'=>'raw',
            'header'=>'Tanggal Lapor',
           'attribute'=>'tgl_lapor',
        ],
                 [
              'width'=>'3%',
            'format'=>'raw',
            'header'=>'Bulan / Tahun',
            'value'=>function($data){
                return $data['bulan_posting'].' / '.$data['tahun_posting'];
            }
        ],
    [
          'width'=>'30%',
            'class'=> '\kartik\grid\ActionColumn',
            'template'=>'{preview} {bagihasil}',
            'buttons'=>[
                'preview'=>function($url,$data,$key){
    $url = Url::to(['preview-lap-penjualan-agen','no_acak'=>$data['no_acak']]);
                    return Html::a('Lap. Penjualan Agen', $url,['class'=>'btn btn-md btn-warning']);
                },
                         'bagihasil'=>function($url,$data,$key){
                         $no_acak = $data['no_acak'];
                         $url = ['/data-bagi-hasil/preview-lap-bagi-hasil','no_acak'=>$data['no_acak']];
                         return Html::a('Lap. Bagi Hasil',$url,['class'=>'btn btn-md btn-info']);
                         }
            ]
        ]
    ]
])
?>

