<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 2016/8/3
 * Time: 0:58
 */

namespace common\models;

use yii;
use common\models\RecordHelpers;

class MailCall
{

    public static function sendTheMail($message_id)
    {
        return Yii::$app->mailer->compose()
            ->setTo(Yii::$app->user->identity->email)
            ->setFrom(['no-reply@yii2build.com' => 'Yii 2 Build'])
            ->setSubject(RecordHelpers::getMessageSubject($message_id))
            ->setTextBody(RecordHelpers::getMessageBody($message_id))
            ->send();
    }


    public static function onMailableAction($action_name,$controller_name)
    {
        if($message_id = RecordHelpers::findStatusMessage($action_name,$controller_name)){
            self::sendTheMail($message_id);
        }
    }

}