<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\KonfirmasiPencairan */

$this->title = 'Create Konfirmasi Pencairan';
$this->params['breadcrumbs'][] = ['label' => 'Konfirmasi Pencairans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="konfirmasi-pencairan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
