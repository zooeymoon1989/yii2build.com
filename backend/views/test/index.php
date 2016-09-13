<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $pages backend\models\search\FaqSearch */
/* @var $models yii\data\ActiveDataProvider */

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
            foreach($models as $model){
                $url = Url::to(['faq/view','id'=>$model->id]);
                $option =[];
                echo '<div class="panel-body">'.Html::a($model->faq_question,$url,$option).'</div>';
            }

            echo \yii\widgets\LinkPager::widget([
                'pagination'=>$pages
            ]);
        ?>

    </div>


</div>