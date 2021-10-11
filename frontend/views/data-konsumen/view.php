<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\DataKonsumen */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Data Konsumens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="data-konsumen-view">

    <div class="row">
        <div class='col-md-4'>
            ini foto profil
        </div>
        <div class='col-md-8'>
            <?php if($model){ ?>
             <p>
        <?= Html::button('Update',  ['class' => 'btn btn-primary showModalButton',
            'value'=> \yii\helpers\Url::to(['update', 'id' => $model->id])]) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'no_acak',
            'nama',
            'jkel',
            'no_telp',
            'email:email',
            'filename',
        ],
    ]) ?>

            <?php }else{
    
            echo Html::a('Create Data Konsumen', ['create'], ['class' => 'btn btn-success']) ;
                    
            }?>
        </div>
    </div>
   
</div>
