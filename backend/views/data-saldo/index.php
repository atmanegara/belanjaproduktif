<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataSaldoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Saldos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-saldo-index">
    <h1 class="page-header">Halaman Daftar Saldo</h1>
    <div class="note note-primary m-b-15">
        <div class="note-icon"><i class="fas fa-info"></i></div>
        <div class="note-content">
            <h4><b>Informasi!</b></h4>
            <p>
                Halaman Daftar Saldo
            </p>
        </div>
    </div>

    <div class="row">
        <!-- begin col-3 -->
        <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-red">
                <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                <div class="stats-info">
                    <h4>DAFTAR PENGAJUAN SALDO (BELUM VERIFIKASI)</h4>
                    <p><?php echo $totalBelumVerifikasi ?></p>	
                </div>
                <div class="stats-link">
                    <a href="<?php echo Url::to(['/konfirmasi-topup/detail']) ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
         <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-success">
                <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                <div class="stats-info">
                    <h4>DAFTAR SALDO TERVERIFIKASI</h4>
                    <p><?php echo $totalVerifikasi ?></p>	
                </div>
                <div class="stats-link">
                    <a href="<?php echo Url::to(['/konfirmasi-topup/detail-verifikasi']) ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- begin col-3 -->
      
        <!-- end col-3 -->
    </div>

    <p>
        <?php if (in_array(Yii::$app->user->identity->role_id, ['2', '3', '4'])) {
       echo Html::button('Top Up', ['class' => 'btn btn-lg btn-success showModalButton',
            'value' => Url::to(['/konfirmasi-topup/create'])
        ]);
        }else{
           echo Html::button('Top Up', ['class' => 'btn btn-lg btn-success showModalButton',
            'value' => Url::to(['/konfirmasi-topup/create-saldo'])
        ]); 
        }
        ?>
        <?php if (in_array(Yii::$app->user->identity->role_id, ['2', '3', '4'])) { ?>
            <?=
            Html::button('Cairkan', ['class' => 'btn btn-lg btn-primary showModalButton',
                'value' => \yii\helpers\Url::to(['transfer-kebank', 'no_acak' => $no_acak])
            ])
            ?>
        <?= Html::a('Riwayat Saldo', \yii\helpers\Url::to(['/transaksi-saldo', 'no_acak' => $no_acak]), ['class' => 'btn btn-lg btn-warning ']) ?>
    <?php } ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [
            'type' => GridView::TYPE_INFO
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            //     'id',
            'no_acak',
            [
                'header' => 'Data Agen',
                'attribute' => 'no_acak',
                'format' => 'raw',
                'value' => function($data) {
                    $dataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $data['no_acak']]);
                            if($dataAgen->exists()){
                                $dataAgen = $dataAgen->one();
                                $dt_html = $dataAgen->refAgen->nama_agen . '<br> ' . $dataAgen->nik . '<br>' . $dataAgen->nama_agen;
                            }else{
                                $dt_html = "<span class='label label-info'>Agen tidak ditemukan</span>";
                            }
                    return $dt_html;
                }
            ],
         [
             'header'=>'Saldo',
             'attribute'=>'nominal_awal',
             'value'=>function($data){
                return number_format($data['nominal_awal'],0,',','.');
             }
         ]
//            ['class' => 'kartik\grid\ActionColumn',
//                'template'=>'{update}',
//                'buttons'=>[
//                    'update'=>function($data,$url,$key){
//                        return \yii\bootstrap4\Html::button('Update',[
//                            'class'=>'btn btn-info showModalButton',
//                            'value'=> Url::to(['/data-saldo/update','id'=>$key])
//                        ]);
//                    },
////                            'view'=>function($data,$url,$key){
////                        return \yii\bootstrap4\Html::a('View',Url::to(['/data-saldo/view','id'=>$key]),[
////                            'class'=>'btn btn-warning'
////                        ]);
////                            }
//                ]
//                ],
        ],
    ]);
    ?>


</div>
