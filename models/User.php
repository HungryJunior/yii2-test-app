<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $secret_key
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
//    public function rules()
//{
//    return [
//        [['email'],'email'],
//        [['email'],'required'],
//        [['secret_key'],'unique'],
//        [['secret_key'],'string', 'max' => 255]
//    ];
//}

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'secret_key' => 'Secret Key',
        ];
    }

    //Ф-я поиска пользователя по имени
    public static function findByUsername($username)
    {
        return static::findOne(["name"=>$username]);
    }

    public function generateSecretKey(){
        $this->secret_key = Yii::$app->security->generateRandomString();
    }

    public function getAuthKey(){
        return $this->secret_key;
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['secret_key' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function validateAuthKey($authKey)
    {
        return $this->secret_key === $authKey;
    }
}
