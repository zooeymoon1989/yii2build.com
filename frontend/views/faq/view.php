<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Faq */

$this->title = 'FAQ: '.$model->faq_question;
$this->params['breadcrumbs'][] = ['label' => 'FAQ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title">
            <h1> <?= $model->faq_question;?> </h1>
        </h3>
    </div>
    <?= '<div class="panel-body"><h3>'.
    $model->faq_answer .'</h3></div>';?>

</div>
