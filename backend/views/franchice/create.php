<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Franchice */

$this->title = 'Create Franchice';
$this->params['breadcrumbs'][] = ['label' => 'Franchices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="franchice-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
