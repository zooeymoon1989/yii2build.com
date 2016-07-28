<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
    <br/>
    <?= $form->field($model, 'birthday')->widget(yii\jui\DatePicker::className(),
        [
            'dateFormat'=>'yyyy-MM-dd',
            'clientOptions'=>[
                'changeMonth'=> true,
                'changeYear'=> true
            ]
        ]
        ) ?>
    * please use YYYY-MM-DD format

    <br/>
    <br/>

    <?= $form->field($model, 'gender_id')->dropDownList($model->genderList,['prompt'=>'Please Choose One']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
