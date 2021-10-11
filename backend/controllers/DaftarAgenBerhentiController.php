<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\controllers;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use yii\db\Query;
use backend\models\DataAgen;
use backend\models\ArsipDataAgen;
use yii\web\Controller;
use backend\models\DataAgenSearch;

/**
 * Description of DaftarAgenBerhentiController
 *
 * @author Administrator
 */
class DaftarAgenBerhentiController extends Controller{

    
    public function actionIndex(){
    $query = ArsipDataAgen::find();
    
    $dataProvider = new ActiveDataProvider([
        'query'=>$query
    ]);
    
    return $this->render('index',[
        'dataProvider'=>$dataProvider
    ]);
    }    
    
    public function actionIndexAgen(){
//        $model = new \yii\base\DynamicModel(['tgl_berhenti','alasan']);
//        $model->addRule(['alasan'], 'string');
//        $model->addRule(['tgl_berhenti'], 'safe');
//        
        $searchModel = new DataAgenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
  
        return $this->render('index-agen', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
//            'model'=>$model
        ]);
        
    }
        public function actionCreate($id){
            $modelAgen = DataAgen::findOne($id);
        $model = new \yii\base\DynamicModel(['id', 'tgl_berhenti','alasan']);
        $model->addRule(['alasan','id'], 'string');
        $model->addRule(['tgl_berhenti'], 'safe');
           if($model->load(Yii::$app->request->post())){
               $no_acak = \backend\models\QueryModel::noacak();
               $sql = "insert into arsip_data_agen select :no_acak,:tgl_berhenti,:alasan ,a.* from data_agen a where a.id=:id";
               $params=[
                   ':id'=>$id,
                   ':no_acak'=>$no_acak,
                   ':tgl_berhenti'=>$model->tgl_berhenti,
                   ':alasan'=>$model->alasan
               ];
               Yii::$app->db->createCommand($sql, $params)->execute();
               \backend\models\DataToko::find()->where(['id_data_agen'=>$id])->one()->delete();
               $modelAgen->delete();
               \backend\models\User::find()->where(['no_acak'=>$modelAgen['no_acak']])->one()->delete();
               return $this->redirect(Yii::$app->request->referrer);
           }
     
  
        return $this->renderAjax('create', [
  'model'=>$model,
            'modelAgen'=>$modelAgen
        ]);
        
    }
}
