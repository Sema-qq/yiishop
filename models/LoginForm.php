<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $name;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name and password are both required
            [['name', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
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
        //проверяем не было ли ошибок в предыдущих проверках
        if (!$this->hasErrors()) {
            //получаем пользователя
            $user = $this->getUser();
            //если пользователь не получен или пароли не совпадают, то
            if (!$user || !$user->validatePassword($this->password)) {
                //выдаем ошибку
                $this->addError($attribute, 'Пользователь или пароль введены не верно');
            }
        }
    }

    //метод логин
    public function login()
    {
        //если прошли валидацию полей, то
        if ($this->validate()) {
            //передаем пользователя компоненту логин и авторизируем его
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    //проверяем введенные данные и получаем пользователя
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->name);
        }

        return $this->_user;
    }
}
