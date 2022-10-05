<?php

namespace common\components;

use Yii;
use linslin\yii2\curl;
use yii\base\Component;


class Notification extends Component {
    
    public function sendSMS($hash, $sender, $recipient, $title, $message, $via, $module, $action)
    {
        $url='https://api.dost9.ph/sms/messages';
                   
        $curl = new curl\Curl();
        
        $response = $curl->setPostParams([
            'hash' => $hash, 
            'sender' => $sender, 
            'recipient' => $recipient, 
            'title' => $title, 
            'message' => $message, 
            'via' => $via, 
            'module' => $module, 
            'action' => $action
         ])
         ->post($url);
    }
    
    public function sendEmail($hash, $sender, $recipient, $title, $message, $via, $module, $action)
    {
        $recipients = explode(',', $recipient);

        for($i=0; $i<count($recipients); $i++)
        {
            Yii::$app->mailer->compose()
            //Yii::$app->mailer->compose(['html' => 'html', 'text' => 'passwordResetToken-text'], ['user' => 'aris'])
            ->setFrom([Yii::$app->params['supportEmail'] => 'FAIMS Mailer'])
            ->setTo($recipients[$i])
            ->setSubject($title)
            ->setHtmlBody($message)
            ->send();
        }
    }
}