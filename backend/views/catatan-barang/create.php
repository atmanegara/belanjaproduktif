<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CatatanBarang */

$this->title = 'Create Catatan Barang';
$this->params['breadcrumbs'][] = ['label' => 'Catatan Barangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catatan-barang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
