<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AlamatKonsumen */

$this->title = 'Create Alamat Konsumen';
$this->params['breadcrumbs'][] = ['label' => 'Alamat Konsumens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alamat-konsumen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
