<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\KonfirmasiTopup */

$this->title = 'Create Konfirmasi Topup';
$this->params['breadcrumbs'][] = ['label' => 'Konfirmasi Topups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="konfirmasi-topup-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
