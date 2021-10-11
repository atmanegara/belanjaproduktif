<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DetailAbout */

$this->title = 'Update Detail About: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Detail Abouts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="detail-about-update">

  
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
