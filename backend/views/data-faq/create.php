<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DataFaq */

$this->title = 'Create Data Faq';
$this->params['breadcrumbs'][] = ['label' => 'Data Faqs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-faq-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
