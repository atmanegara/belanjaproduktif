<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RefSatuanBarang */

$this->title = 'Create Ref Satuan Barang';
$this->params['breadcrumbs'][] = ['label' => 'Ref Satuan Barangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-satuan-barang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
