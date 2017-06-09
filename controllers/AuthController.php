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

    //�����������
    public function actionLogin()
    {
        //���� ������������ �����������, ��
        if (!Yii::$app->user->isGuest) {
            //���������� ��� �� ������� ��������
            return $this->goHome();
        }
        //���� �����, �� ���������� � �������� ����������� ����� �����
        $model = new LoginForm();
        //���� ������ ������ �����, �� �������� ������ � ����� � ������ � ��������� ����� �����
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //�������������� ��������������� ������������ �����
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    //������ - ����� �� ������������
    public function actionExit ()
    {
        //�������� ������������ ������ ������
        Yii::$app->user->logout();
        //� ���������� �� ������� ��������
        return $this->goHome();
    }

    //�����������
    public function actionSignup ()
    {
        $model = new SignupForm();
        //����� �������� �����
        if (Yii::$app->request->isPost)
        {
            //��������� ���� ������ ������� �� �����
            $model->load(Yii::$app->request->post());
            //����� ���� �������� ������ �����������
            if ($model->signup())
            {
                //���� ��������� ������ ������� ������ ��������� �� ������
                Yii::$app->session->setFlash('contactFormSubmitted');
                //���� ����������� ������ ������� �������������� �� �������� ������
                return $this->redirect(['auth/login']);
            }
        }
        return $this->render('signup', ['model'=>$model]);
    }

    //������ �������
    public function actionCabinet ()
    {
        //���� ������������ �����������, ��
        if(!Yii::$app->user->isGuest)
        {
            //������� � ������ �������
            return $this->render('cabinet');
        }
        else
        {
            //����� ���������� �� �������� ������
            return $this->redirect(['site/error']);
        }

    }

    //�������������� ������ � ������ �������� �������������
    public function actionEdit ()
    {
        $model = new Cabinet();
        //����� �������� �����
        if (Yii::$app->request->isPost)
        {
            //��������� ���� ������ ������� �� �����
            $model->load(Yii::$app->request->post());
            //����� ���� �������� ������ ��������������
            if ($model->edit())
            {
                //���� ��������� ������ ������� ������ ��������� �� ������
                Yii::$app->session->setFlash('contactFormSubmitted');
                //� �������������� �� �������� ��
                return $this->redirect(['auth/cabinet']);
            }
        }
        //���� ������������ �����������
        if(!Yii::$app->user->isGuest)
        {
            //��������� �������� �� �������� �������������� ������
            return $this->render('edit',['model'=>$model]);
        }
        else
        {
            //����� ������ �� �������� �� ������� ������������ ���
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
