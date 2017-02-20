<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.usuarios".
 *
 * @property integer $id
 * @property string $email
 * @property string $senha
 */
class Usuarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email'], 'string', 'max' => 150],
            [['senha'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'senha' => 'Senha',
        ];
    }
}
