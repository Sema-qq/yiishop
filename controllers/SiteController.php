<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\ContactForm;
use yii\web\HttpException;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        //вытаскиваем категории из базы
        $categories = Category::getAll();
        //передаем товары и пагинацию
        $data = Product::getAll(9);
        //вытаскиваем из базы только новые товары на индексную страницу
        $new = Product::find()->where(['is_new'=>1])->limit(6)->all();
        //вытаскиваем из базы только рекомендуемые товары
        $recomended = Product::find()->where(['is_recommended'=>1])->all();
        return $this->render('index',[
            'products'=>$data['products'],
            'pagination'=>$data['pagination'],
            'categories'=>$categories,
            'new'=>$new,
            'recomended'=>$recomended
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        //если форма отправлена, то отправляем данные на почту указанную в config/params
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            //и выдаем сообщение об успешной отправке формы
            Yii::$app->session->setFlash('contactFormSubmitted');
            //обновляем форму
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionCatalog()
    {
        //передаем товары и пагинацию
        $data = Product::getAll(6);
        //вытаскиваем категории из базы
        $categories = Category::getAll();
        return $this->render('catalog',[
            'products'=>$data['products'],
            'pagination'=>$data['pagination'],
            'categories'=>$categories
        ]);
    }

    public function actionSingle($id)
    {
        //вытаскиваем категории из базы
        $categories = Category::getAll();
        //вытаскиваем товар из базы по айди
        $product = Product::findOne($id);
        //проверяем товар на существование
        if (empty($product))
        {
            //если такого товара нет, то выводим страницу ошибки
            throw  new HttpException(404);
        }
        return $this->render('single', [
            'product'=>$product,
            'categories'=>$categories
        ]);
    }

    public function actionCategory ($id)
    {
        $categoryId = Product::find()->where(['category_id'=>$id]);
        //вытаскиваем категории из базы
        $categories = Category::getAll();
        //вытаскиваем товары по категории_айди
        $data = Category::getProductsByCategory($id);
        //вытаскиваем категорию по айди, для
        $categoryName = Category::findOne($id);
        return $this->render('category',[
            'products'=>$data['products'],
            'pagination'=>$data['pagination'],
            'categories'=>$categories,
            'categoryName'=>$categoryName,
            'categoryId'=>$categoryId
        ]);
    }

}
