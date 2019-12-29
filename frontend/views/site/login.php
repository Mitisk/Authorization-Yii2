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





            <script>

                var inp = document.getElementById("loginform-username");

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

                /*$(document).ready(function(){
                    //var pattern = /^\+7\s\([0-9]{3}\)\s[0-9]{3}\-[0-9]{2}\-[0-9]{2}$/;
                    var pattern = /^\+7$/;
                    var pattern1 = /^\7$/;
                    var pattern2 = /^\8$/;
                    var loginInput = $('#loginInput');

                    loginInput.blur(function(){
                        if(loginInput.val() != ''){
                            if(loginInput.val().search(pattern) == 0 || loginInput.val().search(pattern1) == 0 || loginInput.val().search(pattern2) == 0){
                                $('#loginInput').mask('+7 (999) 999-99-99');
                                $('#vali1d').text('Подходит');
                            }else{
                                $('#vali1d').text('Не подходит');
                            }
                        } else {
                            $('#vali1d').text('Поле e-mail не должно быть пустым!');
                        }
                    });
                });*/

                /*window.addEventListener("DOMContentLoaded", function() {
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

                    var pattern = /^\+7$/;
                    var pattern1 = /^\7$/;
                    var pattern2 = /^\8$/;

                    var input = document.querySelector("#tel");

                 */

                    /*if(input != ''){
                        if(input.val().search(pattern) == 0 || input.val().search(pattern1) == 0 || input.val().search(pattern2) == 0){

                            $('#vali1d').text('Подходит');
                        }else{
                            $('#vali1d').text('Не подходит');
                        }
                    } else {
                        $('#vali1d').text('Поле e-mail не должно быть пустым!');
                    }*/

                    /*

                    input.addEventListener("input", mask, false);
                    input.addEventListener("focus", mask, false);
                    input.addEventListener("blur", mask, false);
                });*/
            </script>


        </div>
    </div>
</div>

