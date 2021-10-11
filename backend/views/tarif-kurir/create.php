<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TarifKurir */

$this->title = 'Create Tarif Kurir';
$this->params['breadcrumbs'][] = ['label' => 'Tarif Kurirs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tarif-kurir-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
