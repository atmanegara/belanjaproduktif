<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BerkasAgen */

$this->title = 'Update Berkas Agen: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Berkas Agens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="berkas-agen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
