<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model backend\models\DataLevel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-level-form">
 <div class="note note-primary m-b-15">
        <div class="note-icon"><i class="fas fa-info"></i></div>
        <div class="note-content">
            <h4><b>Informasi!</b></h4>
            <p>
               Pindah / ganti level akan mempengaruhi komisi anda, pastikan ada sudah benar melakukan tindakan ini, SANGAT BERHATI-HATI
            </p>
        </div>
    </div>
    <?=
 DetailView::widget([
        'model'=>$modelDataAgen,
        'attributes'=>[
            'id_agen',
            'nik','nama_agen',
            'refAgen.nama_agen'
        ]
    ])
?>

    <?php $form = ActiveForm::begin([
        'id'=>'data-level-form',
        'type'=> ActiveForm::TYPE_VERTICAL
    ]); ?>


    <?= $form->field($model, 'ke_id_ref_agen')->dropDownList($modelRefAgen,[
        'prompt'=>'Pilih Agen..'
    ]) ?>


    <?= $form->field($model, 'catatan')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
