<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 08.10.2015
 * Time: 0:04
 */

namespace app\models;


use yii\db\ActiveRecord;

class EditUserForm extends ActiveRecord
{
    public $name;
    public function getLogin(){
        $id = \Yii::$app->user->getId();
        $user_model = User::findIdentity($id);
        return $user_model;
    }

    public function editLogin(){
        $id = \Yii::$app->user->getId();
        $user_model = User::findIdentity($id);
        var_dump($user_model);
        var_dump($this->name);
        //$user_model->name = $this->name;
        //$user_model->save(false);
    }
}