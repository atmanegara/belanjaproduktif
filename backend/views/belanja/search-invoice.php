<?php 
$no_invoicelama='';
foreach ($modelHistoryBelanja as $val){ ?>
<ul class="timeline">
    <?php
    if($val['no_invoice']!=$no_invoicelama){
    ?>
						<li>
			       <div class="timeline-time">
                                                                      <?='#'. $val['no_invoice'] ?>
									<span class="date"><?= $val['tgl_transaksi'] ?></span>
								</div>
			        <div class="timeline-icon">
			          
			        </div>
			        <!-- end timeline-icon -->
			        <!-- begin timeline-body -->
			        <div class="timeline-body">
                                    <p>
                                        Barang dipesan
                                    </p> 
                                    Nama Kurir =  <?=
            $val['nama_kurir']?>
			        </div>
			        <!-- begin timeline-body -->
			    </li>
    <?php } ?>
                            <li>
								<!-- begin timeline-time -->
								<div class="timeline-time">
                                                                    <?='#'. $val['no_invoice'] ?>
									<span class="date"><?= $val['tgljam'] ?></span>
								</div>
								<!-- end timeline-time -->
								<!-- begin timeline-icon -->
								<div class="timeline-icon">
									<a href="javascript:;">&nbsp;</a>
								</div>
								<!-- end timeline-icon -->
								<!-- begin timeline-body -->
								<div class="timeline-body">
									<div class="timeline-content">
										<p>
                                                                                    <?php
                                                                                    if ($val['status_belanja']=='0' or is_null($val['status_belanja'])) {
                                                                                        echo 'Sedang dikemas';
}else{
  echo 'Sudah diterima';  
}
?>
										</p>
									</div>
								
								</div>
								<!-- end timeline-body -->
							</li>
<?php 
$no_invoicelama=$val['no_invoice'];

} ?>
						</ul>