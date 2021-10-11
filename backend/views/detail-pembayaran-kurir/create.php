<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DetailPembayaranKurir */

$this->title = 'Create Detail Pembayaran Kurir';
$this->params['breadcrumbs'][] = ['label' => 'Detail Pembayaran Kurirs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-pembayaran-kurir-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
