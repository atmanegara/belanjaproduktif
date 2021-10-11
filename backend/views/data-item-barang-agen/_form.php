<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $model backend\models\DataItemBarangAgen */
/* @var $form yii\widgets\ActiveForm */
$batas=1;
?>

<div class="data-item-barang-agen-form">

    <?php $form = ActiveForm::begin([
        'id'=>'data-item-barang-agen-form',
        
    ]); ?>
<?=
GridView::widget([
    'id'=>'table-item-barang',
    'dataProvider'=>$dataProvider,
    'columns'=>[
        [
            'class'=> '\kartik\grid\CheckboxColumn',
            'checkboxOptions'=>[
                'onChange'=>'calculateNetto()'
            ]
        ],
        
     [
                    'attribute'=>'filename',
                    'format'=>'raw','width'=>'2%',
                    'value'=>function($data){
                        $filename_path = Yii::getAlias('@sourcePathImg/').$data['filename'];
                        return Html::img($filename_path,['width'=>'90px','height'=>'90px']);
                    }
                ],
     //       ['attribute'=>'kode','width'=>'10%'],
            ['attribute'=>'nama_barang','width'=>'15%'],
                        [
                            'header'=>'Harga Jual',
                            'attribute'=>'id',
                            'value'=>function($data){
                                $stok_barang= backend\models\StokBarang::find()->where(['id_data_barang'=>$data['id']])->one();
                                return $stok_barang['harga_jual'];
                            }
                        ]
    ]
])
    ?>

<?= $form->field($model,'id_ref_barang')->label(false)->hiddenInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    function calculateNetto() {
    var keys = $('#table-item-barang').yiiGridView('getSelectedRows');
    $.post({
        url : "<?= yii\helpers\Url::to(['cek-item-agen']) ?>",
        data : {
            id_data_barang : keys
        },
                success:function(html){
        console.log(html);          
        if(html=='true'){
                    alert('Barang ini sudah ada pemiliknya');    
                }
            }
    });
    
   if(keys.length><?=$batas ?>){
       alert('Batas Max 1, jika ingin lebih, silahkan hubungi pihak admin BP. terima kasih')
       
return false;
   }
          $("#dataitembarangagen-id_ref_barang").val(keys);
}
    </script>