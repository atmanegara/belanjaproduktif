<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\httpclient\Client;
use Telegram\Bot\Api;

/**
 * Description of BotBelanjaProduktifController
 *
 * @author Administrator
 */
class BotBelanjaProduktifController extends Controller{

    public function actionIndex() {
		
		
$telegram = new Api(Yii::$app->params['token']);

$response = $telegram->getUpdates();

return $response;
        /* while (true) {
            $this->processOne();
        } */
    }
  public function actionGetFileIndex() {
		
		
$telegram = new Api('1340621137:AAHQvDUIpCTwUKkmxDkW_1Nv1NudeTjwPoY');
$response = $telegram->getUpdates();
$data = (array)$response;
$response = $telegram->getFile(['file_id' => $data[1]['channel_post']['photo'][0]['file_id']]);
 $url = $this->requesturlfile($response['file_path']);
        $resp = file_get_contents($url);
		
header("Content-Disposition: attachment; filename=asdsd.jpg");
return $resp;
    }

    protected function requesturl($method) {
// $method = $method;
        return 'https://api.telegram.org/bot' . Yii::$app->params['token'] . '/' . $method;
    }
 protected function requesturlfile($method) {
// $method = $method;
        return 'https://api.telegram.org/file/bot' . '1340621137:AAHQvDUIpCTwUKkmxDkW_1Nv1NudeTjwPoY' . '/' . $method;
    }
    protected function getUpdates($offset) {
        $url = $this->requesturl("getUpdates") . "?offset=" . $offset;
        $resp = file_get_contents($url);
        $result = json_decode($resp, true);
        if ($result["ok"] == 1)
            return $result["result"];
        return [];
    }

    protected function sendReply($chatid, $msgid, $text) {
        $data = [
            'chat_id' => $chatid,
            'text' => $text,
            'reply_to_message_id' => $msgid
        ];

        $client = new Client();
        $response = $client->createRequest()
                ->setMethod('post')
                ->setUrl($this->requesturl('sendMessage'))
                ->addHeaders([
                    'content-type' => 'application/x-www-form-urlencoded',
                ])
                ->setData($data)
                ->send();
        if ($response->isOk) {

            $result = $response->content;
        }

        print_r($result);
    }

    protected function createResponse($text) {
        return "definisi " . $text;
    }

    protected function processMessage($message) {
        $updateid = $message["update_id"];
        $message_data = $message["message"];
        if (isset($message_data["text"])) {
            $chatid = $message_data["chat"]["id"];
            $message_id = $message_data["message_id"];
            $text = $message_data["text"];
            $response = $this->createresponse($text);
            $this->sendreply($chatid, $message_id, $response);
        }
        return $updateid;
    }

    protected function processOne() {
        $update_id = 0;

        if (file_exists("last_update_id")) {
            $update_id = (int) file_get_contents("last_update_id");
        }

        $updates = $this->getupdates($update_id);

        foreach ($updates as $message) {
            $update_id = $this->processmessage($message);
        }
        file_put_contents("last_update_id", $update_id + 1);
    }

}
