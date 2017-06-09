<?php

namespace app\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $sort_order
 * @property integer $status
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sort_order', 'status'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Категория',
            'sort_order' => 'Сортировка',
            'status' => 'Статус',
        ];
    }

    public function getProducts ()
    {
        return $this->hasMany(Product::className(), ['category_id'=>'id']);
    }

    public function getProductsCount ()
    {
        return $this->getProducts()->count();
    }

    public static function getAll()
    {
        return Category::find()->all();
    }

    public static function getProductsByCategory ($id)
    {
        //формируем запрос
        $query = Product::find()->where(['category_id'=>$id]);
        //берем количество товаров
        $count = $query->count();
        //количество товаров передаем в класс пагинации
        $pagination = new Pagination(['totalCount'=>$count, 'pageSize'=>6]);
        //лимитируем наш запрос используя пагинацию и выводим статьи
        $products = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        //передаем товары и пагинацию в массив
        $data['products'] = $products;
        $data['pagination'] = $pagination;

        return $data;
    }
}
