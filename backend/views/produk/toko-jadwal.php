<?php
use yii\helpers\Html;
?>

    
    <div class="note note-danger m-b-15">
								<h4><b>Informasi!</b></h4>
								<p>
									TOKO MASIH TUTUP, SILAHKAN CEK JADWAL TOKO DIBAWAH INI</p>
							</div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            JADWAL TOKO
        </div>
        <div class="panel-body">
              <table class="table table-bordered ">
    <thead>
        <tr>
            <th>Hari</th>
            <th>Jam</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
       <?php foreach($modelJadwalToko  as $val){?>
        <tr>
            <td><?=Yii::$app->setting->hari($val['hari']);?></td>
            <td><?=$val['jam_awal'].' s/d '.$val['jam_akhir'] ?></td>
            <td><?=$val['ket']?></td>
        </tr>
       <?php } ?>
    </tbody>
</table>
        </div>
    </div>
  
