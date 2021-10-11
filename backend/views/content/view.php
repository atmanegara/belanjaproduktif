<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Content */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="content-view">

   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'judul',
            'isi_content:ntext',
             [
             'label'=>'Jenis yang ditampilkan',
             'value'=>function($data){
        return \backend\models\FileJenis::findOne($data['id_jenis_file'])->nama_jenis;
             }
         ],
           [
             'label'=>'File ',
               'format'=>'raw',
               'value'=>function($model){
              $url = Url::to(Yii::getAlias('@sourcePathImg/') . $model['filename']);
                $htmlButton=Html::a('Perbesar', $url, [
                    'class' => 'btn btn-md btn-info',
                    'onClick' =>
                    "window.open('" . $url . "',
                         'newwindow',
                         'width=400,height=450,top=200,left=300');
              return false;"
                ]);
             return Html::img(Yii::getAlias('@sourcePathImg') . '/' . $model['filename'], ['width' => '90px', 'height' => '90px']).' '.$htmlButton;
               }
           ],
            'aktf',
        ],
    ]) ?>

</div>
