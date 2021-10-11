<?php
namespace common\component;

use backend\models\TentangKami;
use backend\models\DetailAbout;
class TentangKamiComponent extends \yii\base\Component{
    
    
    public static function getDataTentangKami(){
        
        $model = TentangKami::findOne(1);
        
        return $model;
    }
    
     public static function getDetailTentangKami(){
        
        $model = DetailAbout::findOne(1);
        
        return $model;
    }
}