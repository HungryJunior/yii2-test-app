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

    public function rules(){
        return [
            [['email'],'email'],
            [['email'],'required']
        ];
    }

    //Ф-я для сохранения email алреса в БД
    public function saveEmail(){
        $model_user = new User();
        $model_user->email = $this->email;
        $model_user->save();
    }
}