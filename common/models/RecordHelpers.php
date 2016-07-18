<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 2016/7/19
 * Time: 0:58
 */

namespace common\models;

use yii;

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

}