<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property integer $is_admin
 * @property string $photo
 * @property integer $vk_id
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_admin', 'vk_id'], 'integer'],
            [['name', 'email', 'password', 'photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя пользователя',
            'email' => 'Email',
            'password' => 'Пароль',
            'is_admin' => 'Is Admin',
            'photo' => 'Photo',
            'vk_id' => 'Vk ID',
        ];
    }

    public static function findIdentity($id)
    {
        //вытаскиваем пользователя из базы
        return User::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {

    }

    public function getId()
    {
        //возвращаем id пользователя
        return $this->id;
    }

    public function getAuthKey()
    {

    }

    public function validateAuthKey($authKey)
    {

    }

    //проверяем пользователя по имени
    public static function findByUsername ($name)
    {
        return User::find()->where(['name'=>$name])->one();
    }

    //проверяем пароль на правильность, сравнивая с кодировкой
    public function validatePassword ($password)
    {
//        return ($this->password == $password) ? true : false;
        return $this->password === sha1($password);
    }

    //сохраняем в базу данные из метода app/models/SignupForm::signup()
    public function create()
    {
        return $this->save(false);
    }

    //передаем пароль кодировке, чтобы не хранился в открытом виде
    public function setPassword($password)
    {
        $this->password = sha1($password);
    }

    //метод авторизации/регистрации через вконтакте
    public function saveFromVk($uid, $name, $photo)
    {
        //проверяем нет ли уже такого пользователя в базе
        $user = User::find()->where(['vk_id'=>$uid])->one();
        //если есть, то
        if($user)
        {
            //авторизуем его
            return Yii::$app->user->login($user);
        }
        else
        {
            //иначе создаем нового пользователя
            $this->vk_id = $uid;
            $this->name = $name;
            $this->photo = $photo;
            $this->create();
        }
        //и авторизвем его
        return Yii::$app->user->login($this);
    }

}
