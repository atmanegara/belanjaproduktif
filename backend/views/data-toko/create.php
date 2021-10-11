<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DataToko */

$this->title = 'Create Data Toko';
$this->params['breadcrumbs'][] = ['label' => 'Data Tokos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-toko-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
