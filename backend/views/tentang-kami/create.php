<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TentangKami */

$this->title = 'Create Tentang Kami';
$this->params['breadcrumbs'][] = ['label' => 'Tentang Kamis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tentang-kami-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
