<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DataAgenWaris */

$this->title = 'Create Data Agen Waris';
$this->params['breadcrumbs'][] = ['label' => 'Data Agen Waris', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-agen-waris-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
