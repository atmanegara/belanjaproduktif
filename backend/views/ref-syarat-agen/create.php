<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RefSyaratAgen */

$this->title = 'Create Ref Syarat Agen';
$this->params['breadcrumbs'][] = ['label' => 'Ref Syarat Agens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-syarat-agen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
