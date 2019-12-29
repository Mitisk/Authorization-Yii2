<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div style="color:#999;margin:1em 0">
                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                    <br>
                    Need new verification email? <?= Html::a('Resend', ['site/resend-verification-email']) ?>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>

            <input type="text" name="txt" value="Hello" onchange="myFunction(this.value)">

            <script>
                function myFunction(val) {
                    if (val = 3) {
                        alert("The input value has changed. The new value is: " + val);
                    }

                }
            </script>


            <input  value="" id="tel">
            <script>
                window.addEventListener("DOMContentLoaded", function() {
                    function setCursorPosition(pos, elem) {
                        elem.focus();
                        if (elem.setSelectionRange) elem.setSelectionRange(pos, pos);
                        else if (elem.createTextRange) {
                            var range = elem.createTextRange();
                            range.collapse(true);
                            range.moveEnd("character", pos);
                            range.moveStart("character", pos);
                            range.select()
                        }
                    }

                    function mask(event) {
                        var matrix = "+7 (___) ___ ____",
                            i = 0,
                            def = matrix.replace(/\D/g, ""),
                            val = this.value.replace(/\D/g, "");
                        if (def.length >= val.length) val = def;
                        this.value = matrix.replace(/./g, function(a) {
                            return /[_\d]/.test(a) && i < val.length ? val.charAt(i++) : i >= val.length ? "" : a
                        });
                        if (event.type == "blur") {
                            if (this.value.length == 2) this.value = ""
                        } else setCursorPosition(this.value.length, this)
                    };
                    var input = document.querySelector("#tel");
                    input.addEventListener("input", mask, false);
                    input.addEventListener("focus", mask, false);
                    input.addEventListener("blur", mask, false);
                });
            </script>


        </div>
    </div>
</div>
