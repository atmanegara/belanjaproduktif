<?php 
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\ActiveField;
?>

<?php 
$form = ActiveForm::begin([
    'id' => 'login-form-inline',
    'layout' => ActiveForm::LAYOUT_INLINE,
    'fieldConfig' => ['options' => ['class' => 'form-group mr-2']] // spacing form field groups
])
?>
 <?= $form->field($modelDynamic, 'qty')->label('Jumlah')->textInput(['type'=>'number']) ?>
 <?= Html::submitButton('ADD',['class'=>'btn btn-primary']) ?>
 <?php ActiveForm::end()?>