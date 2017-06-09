<?php

namespace app\models;

use yii\base\Model;

class SignupForm extends Model
{
    public $name;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['name', 'email', 'password'],'required'],
            [['email'],'email'],
            [['name', 'password'],'string', 'min'=>4, 'max'=>10],
            [['email'],'unique','targetClass'=>'app\models\User', 'targetAttribute'=>'email'],
            [['name'],'unique','targetClass'=>'app\models\User', 'targetAttribute'=>'name']
        ];
    }

    //метод регистрации
    public function signup ()
    {
        //если валидация прошла успешно, то
        if ($this->validate())
        {
            //то создаем новый экземпляр User
            $user = new User();
            //передаем данные с полей формы
//            $user->attributes = $this->attributes;
            $user->name = $this->name;
            $user->email = $this->email;
            $user->setPassword($this->password);
            //возвращаем метод create
            return $user->create();
        }
    }
}