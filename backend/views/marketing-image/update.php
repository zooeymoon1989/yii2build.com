<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MarketingImage */

$this->title = 'Update Marketing Image: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Marketing Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="marketing-image-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
