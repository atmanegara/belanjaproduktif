<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\KonfirmasiPembayaran */

$this->title = 'Create Konfirmasi Pembayaran';
$this->params['breadcrumbs'][] = ['label' => 'Konfirmasi Pembayarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="konfirmasi-pembayaran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
