<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DataBagiHasil */

$this->title = 'Create Data Bagi Hasil';
$this->params['breadcrumbs'][] = ['label' => 'Data Bagi Hasils', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-bagi-hasil-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
