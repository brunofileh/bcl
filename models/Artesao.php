<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.artesao".
 *
 * @property integer $id
 * @property string $nome
 * @property string $uf
 *
 * @property FabricacaoHistorico[] $fabricacaoHistoricos
 */
class Artesao extends \app\models\Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.artesao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'string', 'max' => 300],
            [['uf'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'uf' => 'Uf',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFabricacaoHistoricos()
    {
        return $this->hasMany(FabricacaoHistorico::className(), ['artesao_fk' => 'id']);
    }
}
