<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Cabinet extends Model
{
    public $name;
    public $password;

    public function rules()
    {
        return [
            [['name', 'password'], 'required', 'message' => 'Поле не заполнено!'],
            [['name', 'password'],'string', 'min'=>4, 'max'=>10],
            [['name'],'unique','targetClass'=>'app\models\User', 'targetAttribute'=>'name', 'message' => 'Такое имя уже сущесвтвует!']
        ];
    }

    public function edit ()
    {
        if($this->validate())
        {
            //вытаскиваем текущего пользователя из базы
            $user = Yii::$app->user->identity;
//            echo '<pre>';var_dump($user);die();
            //передаем данные с полей формы
//            $user->attributes = $this->attributes;
            $user->name = $this->name;
            $user->setPassword($this->password);
            //возвращаем метод create
            return $user->create();
        }
    }

    //передаем пароль кодировке, чтобы не хранился в открытом виде
    public function setPassword($password)
    {
        $this->password = sha1($password);
    }
}