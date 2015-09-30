<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 29.09.2015
 * Time: 2:31
 */

namespace app\models;

use Yii;
use yii\base\Model;

class EmailForm extends Model
{
    public $email;//Переменная для хранения введеного пользователем email адреса
    public $secret_key;//Переменная для хранения уникального ключа для каждого пользователя

    public function rules(){
        return [
            [['email'],'email'],
            [['email'],'required'],
            [['secret_key'],'unique'],
            [['secret_key'],'string', 'max' => 255]
        ];
    }

    //Ф-я для сохранения email адреса в БД
    public function saveEmail(){
        $model_user = new User();
        $model_user->email = $this->email;
        $model_user->generateSecretKey();
        $this->secret_key = $model_user->getAuthKey();
        $model_user->save();
    }

    //Ф-я для отправки сообщения на указаную почту
    public function sendEmail(){
        return Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['supportEmail'])
            ->setTo($this->email)
            ->setSubject('Yii2-test-app')
            ->setHtmlBody("<span>Перейти на <a href=yii2-email-registration.loc/site/allocation?key=".$this->secret_key.">сайт</a></span>")
            ->send();
    }

}