<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php

        echo Collapse::widget([
            'items'=>[
                [
                    'label'=>'Search',
                    'content'=>$this->render('_search',['model'=>$searchModel])
                ]
            ]
        ]);
    ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            ['attribute'=>'userIdLink','format'=>'raw'],
            ['attribute'=>'userLink','format'=>'raw'],
            ['attribute'=>'ProfileLink','format'=>'raw'],
            'username',
            'email:email',
            'statusName',
            'roleName',
            'userTypeName',
            'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
