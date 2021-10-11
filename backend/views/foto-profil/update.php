<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\FotoProfil */

$this->title = 'Update Foto Profil: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Foto Profils', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="foto-profil-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
