<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use kartik\dialog\Dialog;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

  
 
<p>
        <?= Html::button('Tambah Akun Baru',['class' => 'btn btn-success showModalButton',
            'value'=>Url::to( ['create'])]) ?>
    </p>

    <?= GridView::widget([
        'id'=>'tabel-user',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax'=>true,
        'panel'=>[
            'type'=> GridView::TYPE_INFO,
            'heading'=>'Daftar User Akun Agen'
        ],
        'pjax'=>true,
        'columns' => [
            [
              'class'=> 'kartik\grid\CheckboxColumn','width'=>'1%'  
            ],
            ['class' => 'kartik\grid\SerialColumn','width'=>'1%'],

//            'id',
        ['attribute'=>  'no_acak','width'=>'3%'],
 ['attribute'=>  'nik','width'=>'3%'],
//            'role_id',
            ['attribute'=>'id_ref_agen','header'=>'Agen','width'=>'15%',
                'value'=>function($data){
        $refAgen = \backend\models\RefAgen::findOne($data['id_ref_agen']);
        return $refAgen ?  $refAgen['nama_agen'] : '';
                }],
          ['attribute'=>  'username','width'=>'16%'],
            //'auth_key',
          [ 'attribute'=> 'password_string','width'=>'16%'],
            //'password_hash',
            //'password_reset_token',
            //'email:email',
            //'status',
            //'created_at',
            //'updated_at',
            //'verification_token',

            ['class' => 'kartik\grid\ActionColumn','width'=>'10%','template'=>'{update} {loginas}',
                'buttons'=>[
                     'update'=>function($url,$data,$key){
        return Html::button('<span class="fa fa-edit" aria-hidden="true"></span>', ['class' => 'btn btn-warning showModalButton',
            'value'=>Url::to( ['update','id'=>$key])
        ]);
                   },
//                           'loginas' => function($url, $model) {
//         if ($model->status == 0) {
//              return null;
//         }
//         $title = "Login As";
//         $url = Url::to(['loginas', 'token' => $model->auth_key]);
//         $urlLogout = Url::to(['logout-user', 'token' => $model->auth_key]);
//         $options = [
//             'class'=>'btn btn-md btn-default',
//              'title' => $title,
//              'data-method' => 'post',
//         ];
//         $label = "<span class='fa fa-share' arial-hidden='true'></span>";
//         $labelOut =  "<span class='fa fa-star' arial-hidden='true'></span>";
//         return Yii::$app->user->identity->username == $model->username ?
//           Html::a($labelOut, $urlLogout, $options)  :
//            Html::a($label, $url, $options);
//     }
                ]
                ],
        ],
    ]); ?>
<?php 
echo Html::button('Hapus yng di ceklist',['class'=>'btn btn-danger','onClick'=>'hapusall()']);
 echo Dialog::widget([
    'libName' => 'krajeeDialogCust',
   'options' => ['draggable' => true, 'closable' => true], // custom options
 ]);
 
?>

</div>
<script>
   const hapusall=()=>{
        const selection = $('#tabel-user').yiiGridView('getSelectedRows')
        console.log(selection);
 //       krajeeDialogCust.alert('An alert');
      krajeeDialogCust.confirm('Yakin User ini mau dihapus? semua data yang terhubung dengan akun ini akan dihapus permanen', function(out){
          if(out) {
               $.post({
            url : "<?= Url::to(['delete-all'])?>",
            data:{
                id : selection
            }
        })
          }
      });
 
 
      
    }
 </script>