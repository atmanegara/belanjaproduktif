<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
$itemsRole = yii\helpers\ArrayHelper::map($itemsRole, 'id', 'nama_role');
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
        'type'=> ActiveForm::TYPE_HORIZONTAL
    ]); ?>

    <?= $form->field($model,'username')->label('Username')->textInput(); ?>
    <?= $form->field($model,'password_string')->label('Password Baru')->textInput(); ?>
    <?= $form->field($model,'role_id')->label('Role')->dropDownList($itemsRole,[
        'prompt'=>'Pilih Role....'
    ])?>
    <?= $form->field($model, 'status')->dropDownList([
        '10'=>'Aktif',
        '9'=>'Non Aktif'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
