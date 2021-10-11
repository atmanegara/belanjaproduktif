<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DataAgen */

$this->title = 'Create Data Agen';
$this->params['breadcrumbs'][] = ['label' => 'Data Agens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-agen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
