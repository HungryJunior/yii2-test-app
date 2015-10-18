<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\EmailForm;
use app\models\RegisterForm;
use yii\helpers\Url;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error'   => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class'           => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new EmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->saveEmail();//сохраняем email и secret_key в БД
            $model->sendEmail();//Отправляем пользователю письмо со ссылкой на личный кабинет
            return $this->render('success');
        } else {
            return $this->render('index', ['model' => $model]);
        }

    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            $url = Url::toRoute(['office']);
            return $this->redirect($url);
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionRegister()
    {
        $model_register_form = new RegisterForm();
        //Если данные были отправлены и прошли валидацию
        if ($model_register_form->load(Yii::$app->request->post()) && $model_register_form->validate()) {
            //Если регистрация прошла успешно,данные были сохранены,авторизуем пользователя
            if ($user = $model_register_form->register()) {
                Yii::$app->user->login($user);
                $url = Url::toRoute(['login']);
                return $this->redirect($url);
            } else {
                Yii::error("Ошибка при регистрации");
                var_dump($model_register_form->getErrors());
                //return $this->refresh();
            }
        }
        return $this->render("register", ["model" => $model_register_form]);
    }

    public function actionAllocation()
    {
        if (Yii::$app->user->isGuest) {
            $request = Yii::$app->request;
            if ($request->isGet) {
                $key = $request->get('key');
                $url = Url::toRoute(['register', 'key' => $key]);
                return $this->redirect($url);
            }
        } else {
            $url = Url::toRoute(['login']);
            return $this->redirect($url);
        }

    }

    public function actionOffice()
    {
        return $this->render("auth");
    }

    public function actionEditLogin()
    {
        $id = Yii::$app->user->getId();
        $model = User::findIdentity($id);
        if($model->load(Yii::$app->request->post())&&$model->validate()){
            $model->save(false);

        }else{
            return $this->render('edit',['model'=>$model]);
        }


    }
}
