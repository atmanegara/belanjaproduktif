<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\controllers;
use Yii;
use yii\web\Controller;

/**
 * Description of AksesMenuController
 *
 * @author Administrator
 */
class AksesMenuController extends Controller{
    //put your code here
    
    public function actionIndex(){
        $sql = "SELECT a.label as label1,b.label as label2,c.label as label3,a.id as id1,b.id as id2,c.id as id3 FROM menu_header a 
left JOIN menu_sub_header b ON a.id=b.id_menu_header
LEFT JOIN menu_sub_header_tk2 c ON b.id=c.id_menu_sub_header
WHERE FIND_IN_SET(1,a.role_id) ORDER BY a.id";
        $query = (new \yii\db\Query())
                ->select('a.label as label1,b.label as label2,c.label as label3,a.id as id1,b.id as id2,c.id as id3')
                ->from('menu_header a')
                ->leftJoin('menu_sub_header b','a.id=b.id_menu_header AND FIND_IN_SET(1,b.role_id)')
                ->leftJoin('menu_sub_header_tk2 c','b.id=c.id_menu_sub_header')
                ->where('FIND_IN_SET(1,a.role_id)')->andWhere(['a.aktif'=>'Y'])->orderBy('a.no_urut');
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query'=>$query
        ]);
        return $this->render('index',[
            'dataProvider'=>$dataProvider
        ]);
    }
}
