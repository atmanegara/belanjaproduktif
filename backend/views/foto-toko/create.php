<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\FotoToko */

$this->title = 'Create Foto Toko';
$this->params['breadcrumbs'][] = ['label' => 'Foto Tokos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="foto-toko-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
