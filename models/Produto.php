<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.produto".
 *
 * @property string $id
 * @property string $descricao
 * @property integer $unidade
 *
 * @property Kit[] $kits
 * @property ProdutoComercial[] $produtoComercials
 */
class Produto extends \app\models\Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.produto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao', 'unidade'], 'required'],
            [['unidade'], 'integer'],
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
            'unidade' => 'Unidade',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKits()
    {
        return $this->hasMany(Kit::className(), ['produto_fk' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutoComercials()
    {
        return $this->hasMany(ProdutoComercial::className(), ['produto_fk' => 'id']);
    }
}
