<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DataItemBarangAgen */

$this->title = 'Create Data Item Barang Agen';
$this->params['breadcrumbs'][] = ['label' => 'Data Item Barang Agens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-item-barang-agen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
