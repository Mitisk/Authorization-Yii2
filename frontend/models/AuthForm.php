<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Форма авторизации/регистрации пользователей
 */
class AuthForm extends Model
{
    public $username;
    public $password;

    private $_user;

    //Первый сценарий - пользователь вводит username
    const SCENARIO_USERNAME_CS = 'username_sc';
    //Второй сценарий - пользователь вводит пароль
    const SCENARIO_PASSWORD_CS = 'password_sc';


    public function rules()
    {
        return [
            ['username', 'required', 'on' => self::SCENARIO_USERNAME_CS],
            ['username', 'validateUsername', 'on' => self::SCENARIO_USERNAME_CS],
            ['username', 'string', 'min' => 2, 'max' => 255, 'on' => self::SCENARIO_USERNAME_CS],

            ['password', 'required', 'on' => self::SCENARIO_PASSWORD_CS],
            ['password', 'validatePassword', 'on' => self::SCENARIO_PASSWORD_CS],
        ];
    }

    /**
     * Валидация логина пользователя
     */

    public function validateUsername($attribute, $params)
    {
        $patternPhone = Yii::$app->params['patternPhone'];
        $patternEmail = Yii::$app->params['patternEmail'];

        if (preg_match($patternPhone, $this->$attribute) == 0) {

            if (preg_match($patternEmail, $this->$attribute) == 0) {

                $this->addError($attribute, 'Неверный телефон или email');

            }

        }
    }

    public function goToPassword()
    {
        if ($this->validate()) {
            $user = $this->getUser();
            // Если новый пользователь, то регистрируем и отправляем пароль
            if(!$user) {
                $this->signup();
            }

            return true;
        }

        return false;
    }

    /**
     * Валидация пароля
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if(!$user) {
                $this->addError($attribute, 'Ytn gjkmpjdfntkz.');
            }

            if (!$user || !$user->validatePassword($this->password)) {
                //$this->signup();
                $this->addError($attribute, 'Неверные данные для входа.');
            }
        }
    }



    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), 3600 * 24 * 366);
        }

        return false;
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        $username = trim($this->username);

        $patternPhone = Yii::$app->params['patternPhone'];
        $patternEmail = Yii::$app->params['patternEmail'];

        $user = new User();
        $user->setPassword('123456');
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        if (preg_match($patternPhone, $username) == 1) {
            //По телефону
            $user->phone = $username;
        }

        if (preg_match($patternEmail, $username) == 1) {
            //По email
            $user->email = $username;
        }
        $user->status = 10;
        return $user->save(); //&& $this->sendEmail($user);
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {

            $patternPhone = Yii::$app->params['patternPhone'];
            $patternEmail = Yii::$app->params['patternEmail'];

            if (preg_match($patternPhone, $this->username) == 1) {

                $this->_user = User::findByPhone($this->username);

            }

            if (preg_match($patternEmail, $this->username) == 1) {

                $this->_user = User::findByUsername($this->username);

            }

        }

        return $this->_user;
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Email/Телефон',
            'password' => 'Пароль',
        ];
    }
}
