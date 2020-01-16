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

                    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

                <? if ($model->scenario == 'captcha_sc') {
                    echo $form->field($model, 'reCaptcha')->widget(\himiklab\yii2\recaptcha\ReCaptcha2::className())->label('Капча');
                } ?>

                <div class="form-group">
                    <?= Html::submitButton('ПРОДОЛЖИТЬ', ['class' => 'btn btn-primary btn-lg btn-block', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>


            <script>
                var inp = document.getElementById("authform-username");

                var old = 0;

                var phoneFlag = false;

                inp.onkeydown = function() {
                    var curLen = inp.value.length;


                    if (curLen < old){
                        old--;
                        return;
                    }

                    if (curLen == 1) {
                        if (inp.value == '8' || inp.value == '7') {
                            inp.value = "";
                            inp.value = inp.value + "+7 (";
                            phoneFlag = true;
                        }
                    }

                    if (inp.value == '+7') {
                            inp.value = "";
                            inp.value = inp.value + "+7 (";
                            phoneFlag = true;
                        }

                    if (phoneFlag) {
                        if (curLen == 7)
                            inp.value = inp.value + ") ";

                        if (curLen == 12)
                            inp.value = inp.value + "-";

                        if (curLen == 15)
                            inp.value = inp.value + "-";

                        if (curLen > 17)
                            inp.value = inp.value.substring(0, inp.value.length - 1);

                        old++;
                    }

                }
            </script>

        </div>
    </div>
</div>

