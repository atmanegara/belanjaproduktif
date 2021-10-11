<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\KonfirmasiPembayaran;
use yii\data\ActiveDataProvider;

/**
 * Description of TransaksiFranchiseController
 *
 * @author Administrator
 */
class TransaksiFranchiseController extends Controller{
    //put your code here
    
    public function actionIndex(){
        
        $query = KonfirmasiPembayaran::find()->where('id_status_pembayaran=2');
        
        $dataProvider = new ActiveDataProvider([
            'query'=>$query
        ]);
        return $this->render('index',[
            'dataProvider'=>$dataProvider
        ]);
    }
}
