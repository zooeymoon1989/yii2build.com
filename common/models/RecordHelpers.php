<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 2016/7/19
 * Time: 0:58
 */

namespace common\models;

use yii;
use backend\models\StatusMessage;

class RecordHelpers
{

    /**
     * 通过表明返回ID
     * @param $model_name string 表名
     * @return bool
     */
    public static function userHas($model_name)
    {

        $connection = \Yii::$app->db;
        $userId = Yii::$app->user->id;
        $sql = "SELECT id FROM $model_name WHERE user_id = :userId";
        $command = $connection->createCommand($sql);
        $command->bindValue(':userId',$userId);
        $result = $command->queryOne();

        if($result ==null){//如果没有结果返回
            return false;
        }else{

            return $result['id'];

        }


    }


    /**
     * 通过行为和控制器名称来返回是否有对应的记录
     * @param $action_name string 行为名称
     * @param $controller_name string 控制器名称
     * @return bool|mixed
     */
    public static function findStatusMessage($action_name,$controller_name)
    {
        $result = StatusMessage::find()
            ->where(['action_name'=>$action_name])
            ->andWhere(['controller_name'=>$controller_name])
            ->one();

        return isset($result['id'])?$result['id']:false;
    }


    /**
     * @param $id
     * @return bool|mixed
     */
    public static function getMessageSubject($id)
    {
        $result = StatusMessage::find()
            ->where(['id'=>$id])
            ->one();

        return isset($result['subject'])?$result['subject']:false;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public static function getMessageBody($id)
    {
        $result = StatusMessage::find()
            ->where(['id'=>$id])
            ->one();

        return isset($result['body'])?$result['body']:false;
    }

}