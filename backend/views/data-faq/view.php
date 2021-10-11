<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\DataFaq */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Data Faqs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="data-faq-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pertanyaan:ntext',
            'jawaban:ntext',
        ],
    ]) ?>

</div>
