<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RegistrasiAgen */

$this->title = 'Update Registrasi Agen: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Registrasi Agens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="registrasi-agen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
