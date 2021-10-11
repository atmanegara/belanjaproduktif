<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Addcart */

$this->title = 'Create Addcart';
$this->params['breadcrumbs'][] = ['label' => 'Addcarts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="addcart-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
