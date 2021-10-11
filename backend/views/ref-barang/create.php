<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RefBarang */

$this->title = 'Create Ref Barang';
$this->params['breadcrumbs'][] = ['label' => 'Ref Barangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-barang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
