<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\VisiMisiPerusahaan */

$this->title = 'Create Visi Misi Perusahaan';
$this->params['breadcrumbs'][] = ['label' => 'Visi Misi Perusahaans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visi-misi-perusahaan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
