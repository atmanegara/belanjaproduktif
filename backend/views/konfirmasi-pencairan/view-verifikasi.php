<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\form\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\models\KonfirmasiPencairan */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Konfirmasi Pencairans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="konfirmasi-pencairan-view">


 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
    //        'id',
        //    'no_acak',
                    'no_invoice',
           [
             'label'=>'Data Agen',
               'value'=>function($data){
        $dataAgen = \backend\models\DataAgen::findOne(['no_acak'=>$data['no_acak']]);      
        return $dataAgen['nama_agen'] .' / '.$dataAgen['id_agen'];
               }
           ],
                 [
                       'label'=>'Metode Transfer',
                       'value'=>function($data){
                       $metodeTransfer = backend\models\MetodeTransfer::findOne($data['id_metode_transfer']);
                       return $metodeTransfer['nm_metode_transfer'];
                       }
                   ],
          //  'from_bank',
            'tgl_ajukan',
        //    'id_data_agen',
                            [
             'label'=>'Ke Agen',
               'value'=>function($data){
        $dataAgen = \backend\models\DataAgen::findOne(['id'=>$data['id_data_agen']]);      
        return $dataAgen['nama_agen'] .' / '.$dataAgen['id_agen'];
               }
           ],
            'nominal',
        //    'id_status_pembayaran',
       //     'jamtgl',
        ],
    ]) ?>
   <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'nominal')->label(false)->hiddenInput();  ?>
  <?= $form->field($model, 'no_acak')->label(false)->hiddenInput(); ?>
  <?= $form->field($model, 'id_status_pembayaran')->dropDownList($statusPembayaran,[
        'prompt'=>'Pilih Salah Satu..'
    ]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
