<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;

class ProfilPribadiController extends Controller
{
    public function actionIndex(){
        return 'ada';
        $no_acak = Yii::$app->user->identity->no_acak;
        return $this->redirect(Yii::$app->request->referrer);
    }
    
}

