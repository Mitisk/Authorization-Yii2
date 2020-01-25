<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>





<div class="site-login">
    <p class="login-box-msg">Введите данные, чтобы начать сессию</p>



            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>




                 <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'pin')->passwordInput() ?>







                <div class="form-group">
                    <?= Html::submitButton('ВХОД', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>


</div>
