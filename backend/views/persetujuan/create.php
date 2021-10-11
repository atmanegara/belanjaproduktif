<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Persetujuan */

$this->title = 'Create Persetujuan';
$this->params['breadcrumbs'][] = ['label' => 'Persetujuans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="persetujuan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
