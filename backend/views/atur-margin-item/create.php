<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AturMarginItem */

$this->title = 'Create Atur Margin Item';
$this->params['breadcrumbs'][] = ['label' => 'Atur Margin Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atur-margin-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
