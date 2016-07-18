<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 2016/7/13
 * Time: 2:01
 */

namespace common\models;

use common\models\ValueHelpers;
use yii;
use yii\web\Controller;
use yii\helpers\Url;

class PermissionHelpers{

    public static function requireUpgradeTo($user_type_name){

        if(!ValueHelpers::userTypeMatch($user_type_name)){

            return Yii::$app->getResponse()->redirect(Url::to(['upgrade/index']));

        }

    }

    public static function requireStatus($status_name){

        return ValueHelpers::statusMatch($status_name);

    }

    public static function requireRole($role_name){

        return ValueHelpers::roleMatch($role_name);
        
    }

    public static function userMustBeOwner($model_name,$model_id){

        $connection = Yii::$app->db;

        $userId = Yii::$app->user->id;

        $sql = "SELECT id FROM $model_name WHERE user_id = :userId AND id = :model_id";

        $command = $connection->createCommand($sql);
        $command->bindValue(":userId",$userId);
        $command->bindValue(":model_id",$model_name);

        if($result = $command->queryOne()){
            return true;
        }else{
            return false;
        }

    }

    public static function requireMinimumRole($role_name,$userId = null){

        if(ValueHelpers::isRoleNameValid($role_name)){

            if($userId ==null){

                $userRoleValue = ValueHelpers::getUsersRoleValue();

            }else{

                $userRoleValue = ValueHelpers::getUsersRoleValue($userId);

            }

            return $userRoleValue >=ValueHelpers::getRoleValue($role_name)?true:false;

        }else{
            return false;
        }

    }

}