<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\VisiMisiPerusahaan */

$this->title = 'Update Visi Misi Perusahaan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Visi Misi Perusahaans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="visi-misi-perusahaan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
