<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.desenho".
 *
 * @property integer $id
 * @property string $descricao
 *
 * @property Fabricacao[] $fabricacaos
 */
class Desenho extends Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.desenho';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Descricao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFabricacaos()
    {
        return $this->hasMany(Fabricacao::className(), ['desenho_fk' => 'id']);
    }
}
