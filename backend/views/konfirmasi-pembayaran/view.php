<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use backend\models\RefAgen;

/* @var $this yii\web\View */
/* @var $model backend\models\KonfirmasiPembayaran */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Konfirmasi Pembayarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
 $id_status_pembayaran = $model['id_status_pembayaran'];
?>
<div class="konfirmasi-pembayaran-view">
    
    <p>
        <?= Html::a('Kembali', ['/konfirmasi-pembayaran'], ['class' => "btn btn-warning"]) ?>
    </p>
    <?php
    if($id_status_pembayaran=='2'){
        ?>
    <div class="alert alert-success fade show">Terkonfirmasi</div>
    <?php
    }
    ?>
        <?php
    echo \yii\widgets\DetailView::widget([
        'model' => $modelRegistrasiAgen,
//     'panel'=>[
//         'heading'=>'NIK # ' ,
//         'type'=>DetailView::TYPE_INFO,
//         'headingOptions'=>[
//             'template'=>false
//         ]
//     ],
        'attributes' => [
            'nik',
            'nama', 'alamat', 'nope', 'email',
            [
                'attribute' => "id_ref_agen",
                'value' => function($model) {
                    $agen = RefAgen::find()->where(['id' => $model['id_ref_agen']])->one();
                    return $agen['nama_agen'];
                }
            ]
        ]
    ]);

    echo DetailView::widget([
        'model' => $model,
        'condensed' => true,
        'hover' => true,
        'mode' => DetailView::MODE_VIEW,
        'panel' => [
            'heading' => 'Invoice # ' . $model->no_invoice,
            'type' => DetailView::TYPE_INFO,
            'headingOptions' => [
                'template' => false
            ]
        ],
        'buttons1' => false,
        'attributes' => [
            'no_invoice',
            'nominal',
            ['attribute' => 'tgl_transfer'],
        ]
    ]);
    ?>
    <div class="row row-space-10">
    <div class="col-md-8">
        <div class="panel panel-inverse">
             <div class="panel-heading">
                    .:. Bukti Pembayaran
                </div>
            <div class="panel-body">
                <?=
                Html::img(Yii::getAlias('@sourcePathImg') . '/' . $model->filename, [
                    'width' => '50%', 'height' => '200px'
                        ]
                )
                ?>
            </div>
            <div class="panel-footer">
                <?php
                $url = Url::to(Yii::getAlias('@sourcePathImg/') . $model->filename);
                echo Html::a('Perbesar', $url, [
                    'class' => 'btn btn-md btn-info',
                    'onClick' =>
                    "window.open('" . $url . "',
                         'newwindow',
                         'width=400,height=450,top=200,left=300');
              return false;"
                ]);
                ?>
            </div>
        </div>

    </div>
        <?php
       if($id_status_pembayaran=='1'){
        ?>
        <div class="col-md-4">


            <div class="panel panel-info">
                <div class="panel-heading">
                    .:.Konfirmasi
                </div>
                 <?php
                    $form = \kartik\form\ActiveForm::begin([
                                'id' => 'login-form-inline',
                              ]);
                    ?>
                <div class="panel-body">
                   
                    <?= $form->field($model, 'nominal')->label(false)->hiddenInput(['value' => $model['nominal']]) ?>
                   
                    <?=
                    $form->field($model, 'id_status_pembayaran')->label('Verifikasi Pembayaran')->dropDownList($modelStatusPembayaran, [
                        'prompt' => 'Pilih Konfirmasi..'
                    ])
                    ?>
                     <?=
                    $form->field($model, 'id_status_dp')->label('Status Pembayaran')->dropDownList($modelRefStatusDp, [
                        'prompt' => 'Pilih Status Pembayaran..'
                    ])
                    ?>
                </div>
                <div class="panel-footer">
                                        <?= Html::submitButton('Konfirmasi', ['class' => 'btn btn-md btn-primary']) ?>
                    <?php \kartik\form\ActiveForm::end() ?>

                </div>
            </div>
        </div>
        <?php  }?>
    </div>
</div>