<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ProgramAgen */

$this->title = 'Create Program Agen';
$this->params['breadcrumbs'][] = ['label' => 'Program Agens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-agen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
