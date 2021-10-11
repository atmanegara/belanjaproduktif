<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DataAgenDetail */

$this->title = 'Create Data Agen Detail';
$this->params['breadcrumbs'][] = ['label' => 'Data Agen Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-agen-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
