<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataBarangMasukSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Barang Masuks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-barang-masuk-index">


    <?php echo $this->render('_form', [ 'model'=>$model,
            'refGudang'=>$refGudang,
            'refSuplier'=>$refSuplier   ]); ?>

    <?php \yii\widgets\Pjax::begin(['id'=>"pjax-gudang-masuk"])?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

       //     'id',
         //   'id_ref_barang',
           // 'id_ref_suplier',
            [
              'header'=>'Gudang',
                'value'=>function($data){
                return \backend\models\RefGudang::findOne($data['id_ref_gudang'])->nama_gudang;
                }
            ],
            [
              'header'=>'Item Barang',
                'value'=>function($data){
                return \backend\models\RefBarang::findOne($data['id_ref_barang'])->nama_barang;
                }
            ],
            'qty',
            'harga_satuan',
            [
              'header'=>'Penyalur',
                'value'=>function($data){
                return \backend\models\RefSuplier::findOne($data['id_ref_suplier'])->nama_suplier;
                }
            ],
            //'id_ref_gudang',
            //'tgl_masuk',
            //'tgl_input',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php \yii\widgets\Pjax::end()?>

</div>
