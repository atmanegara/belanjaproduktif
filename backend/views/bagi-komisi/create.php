<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RiwayatBagiKomisi */

$this->title = 'Create Riwayat Bagi Komisi';
$this->params['breadcrumbs'][] = ['label' => 'Riwayat Bagi Komisis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="riwayat-bagi-komisi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
