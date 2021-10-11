  <!-- BEGIN #checkout-payment -->
        <div class="section-container" id="checkout-payment">
            <!-- BEGIN container -->
            <div class="container">
                <table class="table table-border ">
                    <thead>
                        <tr>
                            <th>NO INVOICE</th>
                            <th>ITEM</th>
                            <th>.:.</th>
                        </tr>
                    </thead>
                    <tbody>
                    

                        <?php foreach ($dataItemSelesai as $value) { ?>
                            
                        <tr>
                            <td>#<?=$value['no_invoice']?></td>
                            <td>
                                <ol><?php 
                                $total=0;
                            $no_invoice = $value['no_invoice'];
                            $detail = frontend\models\QueryModel::getDetailItemNoInvoice($no_invoice);
                            foreach($detail as $itemDetail){ $total += $itemDetail['total'];?>
                                    
                                    <li><?=$itemDetail['nama_item'] .'<br>'.'Rp. '.number_format($itemDetail['harga_jual'],2,',','.') .' X '.$itemDetail['qty'].' = '.'Rp. '.number_format($itemDetail['total'],2,',','.')?></li>
                        
                                            
<?php                            }
                            ?>  </ol>
                              (Total : <?='Rp '.number_format($total,2,',','.')?> )
                            </td>
                            <td>
                                <?= \yii\bootstrap4\Html::a('Detail',['checkout-payment','no_invoice'=>$value['no_invoice']],['class'=>'btn btn-primary'])?>
                            </td>
                        </tr>
<?php                         } ?>
                    </tbody>
                </table>

            </div>
        </div>