
<h1 class="page-header">Timeline <small>Proses permohonan</small></h1>
<!-- end page-header -->

<!-- begin timeline -->
<ul class="timeline">




    <?php
    foreach ($data as $value) {
        if ($value['status_pengajuan'] >= 0 ) {
            ?>
            <li>
                <!-- begin timeline-time -->
                <div class="timeline-time">
                    <span class="date"><?=
                        $value['status_pengajuan'] > 0 ? $value['tgl_verifikasi_pengajuan'] :
                                $value['tgl_pengajuan']
                        ?></span>
                </div>
                <!-- begin timeline-icon -->
                <div class="timeline-icon">
                    <a href="javascript:;">&nbsp;</a>
                </div>
                <!-- end timeline-icon -->
                <!-- begin timeline-body -->
                <div class="timeline-body">
                    <?php
                    if ($value['status_pengajuan'] == 0) {
                        echo 'Proses Pengajuan Berkas Perizinan';
                    } elseif ($value['status_pengajuan']==1) {
                        echo 'Berkas Perizinan di Terima';
                    } else {
                        echo 'Berkas Ditolak';
                    }
                    ?>
                </div>
                <!-- begin timeline-body -->
            </li>
            <?php
             if($value['status_verifikasi']==0){
     break;
        
    }
          }
          if ($value['status_verifikasi'] >= 0) {
            ?>
            <li>
                <!-- begin timeline-time -->
                <div class="timeline-time">
                    <span class="date"><?= $value['status_verifikasi'] > 0 ? $value['tgl_verifikasi'] : ''; ?></span>
                </div>
                <!-- begin timeline-icon -->
                <div class="timeline-icon">
                    <a href="javascript:;">&nbsp;</a>
                </div>
                <!-- end timeline-icon -->
                <!-- begin timeline-body -->
                <div class="timeline-body">
                    <?php
                    if ($value['status_verifikasi'] == 0) {
                        echo 'Proses Verifikasi Berkas Perizinan';
                    } elseif ($value['status_verifikasi']==1) {
                        echo 'Berkas Perizinan sudah di Verifikasi';
                    } else {
                        echo 'Verifikasi Ditolak';
                    }
                    ?>
                </div>
                <!-- begin timeline-body -->
            </li>
    <?php if($value['status_verifikasi']==0){
     break;
        
    }
    }
    if ($value['status_pengajuan'] == 1 and $value['status_verifikasi'] = 1 and $value['status_selesai']>=0) {
        ?>
            <li>
                <!-- begin timeline-time -->
                <div class="timeline-time">
                    <span class="date"><?= $value['status_selesai'] > 0 ? $value['tgl_selesai'] : '' ?></span>
                </div>
                <!-- begin timeline-icon -->
                <div class="timeline-icon">
                    <a href="javascript:;">&nbsp;</a>
                </div>
                <!-- end timeline-icon -->
                <!-- begin timeline-body -->
                <div class="timeline-body">
                    <?php
                    if ($value['status_selesai'] == 0) {
                        echo 'Proses Penetapan No SK Perizinan';
                    } elseif ($value['status_selesai'] == 1) {
                        echo 'SK Perizinan Sudah di terbitkan';
                    } else {
                        echo 'Di Batalkan';
                    }
                    ?>
                </div>
                <!-- begin timeline-body -->
            </li>
    <?php } ?>
<?php } ?>
</ul>
<!-- end timeline -->