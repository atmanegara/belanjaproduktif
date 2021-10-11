<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RefProgramAgen */

$this->title = 'Create Ref Program Agen';
$this->params['breadcrumbs'][] = ['label' => 'Ref Program Agens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-program-agen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
