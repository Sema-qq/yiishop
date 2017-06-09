<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Cart extends ActiveRecord
{
    public static function addToCart($product, $qty = 1)
    {
        //проверяем есть ли уже в сессии такой товар
        if (isset($_SESSION['cart'][$product->id]))
        {
            //то прибавим к текущему количеству пришедшее количество
            $_SESSION['cart'][$product->id]['qty'] += $qty;
        }
        else
        {
            //иначе записываем новый товар
            $_SESSION['cart'][$product->id] = [
                'qty' => $qty,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image
            ];
        }
        //массив для хранения общего количества товара
        //если товары уже есть, то к текущему количеству прибавляем пришедшее,
        // иначе просто записываем пришедшее количество товара
        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty']+$qty : $qty;
        //массив для хранения общей суммы по товарам
        //если уже какая то сумма имеется, то прибавляем количество умноженое на сумму,
        //иначе просто записываем количество умноженное на сумму
        $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum']+$qty*$product->price : $qty*$product->price;

        return self::countItems();
    }

    //метод вывода общего количества товаров в корзине
    public static function countItems($count = 0)
    {
        $count = Yii::$app->session['cart.qty'];
        if (!Yii::$app->session['cart.qty']) $count = 0;
        return $count;
    }

    //метод удаления товаров из корзины
    public static function recalc ($id)
    {
        //проверяем есть ли такой товар в массиве карт, если нет, то вернем false
        if (!isset($_SESSION['cart'][$id])) return false;
        //если существует, то
        $qtyMinus = $_SESSION['cart'][$id]['qty'];
        $sumMinus = $_SESSION['cart'][$id]['qty']*$_SESSION['cart'][$id]['price'];
        $_SESSION['cart.qty'] -= $qtyMinus;
        $_SESSION['cart.sum'] -= $sumMinus;
        unset($_SESSION['cart'][$id]);

    }

    public static function saveOrderItems($items, $order_id)
    {
        foreach ($items as $id => $item)
        {
            $order_idems = new OrderItems();
            $order_idems->order_id = $order_id;
            $order_idems->product_id = $id;
            $order_idems->name = $item['name'];
            $order_idems->price = $item['price'];
            $order_idems->qty_item = $item['qty'];
            $order_idems->sum_item = $item['qty']*$item['price'];
            $order_idems->save();
        }
    }
}