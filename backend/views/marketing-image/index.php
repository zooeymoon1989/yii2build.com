<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\MarketingImageSeaching */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Marketing Images';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marketing-image-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Marketing Image', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'marketing_image_path',
            'marketing_image_name',
            'marketing_image_caption',
            'marketing_image_is_featured',
            // 'marketing_image_is_active',
            // 'marketing_image_weight',
            // 'status_id',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
