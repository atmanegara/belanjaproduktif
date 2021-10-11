<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TransaksiKomisi */

$this->title = 'Create Transaksi Komisi';
$this->params['breadcrumbs'][] = ['label' => 'Transaksi Komisis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaksi-komisi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
