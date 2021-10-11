<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Kecamatan */

$this->title = 'Update Kecamatan: ' . $model->id_kec;
$this->params['breadcrumbs'][] = ['label' => 'Kecamatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_kec, 'url' => ['view', 'id' => $model->id_kec]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kecamatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
