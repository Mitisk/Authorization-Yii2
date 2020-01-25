<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserBehavior */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-create-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <? if ($methodToPass == 'update') {
        echo $form->field($model, 'password_hash')->textInput(['maxlength' => true, 'disabled' => true]);
        //echo $form->field($model, 'new_password')->textInput(['maxlength' => true, 'placeholder' => 'Оставьте пустым, если не хотите менять']);
    }?>

    <? if ($methodToPass == 'create') {
        echo $form->field($model, 'password')->textInput(['maxlength' => true, 'placeholder' => 'Обязательно']);
    }?>


    <?= $form->field($model, 'email')->input('email'); ?>

    <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '+7 (999) 999-99-99',])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(['10' => 'Активированный пользователь', '9' => 'Неактивированный пользователь', '0' => 'Удаленный пользователь']) ?>


    <?= $form->field($model, 'reCaptcha')->widget(\himiklab\yii2\recaptcha\ReCaptcha2::className())->label('Капча'); ?>



    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>