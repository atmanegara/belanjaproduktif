<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PendapatanRegistrasi */

$this->title = 'Create Pendapatan Registrasi';
$this->params['breadcrumbs'][] = ['label' => 'Pendapatan Registrasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pendapatan-registrasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
