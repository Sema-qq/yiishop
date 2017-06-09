<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_order".
 *
 * @property integer $id
 * @property string $user_name
 * @property integer $user_phone
 * @property string $user_comment
 * @property integer $user_id
 * @property string $date
 * @property string $products
 * @property integer $status
 */
class ProductOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_phone', 'user_id', 'status'], 'integer'],
            [['user_comment', 'products'], 'string'],
            [['date'], 'safe'],
            [['user_name'], 'string', 'max' => 255],
//            [['date'],'date','format'=>'php:Y-m-d'],
//            [['date'],'default','value'=> date('Y-m-d')],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_name' => 'User Name',
            'user_phone' => 'User Phone',
            'user_comment' => 'User Comment',
            'user_id' => 'User ID',
            'date' => 'Date',
            'products' => 'Products',
            'status' => 'Status',
        ];
    }
}
