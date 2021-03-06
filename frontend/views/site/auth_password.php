<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Войти или зарегистрироваться на сайте';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $model->scenario . ' / ' . $model->username . ' - ' . date("Y-m-d H:i:s"); ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <? if ($model->scenario == 'captcha_sc') {
                    echo $form->field($model, 'reCaptcha')->widget(\himiklab\yii2\recaptcha\ReCaptcha2::className())->label('Капча');
                } ?>

                <div class="form-group">
                    <?= Html::submitButton('ПРОДОЛЖИТЬ', ['class' => 'btn btn-primary btn-lg btn-block', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>

