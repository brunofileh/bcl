<?php
namespace app\models;

class UserLogin extends \app\models\User implements \yii\web\IdentityInterface
{

     public static function findIdentity($id)
    {
        return static::findOne($id);
    }
 
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['token' => $token]);
    }
 
    public function getId()
    {
        return $this->id;
    }
 
    public function getAuthKey()
    {
        return $this->auth_key;
    }
 
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }
	
	public function validatePassword($password)
    {
        return $this->password === $password;
    }

}