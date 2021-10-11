<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AturBagiHasilFranchise */

$this->title = 'Create Atur Bagi Hasil Franchise';
$this->params['breadcrumbs'][] = ['label' => 'Atur Bagi Hasil Franchises', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atur-bagi-hasil-franchise-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
