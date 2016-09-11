<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\FaqSearch */
/* @var $provider yii\data\ActiveDataProvider */

$this->title = 'FAQs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                Questions
            </h3>
        </div>

        <?php
        $data = $provider->getModels();//返回数据模型
        $questions = ArrayHelper::map($data,'faq_question','id');

        foreach($questions as $question =>$id){
            $url = Url::to(['faq/view','id'=>$id]);
            $options = [];
            echo "<div class='panel-body'>".Html::a($question,$url,$options).'</div>';
        }
        ?>

    </div>


</div>
