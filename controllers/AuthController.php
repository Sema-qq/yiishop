<?php

namespace app\controllers;

use app\models\Cabinet;
use app\models\SignupForm;
use app\models\User;
use phpDocumentor\Reflection\Types\Null_;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;


class AuthController extends Controller
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

    //авторизация
    public function actionLogin()
    {
        //если пользователь авторизован, то
        if (!Yii::$app->user->isGuest) {
            //возвращаем его на главную страницу
            return $this->goHome();
        }
        //если гость, то приступаем к процессу авторизации этого гостя
        $model = new LoginForm();
        //если нажали кнопку войти, то передаем данные с формы в модель и применяем метод логин
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //перенаправляем авторизованного пользователя назад
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    //логаут - выход из пользователя
    public function actionExit ()
    {
        //передаем пользователя методу логаут
        Yii::$app->user->logout();
        //и направялем на главную страницу
        return $this->goHome();
    }

    //регистрация
    public function actionSignup ()
    {
        $model = new SignupForm();
        //ловим отправку формы
        if (Yii::$app->request->isPost)
        {
            //наполняем нашу модель данными из формы
            $model->load(Yii::$app->request->post());
            //после чего передают методу регистрации
            if ($model->signup())
            {
                //если изменения прошли успешно выдаем сообщение об успехе
                Yii::$app->session->setFlash('contactFormSubmitted');
                //если регистрация прошла успешно перенаправляем на страницу логина
                return $this->redirect(['auth/login']);
            }
        }
        return $this->render('signup', ['model'=>$model]);
    }

    //личный кабинет
    public function actionCabinet ()
    {
        //если пользователь авторизован, то
        if(!Yii::$app->user->isGuest)
        {
            //заходит в личный кабинет
            return $this->render('cabinet');
        }
        else
        {
            //иначе направляем на страницу ошибки
            return $this->redirect(['site/error']);
        }

    }

    //редактирование данных в личном кабинете пользователем
    public function actionEdit ()
    {
        $model = new Cabinet();
        //ловим отправку формы
        if (Yii::$app->request->isPost)
        {
            //наполняем нашу модель данными из формы
            $model->load(Yii::$app->request->post());
            //после чего передаем методу редактирования
            if ($model->edit())
            {
                //если изменения прошли успешно выдаем сообщение об успехе
                Yii::$app->session->setFlash('contactFormSubmitted');
                //и перенаправляем на страницу ЛК
                return $this->redirect(['auth/cabinet']);
            }
        }
        //если пользователь авторизован
        if(!Yii::$app->user->isGuest)
        {
            //позволяем попадать на страницу редактирования данных
            return $this->render('edit',['model'=>$model]);
        }
        else
        {
            //иначе вернем на страницу на которой пользователь был
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionLoginVk($uid, $first_name, $photo)
    {
        $user = new User();
        if ($user->saveFromVk($uid, $first_name, $photo))
        {
            return $this->redirect(['/site/index']);
        }
    }

    public function actionTest ()
    {
        echo '<pre>'; var_dump(Yii::$app->components);
    }
}
