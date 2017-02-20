<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.user".
 *
 * @property integer $id
 * @property string $auth_key
 * @property string $email
 * @property string $password
 * @property string $token
 */
class User extends Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['auth_key', 'email', 'password'], 'required'],
            [['auth_key'], 'string', 'max' => 32],
            [['email', 'password', 'token'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'auth_key' => 'Auth Key',
            'email' => 'Email',
            'password' => 'Password',
            'token' => 'Token',
        ];
    }
}
