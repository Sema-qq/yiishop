<?php

namespace app\controllers;

use app\models\Order;
use app\models\OrderItems;
use app\models\Cart;
use app\models\Category;
use app\models\Product;
use yii\web\Controller;
use Yii;

class CartController extends Controller
{

    //экшн страницы корзины
//    public function actionIndex()
//    {
//        //открываем сессию
//        $session = Yii::$app->session;
//        $session->open();
//        //вытаскиваем категории из базы
//        $categories = Category::getAll();
//        return $this->render('index', compact('session'));
//    }

    //экшн добавления товара в корзину
    public function actionAdd ($id)
    {
        //получаем айди товара
        $id = Yii::$app->request->get('id');
        //вытаскиваем с базы товар
        $product = Product::findOne($id);
        //если такого товара нет, то возвращаем фолс
        if (empty($product)) return false;
        //открываем сессию
        $session = Yii::$app->session;
        $session->open();
        //вызываем метод добавления товара в корзину
        $cart = Cart::addToCart($product);
//        echo '<pre>'; var_dump($session['cart']); die();
        //если асинхронное добавление в корзину не сработает, то
        if (!Yii::$app->request->isAjax)
        {
            //вернем страницу на которой пользователь находился
            return $this->redirect(Yii::$app->request->referrer);
        }
        //отключаем шаблон
        $this->layout = false;
        //возвращаем вид и передаем в него сессию
        return $this->render('cart-modal', compact('session'));
    }

    public function actionAddAjax ()
    {
        echo Cart::countItems(Yii::$app->session['cart.qty']);
        return true;
    }

    //экшн очистки корзины
    public function actionClear ()
    {
        //открываем сессию
        $session = Yii::$app->session;
        $session->open();
        //удаляем из сессии товары, количество и сумму
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');
        //отключаем шаблон
        $this->layout = false;
        //возвращаем вид и передаем в него сессию
        return $this->render('cart-modal', compact('session'));
    }

    //экшн удаления товара из корзины
    public function actionDelItem()
    {
        //получаем айди товара
        $id = Yii::$app->request->get('id');
        //открываем сессию
        $session = Yii::$app->session;
        $session->open();
        //вызываем метод удаления товара из сессии
        $cart = Cart::recalc($id);
        //отключаем шаблон
        $this->layout = false;
        //возвращаем вид и передаем в него сессию
        return $this->render('cart-modal', compact('session'));
    }

    //экшн открытия корзины в шапке
    public function actionShow()
    {
        //получаем айди товара
        $id = Yii::$app->request->get('id');
        //открываем сессию
        $session = Yii::$app->session;
        $session->open();
        //отключаем шаблон
        $this->layout = false;
        //возвращаем вид и передаем в него сессию
        return $this->render('cart-modal', compact('session'));
    }

    //экшн оформления заказа
    public function actionCheckout()
    {
        //открываем сессию
        $session = Yii::$app->session;
        $session->open();
        //создаем новый экземпляр модели
        $model = new Order();
        //если даные из формы загружены, то
        if ($model->load(Yii::$app->request->post()))
        {
            //передаем в модель данные из сессии
            $model->qty = $session['cart.qty'];
            $model->sum = $session['cart.sum'];
            //затем передаем методу сохранения, если все отлично, то
            if ($model->save())
            {
                //вызываем метод занесения товаров в таблицу order_items
                Cart::saveOrderItems($session['cart'], $model->id);
                //и отправляем сообщение клиенту
                Yii::$app->mailer->compose('orders', compact('session'))
                    //от кого письмо
                    ->setFrom(['test@mail.ru' => 'E-Shopper'])
                    //кому письмо, берем из формы
                    ->setTo($model->email)
                    //тема письма
                    ->setSubject('Заказ с интернет E-Shopper!')
                    ->send();
//                if ($model->load(Yii::$app->request->post())) Yii::$app->params['adminEmail']; //отправка админу формы
                //и отправляем сообщение админу
                Yii::$app->mailer->compose('orders', compact('session'))
                    //от кого письмо
                    ->setFrom(['test@mail.ru' => 'E-Shopper'])
                    //кому письмо, берем из формы
                    ->setTo(Yii::$app->params['adminEmail'])
                    //тема письма
                    ->setSubject('Заказ с интернет E-Shopper!')
                    ->send();
                //а также очищаем корзину и
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');
                //выводим сообщение о положительном результате и перезагружаем страничку
                Yii::$app->session->setFlash('success');
                return $this->refresh();
            }
            //иначе выводим ошибку
            else Yii::$app->session->setFlash('error');
        }

//        echo '<pre>'; var_dump($model); die();

        return $this->render('checkout', compact('session', 'model'));
    }
}
