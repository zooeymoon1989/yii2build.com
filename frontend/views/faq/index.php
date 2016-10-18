<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use components\FaqWidget;
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

    <?=
        FaqWidget::widget([
            'settings'=>[
                'pageSize'=>10,
                'featuredOnly'=>false,
                'heading' => 'Featured FAQs'
            ]
        ]);
    ?>


</div>
