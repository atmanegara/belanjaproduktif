<?php

use kartik\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap4\Html;
use kartik\dialog\Dialog;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataBarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Barangs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-barang-index">

    <!-- begin row -->

    <!-- end row -->
    <!-- begin row -->


    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?php
    echo GridView::widget([
        'id' => 'tabel-agen',
        'dataProvider' => $dataProvider,
        'pjax' => true,
        'filterModel' => $searchModel,
        'panel' => [
            'heading' => 'Daftar Item di Agen',
            'type' => kartik\grid\GridView::TYPE_INFO,
            'after' => Html::button('Hapus Yang di ceklist', ['class' => "btn btn-md btn-danger", 'onClick' => 'hapusall()']),
            'footer' => ''
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            ['class' => '\kartik\grid\CheckboxColumn'],
            //     'id',
            'bykagen',
            'kode_barcode',
            'item_barang',
            //  'id_ref_satuan_barang',
            ['class' => 'kartik\grid\ActionColumn', 'template' => '{list}',
                'buttons' => [
                    'list' => function($url, $data) {
                        $url = Url::to(['list-item-agen', 'id_ref_barang' => $data['id_ref_barang']]);
                        return Html::button("<i class='fa fa-list'></i> Agen", [
                            'class' => 'btn btn-md btn-info showModalButton',
                            'value' => $url
                        ]);
                    }
                ]],
        ],
    ]);
    ?>


</div>
<?=
Dialog::widget([
    'libName' => 'krajeeDialog',
    'options' => [], // default options
])
?>
<script>
    
    hapusall = () => {
    var keys = $('#tabel-agen').yiiGridView('getSelectedRows');
            if (keys == '') {
    krajeeDialog.alert('Tidak ada data yang dipilih !');
            return false;
    }
    krajeeDialog.confirm('Yakin Item ini mau dihapus? data tidak bisa dikembalikan', function(out){
    if (out) {
    $.post({
    url : "<?= Url::to(['delete-all']) ?>",
            data : {
            selection : keys
            },
            success:function(data){
            if (data['message'] == true) {
            $.pjax.reload('#pjax-tabel-agen');
            }
//                        } else {
//                            krajeeDialog.alert('Check Data');
//                        }
            }
    })
            }
    })
    }
</script>