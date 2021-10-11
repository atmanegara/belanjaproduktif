<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Profils';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profil-index">

  <p>
        <?= Html::button('Tambah baru',['class' => 'btn btn-success showModalButton',
            'value'=>Url::to( ['create'])]) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

       //     'id',
        //    'id_user',
            'foto_user',
            'nama_lengkap',
            'alamat:ntext',
            'no_telp',
            //'email:email',
            //'no_identitas',

            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>


</div>
