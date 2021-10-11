<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\controllers;
use Yii;
use yii\web\Controller;
use backend\models\DataAgen;
use backend\models\DataAgenCariSearch;
/**
 * Description of PindahAnggotaAgenController
 *
 * @author Administrator
 */
class PindahAnggotaAgenController extends Controller{

//     public function actionIndex(){
//        $query = \backend\models\RefAgen::find();
//        $dataProvider = new \yii\data\ActiveDataProvider([
//            'query'=>$query,
//            'key'=>'id'
//        ]);
//        
//        return $this->render('index',[
//           'dataProvider'=>$dataProvider 
//        ]);
//    }
    
    public function actionIndex(){
        $model = new \yii\base\DynamicModel(['no_acak_agen']);
        $model->addRule('no_acak_agen', 'string');

          $searchModel = new DataAgenCariSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      
        $dataAgen = \backend\models\DataAgen::dropdownagenAllAgen();
        return $this->render('agen',[
          'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
            'dataAgen'=>$dataAgen,
            'model'=>$model
        ]);
    }
    public function actionPindah(){
                if(Yii::$app->request->post('no_acak_agen')){
            $no_acak_agen = Yii::$app->request->post('no_acak_agen');
             $selection = Yii::$app->request->post('selection');
             //agen dituju
             $dataAgenDtuju = DataAgen::find()->where(['no_acak'=>$no_acak_agen])->one();
            foreach ($selection as $value) {
           $dataAgen = \backend\models\DataAgen::findOne($value);
                $dataCekAnggota = \backend\models\DataAnggota::find()->where(['no_acak'=>$dataAgen['no_acak']]);
                if($dataCekAnggota->exists()){
                 $modelAnggota = $dataCekAnggota->one();   
                $modelAnggota->isNewRecord=false;
             //   $modelAnggota->no_acak = $dataAgen['no_acak'];
                }else{
                $modelAnggota = new \backend\models\DataAnggota();
                $modelAnggota->isNewRecord=true;
                $modelAnggota->id=null;
                $modelAnggota->no_acak = $dataAgen['no_acak'];//\backend\models\QueryModel::noacak();
                }
                $modelAnggota->no_acak_agen=$no_acak_agen;
                $modelAnggota->nama_agen=$dataAgen['nama_agen'];
                $modelAnggota->alamat = $dataAgen['alamat'];
                $modelAnggota->nope = $dataAgen['no_wa'];
                $modelAnggota->nik = $dataAgen['nik'];
                $modelAnggota->id_ref_agen = $dataAgen['id_ref_agen'];
                $modelAnggota->save(false);
                   $dataRegistrasi = \backend\models\RegistrasiAgen::find()->where(['no_acak' => $dataAgen['no_acak']])->one();
                   $dataRegistrasi->id_referen_agen=$dataAgenDtuju['id_agen'];
                   $dataRegistrasi->save(false);
          //      $dataAgen->id_agen=$dataAgenDtuju['id_']
                $dataAgen->no_acak_ref = $no_acak_agen;
                $dataAgen->save(false);
             }
             Yii::$app->session->setFlash('success','Berhasil di pindah');
                       return $this->redirect(Yii::$app->request->referrer);
     
        }
    }
      public function actionAnggotaAgen($no_acak){
        $model = new \yii\base\DynamicModel(['no_acak_agen']);
        $model->addRule('no_acak_agen', 'string');
        if($model->load(Yii::$app->request->post())){
            $no_acak_agen = $model->no_acak_agen;
             $selection = Yii::$app->request->post('selection');
            foreach ($selection as $value) {
           $dataAgen = \backend\models\DataAgen::findOne($value);
                $dataCekAnggota = \backend\models\DataAnggota::find()->where(['no_acak'=>$dataAgen['no_acak']]);
                if($dataCekAnggota->exists()){
                 $modelAnggota = $dataCekAnggota->one();   
                $modelAnggota->isNewRecord=false;
             //   $modelAnggota->no_acak = $dataAgen['no_acak'];
                }else{
                $modelAnggota = new \backend\models\DataAnggota();
                $modelAnggota->isNewRecord=true;
                $modelAnggota->id=null;
                $modelAnggota->no_acak = $dataAgen['no_acak'];//\backend\models\QueryModel::noacak();
                }
                $modelAnggota->no_acak_agen=$no_acak_agen;
                $modelAnggota->nama_agen=$dataAgen['nama_agen'];
                $modelAnggota->alamat = $dataAgen['alamat'];
                $modelAnggota->nope = $dataAgen['no_wa'];
                $modelAnggota->nik = $dataAgen['nik'];
                $modelAnggota->id_ref_agen = $dataAgen['id_ref_agen'];
                $modelAnggota->save(false);
                
                $dataAgen->no_acak_ref = $no_acak_agen;
                $dataAgen->save(false);
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        $query = \backend\models\DataAnggota::find()->where(['no_acak_ref'=>$no_acak]);
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query'=>$query,
            'key'=>'id'
        ]);
        $dataAgen = \backend\models\DataAgen::dropdownagenAllAgen();
        return $this->render('anggota-agen',[
           'dataProvider'=>$dataProvider ,
            'dataAgen'=>$dataAgen,
            'model'=>$model
        ]);
    }
    
}
