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
            'name' => '��� ������������',
            'email' => 'Email',
            'password' => '������',
            'is_admin' => 'Is Admin',
            'photo' => 'Photo',
            'vk_id' => 'Vk ID',
        ];
    }

    public static function findIdentity($id)
    {
        //����������� ������������ �� ����
        return User::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {

    }

    public function getId()
    {
        //���������� id ������������
        return $this->id;
    }

    public function getAuthKey()
    {

    }

    public function validateAuthKey($authKey)
    {

    }

    //��������� ������������ �� �����
    public static function findByUsername ($name)
    {
        return User::find()->where(['name'=>$name])->one();
    }

    //��������� ������ �� ������������, ��������� � ����������
    public function validatePassword ($password)
    {
//        return ($this->password == $password) ? true : false;
        return $this->password === sha1($password);
    }

    //��������� � ���� ������ �� ������ app/models/SignupForm::signup()
    public function create()
    {
        return $this->save(false);
    }

    //�������� ������ ���������, ����� �� �������� � �������� ����
    public function setPassword($password)
    {
        $this->password = sha1($password);
    }

    //����� �����������/����������� ����� ���������
    public function saveFromVk($uid, $name, $photo)
    {
        //��������� ��� �� ��� ������ ������������ � ����
        $user = User::find()->where(['vk_id'=>$uid])->one();
        //���� ����, ��
        if($user)
        {
            //���������� ���
            return Yii::$app->user->login($user);
        }
        else
        {
            //����� ������� ������ ������������
            $this->vk_id = $uid;
            $this->name = $name;
            $this->photo = $photo;
            $this->create();
        }
        //� ���������� ���
        return Yii::$app->user->login($this);
    }

}
