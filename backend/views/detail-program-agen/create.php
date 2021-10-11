<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DetailProgramAgen */

$this->title = 'Create Detail Program Agen';
$this->params['breadcrumbs'][] = ['label' => 'Detail Program Agens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-program-agen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
