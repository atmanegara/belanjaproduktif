<?php
namespace backend\modules\pos\controllers;
use Yii;
use yii\web\Controller;
use yii\db\Query;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class KasirController extends \yii\web\Controller{
    
    
    public function init() {
        parent::init();
        $this->layout = 'main-kasir';
    }
    
    public function actionIndex(){
        $no_acak = Yii::$app->user->identity->no_acak;
        $no_invoice = \backend\models\QueryModel::noinvoice();
    return $this->render('index',['no_acak'=>$no_acak,'no_invoice'=>$no_invoice]);    
    }
    
    public function actionGetBarangBarcode(){
        
        $no_acak = Yii::$app->user->identity->no_acak;
        $dataAgen = \backend\models\DataAgen::find()->where(['no_acak'=>$no_acak])->one();
        $id_data_agen = $dataAgen['id'];
        $kode_barcode = Yii::$app->request->post('kode_barcode');
        $id_user = Yii::$app->user->getId();
        
                 $queryCek = (new Query())
                                ->select('a.id_ref_barang,a.id id_data_barang,b.nama_barang,a.harga_satuan,a.kode_barcode,c.harga_jual')
                                ->from('data_barang a')
                                ->innerJoin('ref_barang b', 'a.id_ref_barang=b.id')
                                ->innerJoin('stok_barang c', 'a.id=c.id_data_barang')
                               ->where(['a.kode_barcode' => $kode_barcode,'a.id_data_agen'=>$id_data_agen]);
               if($queryCek->exists()){
                   $query = $queryCek->one();
               }else{
                   $query=[
                       'message'=>false
                   ];
               }
                 return \yii\helpers\Json::encode($query);
    }
    
    public function actionBayarTunai(){
        $model = new \yii\base\DynamicModel(['totalbayar','totaltunai','totalkembali']);
        $model->addRule(['totalbayar','totaltunai','totalkembali'], 'integer');
        return $this->renderAjax('bayar-tunai',[
            'model'=>$model
        ]);
    }
}
