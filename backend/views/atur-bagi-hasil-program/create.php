<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AturBagiHasilProgram */

$this->title = 'Create Atur Bagi Hasil Program';
$this->params['breadcrumbs'][] = ['label' => 'Atur Bagi Hasil Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atur-bagi-hasil-program-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
