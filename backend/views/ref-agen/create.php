<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RefAgen */

$this->title = 'Create Ref Agen';
$this->params['breadcrumbs'][] = ['label' => 'Ref Agens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-agen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
