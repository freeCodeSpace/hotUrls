<?php
namespace app\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    private $_user = false; // временное поле хранения username (для 1-го обращения не хранит имя пользователя)

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            // password валидируется отдельным (реализуемым ниже) методом validatePassword()
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
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Не корректное имя или пароль.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) { // вызывается валидация согласно правилам rules и заполняется $_user
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
            // устанавливается статус пользователя, запоминается в session и cookie.
        } else {
            return false;
        }
    }

    /**
     * Находит пользователя по [[username]]
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) { // если вызов 1-й раз, пользователь еще не искался и поле содержит false
             // находим пользователя в модели User передавая данные из формы (и устанавливается $this->_user)
            $this->_user = User::findByUsername($this->username);
        }
        return $this->_user; // (если не false) возвращается объект класса User содержащий массив с данными о пользователе
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня',
        ];
    }
}