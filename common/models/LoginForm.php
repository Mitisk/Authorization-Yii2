<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            ['username', 'validateUsername'],
                // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
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

    public function validateUsername($attribute, $params)
    {
        $patternPhone = "/^\+7\s\([0-9]{3}\)\s[0-9]{3}\-[0-9]{2}\-[0-9]{2}$/";
        $patternEmail = "/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/";

        if (preg_match($patternPhone, $this->$attribute) == 0) {

            if (preg_match($patternEmail, $this->$attribute) == 0) {

                $this->addError($attribute, 'Неверный телефон или email');

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
        $user = new User();
        $user->phone = $this->username;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        return $user->save();
        //return  $user = $this->getUser();
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {

            $patternPhone = "/^\+7\s\([0-9]{3}\)\s[0-9]{3}\-[0-9]{2}\-[0-9]{2}$/";
            $patternEmail = "/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/";

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
