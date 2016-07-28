<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\PermissionHelpers;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;

$show_this_nav = PermissionHelpers::requireMinimumRole('SuperUser');

$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php

            if(!Yii::$app->user->isGuest && $show_this_nav){

                echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);

                echo "&nbsp;";

                echo Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ;
            }

        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['attribute'=>'profileLink','format'=>'raw'],
            'id',
            //'username',
            'email:email',
            'statusName',
            'roleName',
            'userTypeName',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
