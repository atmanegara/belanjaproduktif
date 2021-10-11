<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\controllers;
use yii\web\Controller;
use Yii;
use yii\data\ActiveDataProvider;
use backend\models\CheckoutItem;

use backend\models\PembayaranJualbeli;
/**
 * Description of TagihanController
 *
 * @author Administrator
 */
class TagihanController extends Controller{
    //put your code here
    
    public function actionIndex()
    {
        //tampilkan invoice yang belum bayar
        
        $model = PembayaranJualbeli::find()->where(['id_status_pembayaran'=>'3'])->groupBy('no_invoice,no_acak');
        $dataProvider = new ActiveDataProvider([
            'query'=>$model
        ]);
        return $this->render('index',[
            'dataProvider'=>$dataProvider
        ]);
    }
    
    public function actionDetail($no_invoice){
 $dataItem = CheckoutItem::find()->where(['no_invoice' => $no_invoice])->all();
        $model = new \backend\models\PembayaranJualbeli();
        $modelDetailPembayaran = new \backend\models\DetailPembayaran();
        $detailPembayaran = \backend\models\DetailPembayaran::find()->where(['no_invoice' => $no_invoice])->one();
     $dataAgen = \backend\models\DataAgen::find()->where(['no_acak'=>$detailPembayaran['no_acak']])->one();
        return $this->render('detail', [
                    //   'no_invoice'=>$no_invoice,
                    // 'model'=>$model,
                    //'modelBank'=>$modelBank,
            'dataAgen'=>$dataAgen,
                    'model' => $model,
                    'dataItem' => $dataItem,
                    'detailPembayaran' => $detailPembayaran
        ]);

}
public function actionDetailTransaksiFranchise($no_acak){
    $modelDpPembayaran = \backend\models\DpPembayaran::find()->where(['no_acak'=>$no_acak]);
    $dataProvider = new ActiveDataProvider([
        'query'=>$modelDpPembayaran
    ]);
    return $this->render('detail-transaksi-franchise',[
        'dataProvider'=>$dataProvider
    ]);
}
public function actionDaftarFranchise(){
    $query = \backend\models\KonfirmasiPembayaran::find()->where(['id_status_dp'=>"1"]);
    
    $dataProvider = new ActiveDataProvider([
        'query'=>$query
    ]);
    
    return $this->render('daftar-franchise',[
        'dataProvider'=>$dataProvider
    ]);
}
}
