<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $secret_key
 */
class User extends \yii\db\ActiveRecord
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
    public function rules()
{
    return [
        [['name'], 'string', 'max' => 255]
    ];
}

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

    public function generateSecretKey(){
        $this->secret_key = Yii::$app->security->generateRandomString();
    }

    public function getSecretKey(){
        return $this->secret_key;
    }
}
