<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BerkasAgen */

$this->title = 'Create Berkas Agen';
$this->params['breadcrumbs'][] = ['label' => 'Berkas Agens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="berkas-agen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
