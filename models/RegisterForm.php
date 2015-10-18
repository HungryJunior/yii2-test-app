<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 29.09.2015
 * Time: 6:20
 */

namespace app\models;


use yii\base\Model;

class RegisterForm extends Model
{
    public $name;//Переменная для хранения логина пользователя.

    public function rules()
    {
        return [
            ['name', 'filter', 'filter' => 'trim'],
            ['name', 'required'],
            ['name', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Этот логин уже используется'],
            ['name', 'string', 'min' => 2, 'max' => 255]
        ];
    }

    //Ф-я регистрации новых пользователей.
    public function register()
    {
        if ($this->validate()) {
            $model_user = new User();
            //Ищем запись с таким же ключом,как в ссылке(параметр key)
            if ($model_user = $model_user->findIdentityByAccessToken(\Yii::$app->request->getQueryParam('key'))) {
                $model_user->name = $this->name;
                if ($model_user->save()) {
                    return $model_user;
                }
            }
        }
        return null;
    }
}