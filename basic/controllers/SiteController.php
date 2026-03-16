<?php

namespace app\controllers;

use app\models\Aufgaben;
use app\models\Post;
use app\models\RegisterForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'register', 'error', 'captcha'],
                        'allow' => true,
                        'roles' => ['?'], // Erlaubt Gästen (nicht angemeldeten Benutzern) den Zugriff
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'], // Erlaubt angemeldeten Benutzern den Zugriff auf alle anderen Aktionen
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    return $action->controller->redirect(['site/login']);
                }
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
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
        $aufgaben = Aufgaben::find()->all();

        return $this->render('/site/index', [
            'aufgaben' => $aufgaben,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->Password = ''; // Korrigiertes Attribut
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

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
        return $this->render('site/index');
    }

    public function actionRegister()
    {
        $model = new RegisterForm();
        try {
            if ($model->load(Yii::$app->request->post()) && $model->register()) {
                return $this->redirect(['site/login']);
            }
        } catch (\Exception $e) {
            $newMessage = explode('The SQL being executed was:', $e->getMessage())[0];
            Yii::$app->session->setFlash('error', $newMessage);
        }
        return $this->render('register', ['regModel' => $model]);
    }
}
