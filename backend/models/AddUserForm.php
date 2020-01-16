<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User;


/**
 * Форма добавления пользователей
 */
class AddUserForm extends Model
{
    public $username;
    public $password;
    public $email;
    public $phone;
    public $status;

    public $reCaptcha;




    public function rules()
    {
        return [
            [['status', 'reCaptcha'], 'required'],
            ['username', 'trim'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Такое имя уже существует.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['password', 'string', 'min' => 2, 'max' => 255],

            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот Email уже зарегистрирован.'],

            ['phone', 'match', 'pattern' => Yii::$app->params['patternPhone']],
            ['phone', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот телефон уже зарегистрирован.'],

            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator2::className(), 'uncheckedMessage' => 'Пожалуйста, подтвердите капчу.'],
        ];
    }



    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function save()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->status = $this->status;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save();
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя пользователя',
            'phone' => 'Телефон',
            'password' => 'Пароль',
            'status' => 'Статус',
        ];
    }
}
