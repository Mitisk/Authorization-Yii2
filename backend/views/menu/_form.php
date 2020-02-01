<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Menu;

/* @var $this yii\web\View */
/* @var $model common\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sub')->dropDownList(Menu::getDropDownParentCathegoryList()) ?>

    <?// $form->field($model, 'rgt')->textInput() ?>

    <?// $form->field($model, 'depth')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Удалить', \yii\helpers\Url::toRoute(['delete', 'id' => $model->id]), ['data' => ['method' => 'post'], 'class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
