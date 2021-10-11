<?php
namespace backend\models;


use Yii;
use yii\base\Model;
use yii\httpclient\Client;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BotModel
 *
 * @author Administrator
 */
class BotModel extends Model {
    //put your code here
    
   public static function requesturl($method) {
// $method = $method;
        return 'https://api.telegram.org/bot' . Yii::$app->params['token'] . '/' . $method;
    }
    
      public static function sendReply($text) {
        $data = [
            'chat_id' =>Yii::$app->params['id_me'] ,
            'text' => $text,
        ];

        $client = new Client();
        $response = $client->createRequest()
                ->setMethod('post')
                ->setUrl(BotModel::requesturl('sendMessage'))
                ->addHeaders([
                    'content-type' => 'application/x-www-form-urlencoded',
                ])
                ->setData($data)
                ->send();
        if ($response->isOk) {

            $result = $response->content;
        }

      //  print_r($result);
    }
}
