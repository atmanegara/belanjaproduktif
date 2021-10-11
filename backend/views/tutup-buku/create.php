<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TutupBuku */

$this->title = 'Create Tutup Buku';
$this->params['breadcrumbs'][] = ['label' => 'Tutup Bukus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tutup-buku-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
