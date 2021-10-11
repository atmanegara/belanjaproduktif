<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserProfil */

$this->title = 'Create User Profil';
$this->params['breadcrumbs'][] = ['label' => 'User Profils', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profil-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
