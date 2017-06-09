<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property string $created_id
 * @property string $update_id
 * @property integer $qty
 * @property double $sum
 * @property integer $status
 * @property string $name
 * @property string $email
 * @property integer $phone
 * @property string $addres
 */
class Order extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    public function  behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_id', 'update_id'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update_id'],
                ],
                // если вместо метки времени UNIX используется datetime:
                 'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'addres'], 'required'],
            [['created_id', 'update_id'], 'safe'],
            [['qty', 'phone'], 'integer'],
            [['sum'], 'number'],
            [['status'],'boolean'],
            [['email'], 'email'],
            [['name', 'email', 'addres'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_id' => 'Создан',
            'update_id' => 'Изменен',
            'qty' => 'Кол-во',
            'sum' => 'Сумма',
            'status' => 'Статус',
            'name' => 'Имя',
            'email' => 'Email',
            'phone' => 'Телефон',
            'addres' => 'Адрес и комментарий к заказу',
        ];
    }

    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['order_id' => 'id']);
    }
}
