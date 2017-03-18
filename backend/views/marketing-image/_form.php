<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MarketingImage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marketing-image-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'marketing_image_path')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'marketing_image_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'marketing_image_caption')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'marketing_image_is_featured')->textInput() ?>

    <?= $form->field($model, 'marketing_image_is_active')->textInput() ?>

    <?= $form->field($model, 'marketing_image_weight')->textInput() ?>

    <?= $form->field($model, 'status_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
