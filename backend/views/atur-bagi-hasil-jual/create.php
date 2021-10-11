<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AturBagiHasilJual */

$this->title = 'Create Atur Bagi Hasil Jual';
$this->params['breadcrumbs'][] = ['label' => 'Atur Bagi Hasil Juals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atur-bagi-hasil-jual-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
