<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\FaqSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faq-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'faq_question') ?>

    <?= $form->field($model, 'faq_answer') ?>

    <?= $form->field($model, 'faq_category_id')->dropDownList($model->getFaqCategoryList(),['prompt'=>'Please Choose One']) ?>

    <?= $form->field($model, 'faq_is_featured')->dropDownList($model->faqIsFeaturedList,['prompt'=>'Please Choose One']) ?>

    <?php echo $form->field($model, 'faq_weight') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
