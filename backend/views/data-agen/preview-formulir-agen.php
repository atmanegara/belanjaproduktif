<?php

use yii\bootstrap4\Html;
?>
<div class="panel panel-primary">
     <p>
           <?php
          if(in_array(Yii::$app->user->identity->role_id, ['1'])){
           echo Html::a('<i class="fa fa-backward"></i> Kembali', ['index'], ['class' => 'btn btn-default']); 
             
          }else{
           echo Html::a('<i class="fa fa-backward"></i> Kembali', ['index-agen'], ['class' => 'btn btn-default']);
          }
          ?>
     
    </p>
    <div class="panel-body">
        <?php
echo $this->render('formulir-agen',[
    'modelDataAgen' => $modelDataAgen,
                    'modelDataWaris' => $modelDataWaris,
                    'modelFotoProfil' => $modelFotoProfil,
                    'modelTentangKami' => $modelTentangKami,
            'modelDataPembayaran'=>$modelDataPembayaran,   'modelRekening'=>$modelRekening,
         
                    'no_acak' => $no_acak,
            'modelSyaratWajibHak'=>$modelSyaratWajibHak
])
?>
    </div>
    <div class="panel-footer">
 <p>
                <?= Html::a('PDF',['print-formulir-agen','no_acak'=>$no_acak,'export'=>'pdf'] , ['class' => "btn btn-md btn-info"]) ?>
                
<?= Html::a('Excel', ['print-formulir-agen','no_acak'=>$no_acak,'export'=>'xls'], ['class' => "btn btn-md btn-warning"]) ?>
            </p>

    </div>
</div>
