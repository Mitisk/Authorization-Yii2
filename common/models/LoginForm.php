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
    public $pin;
    private $_user;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'pin'], 'required'],
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
            if ($this->pin != "9113") {
                $this->addError($attribute, 'Неверные данные.');
            }
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неверные данные.');
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
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }
        return $this->_user;
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Email',
            'password' => 'Пароль',
            'pin' => 'Пинкод',
        ];
    }
}