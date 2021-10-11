<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TentangKami */

$this->title = 'Update Tentang Kami: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tentang Kamis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tentang-kami-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
