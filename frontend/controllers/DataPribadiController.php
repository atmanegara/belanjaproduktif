<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use \yii\db\Query;
/**
 * Description of DataPribadiController
 *
 * @author Administrator
 */
class DataPribadiController extends Controller{
    //put your code here
    
    
    public function actionIndex(){
        $no_acak = Yii::$app->user->identity->no_acak;
        $model = \backend\models\DataKonsumen::find()->where(['no_acak'=>$no_acak])->one();
        $modelAlamat = \backend\models\AlamatKonsumen::find()->where(['no_acak'=>$no_acak,'ini'=>"Y"])->one();
        
              //$jumlah semua selesai
      $dataItemSelesai =(new Query())
                ->select('a.id_data_barang,a.no_acak,b.item_barang,a.id,b.filename')
                ->from('checkout_item a')
                ->innerJoin('data_barang b','a.id_data_barang=b.id')
                ->innerJoin('pembayaran_jualbeli c','c.no_invoice=a.no_invoice and c.id_status_pembayaran=2')
              ->groupBy('a.no_invoice,a.no_acak')->where(['a.no_acak'=>$no_acak])->count();
          
                      //$jumlah barang belum isi data pengiriman
      $dataItemSelesaiCheckout =(new Query())
                ->select('a.id_data_barang,a.no_acak,b.item_barang,a.id,b.filename')
                ->from('checkout_item a')
                ->innerJoin('data_barang b','a.id_data_barang=b.id')
              ->groupBy('a.no_invoice,a.no_acak')->where(['a.no_acak'=>$no_acak])->count();
      
//jumlah item menunggu pembayaran
       $dataItemSelesaipembayaran =(new Query())
                ->select('a.id_data_barang,a.no_acak,b.item_barang,a.id,b.filename')
                ->from('checkout_item a')
                ->innerJoin('data_barang b','a.id_data_barang=b.id')
                ->innerJoin('pembayaran_jualbeli c','c.no_invoice=a.no_invoice and c.id_status_pembayaran=3')
              ->groupBy('a.no_invoice,a.no_acak')->where(['a.no_acak'=>$no_acak])->count();
    ///item terverifikasi
        $dataItemverifikasi =(new Query())
                ->select('a.id_data_barang,a.no_acak,b.item_barang,a.id,b.filename')
                ->from('checkout_item a')
                ->innerJoin('data_barang b','a.id_data_barang=b.id')
                ->innerJoin('pembayaran_jualbeli c','c.no_invoice=a.no_invoice and c.id_status_pembayaran=1')
              ->groupBy('a.no_invoice,a.no_acak')->where(['a.no_acak'=>$no_acak])->count();
        
        return $this->render('index',[
            'model'=>$model,
            'modelAlamat'=>$modelAlamat,
            'dataItemSelesai'=>$dataItemSelesai,
            'dataItemSelesaipembayaran'=>$dataItemSelesaipembayaran,
            'dataItemSelesaiCheckout'=>$dataItemSelesaiCheckout,
            'dataItemverifikasi'=>$dataItemverifikasi
                ]);
    }
}
