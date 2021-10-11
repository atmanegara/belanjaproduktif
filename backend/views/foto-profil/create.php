<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\FotoProfil */

$this->title = 'Create Foto Profil';
$this->params['breadcrumbs'][] = ['label' => 'Foto Profils', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="foto-profil-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
