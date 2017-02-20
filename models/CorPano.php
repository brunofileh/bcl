<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.cor_pano".
 *
 * @property integer $id
 * @property string $descricao
 *
 * @property Estoque[] $estoques
 * @property ProdutoPreco[] $produtoPrecos
 */
class CorPano extends Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.cor_pano';
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
    public function getEstoques()
    {
        return $this->hasMany(Estoque::className(), ['cor_pano_fk' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutoPrecos()
    {
        return $this->hasMany(ProdutoPreco::className(), ['cor_pano_fk' => 'id']);
    }
}
