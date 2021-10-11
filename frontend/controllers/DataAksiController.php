<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\controllers;
use Yii;
use backend\models\TransaksiSaldo;
use yii\web\Controller;
use backend\models\PembayaranJualbeli;
use backend\models\DataSaldo;

/**
 * Description of DataAksiController
 *
 * @author Administrator
 */
class DataAksiController extends Controller{
    //put your code here
    
public function actionSimpan(){
    
        

        if (Yii::$app->request->post()) {
            $no_invoice =Yii::$app->request->post('no_invoice');
            $no_acak =Yii::$app->request->post('no_acak');
            $nominal_bayar =Yii::$app->request->post('nominal');
    //        $model = $this->findModel(['no_invoice'=>$no_invoice]);
           $model = PembayaranJualbeli::findOne(['no_invoice' => $no_invoice]);
        
                $modelTransaksiSaldo = new TransaksiSaldo();
                $modelTransaksiSaldo->no_acak = $no_acak;
                $modelTransaksiSaldo->no_invoice =$no_invoice;
                 $modelTransaksiSaldo->nominal_keluar = $nominal_bayar;
                $modelTransaksiSaldo->nominal_sisa = DataSaldo::nominaldulu($no_acak)-$nominal_bayar;
                $modelTransaksiSaldo->id_ket_saldo=3;  //melakukan pembayaran untuk belanja jualbeli  
                
                $modelTransaksiSaldo->tgl_transaksi = date('Y-m-d');
                $modelTransaksiSaldo->id_metode_transfer = 2;
                $modelTransaksiSaldo->id_ref_bank =0;
                $modelTransaksiSaldo->save(false);
                
                $dataSaldocek = DataSaldo::find()->where(['no_acak'=>$no_acak]);
                if($dataSaldocek->exists()){
                    $modelDataSaldo = $dataSaldocek->one();
                }else{
                $modelDataSaldo = new DataSaldo();
                }
             //   return var_dump($model['no_acak']);
                $modelDataSaldo->no_acak = $no_acak;
                $modelDataSaldo->tgl_masuk = date('Y-m-d');
               
                $modelDataSaldo->nominal_awal = DataSaldo::nominaldulu($no_acak)-$nominal_bayar;
                      
              
                $modelDataSaldo->save(false);
             
                Yii::$app->session->setFlash('success','Sukses');
          
           
         
            return $this->redirect(['/produk/view','no_invoice'=>$no_invoice]);
        }
        
       
}
 public function actionSimpanKetoko(){
            $no_invoice = Yii::$app->request->post('no_invoice');
            $no_acak = Yii::$app->request->post('no_acak');
            $nominal = Yii::$app->request->post('nominal');
            $kd_booking = \backend\models\QueryModel::noacak();
            //cek di checkout
            $checkOutModel = \backend\models\CheckoutItem::find()->where(['no_invoice'=>$no_invoice])->all();
            foreach ($checkOutModel as $value) {
                $stokbarangModel = \backend\models\StokBarang::find()->where(['id_data_barang'=>$value['id_data_barang']])->one();
               $detailPembayaran = \backend\models\DetailPembayaran::find()->where(['no_invoice'=>$no_invoice])->one();
                $model = new \backend\models\BookingBarang();
                $model->kd_booking = $kd_booking;
                $model->isNewRecord=true;
                $model->id=null;
                $model->id_stok_barang = $stokbarangModel['id'];
                $model->qty_keluar = $value['qty'];
                $model->no_invoice = $no_invoice;
                $model->no_acak=$no_acak;
                $model->status_booking='1'; //Ya booking
                $model->tgl_batas_book = date('Y-m-d');
                $model->jam_batas_book = $detailPembayaran['jam_dikirim'];    
                $model->save(false);
                
            }
             Yii::$app->session->setFlash('success','Item barang sudah di booking');
           return $this->redirect(['lampiran-toko',
               'no_invoice'=>$no_invoice,
               'kd_booking'=>$kd_booking
           ]);
        }
        public function actionLampiranToko($no_invoice,$kd_booking){
            $checkOutModel = \backend\models\CheckoutItem::find()->where(['no_invoice'=>$no_invoice])->all();
          $modelBooking = \backend\models\BookingBarang::find()->where(['kd_booking'=>$kd_booking])->one();
              return $this->render('lampiran-toko',[
                'model'=>$checkOutModel,'no_invoice'=>$no_invoice,'modelBooking'=>$modelBooking
            ]);
        }
        public function actionPrintLampiranToko(){
            return $this->render('print-lampiran-toko');
        }
}
