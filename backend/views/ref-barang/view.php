<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\RefBarang */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Barangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ref-barang-view">

  

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           'kode',
            'nama_barang',
             [
                    'label'=>'filename',
                    'format'=>'raw',
                    'value'=>function($data){
                        $filename_path = Yii::getAlias('@sourcePathImg/').$data['filename'];
                        return Html::img($filename_path,['width'=>'90px','height'=>'90px']);
                    }
                ],
        ],
    ]) ?>

</div>
