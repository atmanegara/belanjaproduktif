<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DataKomisi */

$this->title = 'Create Data Komisi';
$this->params['breadcrumbs'][] = ['label' => 'Data Komisis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-komisi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
