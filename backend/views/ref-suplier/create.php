<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RefSuplier */

$this->title = 'Create Ref Suplier';
$this->params['breadcrumbs'][] = ['label' => 'Ref Supliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-suplier-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
