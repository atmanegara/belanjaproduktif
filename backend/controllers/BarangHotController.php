<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\controllers;
use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use backend\models\BarangHot;
use yii\db\Query;

/**
 * Description of BarangHotController
 *
 * @author Administrator
 */
class BarangHotController extends Controller{
    //put your code here
    
    
    public function actionIndex(){
       $query=(new Query())
        ->select('a.id,bb.id as id_hot,a.filename,a.nama_barang AS item_barang,c.stok_sisa,c.harga_jual,b.id_data_agen,b.ket,b.harga_satuan')
        ->from('ref_barang a')
        ->innerJoin('data_barang b','a.id=b.id_ref_barang')
         ->innerJoin('barang_hot bb','b.id_ref_barang=bb.id_ref_barang')
        ->leftJoin('stok_barang c','c.id_data_barang=b.id')->where(['a.tampil'=>'Y'])->groupBy('a.kode')->limit(6)->orderBy('c.harga_jual desc');
  //      return $dataBarang;
    $dataProvider = new ActiveDataProvider([
        'query'=> $query,
        'key'=>'id'
    ]);
      $cekBykItem = BarangHot::find()->count();
        if($cekBykItem>6){
            $tombolDisable=true;
        }else{
            $tombolDisable=false;
        }
    return $this->render('index',[
        'dataProvider'=>$dataProvider,
        'tombolDisable'=>$tombolDisable
    ]);
        
    }
    
    
    public function actionCreate(){
      
      
        $model = new BarangHot();
        if($model->load(Yii::$app->request->post())){
            $selection = Yii::$app->request->post('selection');
            $nourut=1;
            foreach($selection as $val){
        $modelBarang = new BarangHot();
                $modelBarang->isNewRecord=true;
                $modelBarang->id=null;
                $modelBarang->no_urut=$nourut++;
                $modelBarang->id_ref_barang=$val;
                if($nourut<=6){
                $modelBarang->save();
                }
            }
            
              return $this->redirect(['index']);
            
        }
          //cek byk inputan max 6 item
        $query=(new Query())
        ->select('a.id,a.filename,a.nama_barang AS item_barang,c.stok_sisa,c.harga_jual,b.id_data_agen,b.ket,b.harga_satuan')
        ->from('ref_barang a')
        ->innerJoin('data_barang b','a.id=b.id_ref_barang')
        ->leftJoin('stok_barang c','c.id_data_barang=b.id')->where(['a.tampil'=>'Y'])->groupBy('a.kode')->orderBy('c.harga_jual desc');
  //      return $dataBarang;
    $dataProvider = new ActiveDataProvider([
        'query'=> $query,
            'key'=>'id'
    ]);
        return $this->render('create',[
            'model'=>$model,
            'dataProvider'=>$dataProvider
        ]);
        
    }
    
    
    public function actionUpdate($id){
        //cek byk inputan max 6 item
        
        $cekBykItem = BarangHot::find()->count();
        if($cekBykItem>6){
            $tombolDisable=true;
        }else{
            $tombolDisable=false;
        }
        $model = BarangHot::findOne($id);
        if($model->load(Yii::$app->request->post())){
            if($model->save()){
              return $this->redirect(Yii::$app->request->referrer);
            }
            
        }
        
        return $this->renderAjax('_form');
        
    }
    
    public function actionDelete($id){
        BarangHot::findOne($id)->delete();
              return $this->redirect(Yii::$app->request->referrer);
        
    }
    
    
}
