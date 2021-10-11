<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DpPembayaran */

$this->title = 'Create Dp Pembayaran';
$this->params['breadcrumbs'][] = ['label' => 'Dp Pembayarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dp-pembayaran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
