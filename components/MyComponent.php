<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 2016/9/12
 * Time: 0:37
 */

namespace components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

class MyComponent extends Component
{

    public function blastOff()
    {
        echo "Beijing , we have ignition..";
    }



}