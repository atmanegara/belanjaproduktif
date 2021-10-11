<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DataLevel */

$this->title = 'Create Data Level';
$this->params['breadcrumbs'][] = ['label' => 'Data Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-level-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
