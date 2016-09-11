<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 2016/7/10
 * Time: 1:24
 */

namespace common\models;

use yii;
use backend\models\Role;
use backend\models\Status;
use backend\models\UserType;
use common\models\User;

class ValueHelpers
{


    /**
     * @param $role_name
     * @return bool
     */
    public static function roleMatch($role_name){
        $userHasRoleName = Yii::$app->user->identity->role->role_name;

        return $userHasRoleName == $role_name ? true:false;
    }


    /**
     * @param null $userId
     * @return bool
     */
    public static function getUsersRoleValue($userId = null){

        if($userId ==null){//如果用户id没有被设置

            $usersRoleValue = Yii::$app->user->identity->role->role_value;

            return isset($usersRoleValue)?$usersRoleValue:false;
        }else{//如果有用户ID

            $user = User::findOne($userId);

            $usersRoleValue = $user->role->role_value;

            return isset($usersRoleValue)?$usersRoleValue:false;

        }
    }

    /**
     * @param $role_name
     * @return bool|mixed
     */
    public static function getRoleValue($role_name){
        $role = Role::find()->where(['role_name'=>$role_name])->one();

        return isset($role->role_value)?$role->role_value:false;
    }

    /**
     * @param $role_name
     * @return bool
     */
    public static function isRoleNameValid($role_name){
        $role = Role::find()->where(['role_name'=>$role_name])->one();
        return isset($role->role_name)?true:false;
    }

    /**
     * @param $status_name
     * @return bool
     */
    public static function statusMatch($status_name){
        $userHasStatusName = Yii::$app->user->identity->status->status_name;

        return $userHasStatusName ==$status_name ?true:false;
    }


    /**
     * @param $status_name
     * @return bool
     */
    public static function getStatusId($status_name){
        $status = Status::find()->where(['status_name'=>$status_name])->one();

        return isset($status->id)?$status->id:false;
    }

    /**
     * @param $user_type_name
     * @return bool
     */
    public static function userTypeMatch($user_type_name){

        $userHasUserTypeName = Yii::$app->user->userType->user_type_name;

        return $userHasUserTypeName ==$user_type_name?true:false;
    }



}
