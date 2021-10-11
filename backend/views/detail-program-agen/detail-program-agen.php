<?php
use kartik\grid\GridView;
?>

<?= GridView::widget([
    'dataProvider'=>$dataProvider,
    'columns'=>[
        'tgl_awal','tgl_akhir','ket'
    ]
]) ?>